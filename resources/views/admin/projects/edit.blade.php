@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="py-4">Edit Project</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="card">
        <div class="card-header">
          <h5>Edit Project Details</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"
              value="{{ old('name', $project->name) }}">
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $project->description) }}</textarea>
          </div>

          <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="category_id">
              <option value="">Select Category</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $project->category_id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Technologies</label><br>
            @foreach ($technologies as $technology)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="technologies[]"
                  id="technology_{{ $technology->id }}" value="{{ $technology->id }}"
                  {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                <label class="form-check-label" for="technology_{{ $technology->id }}">
                  {{ $technology->name }}
                </label>
              </div>
            @endforeach
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($project->image_path)
              <img src="{{ Storage::url($project->image_path) }}" alt="Project Image" class="img-thumbnail"
                style="max-width: 100px;">
            @endif
          </div>

          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
              <option value="1" {{ old('status', $project->status) == '1' ? 'selected' : '' }}>Active</option>
              <option value="0" {{ old('status', $project->status) == '0' ? 'selected' : '' }}>Not Active</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Update Project</button>
          <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
      </div>
    </form>
  </div>
@endsection
