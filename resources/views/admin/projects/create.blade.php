@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="py-4">Create New Project</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
          value="{{ old('name') }}" required>
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
          rows="3">{{ old('description') }}</textarea>
        @error('description')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
          <option value="" {{ old('status') === null ? 'selected' : '' }}>Select Status</option>
          <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
          <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
          <option value="">Select Category</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
        @error('category_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
        @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Technologies</label><br>
        @foreach ($technologies as $technology)
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="technologies[]" id="technology_{{ $technology->id }}"
              value="{{ $technology->id }}" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="technology_{{ $technology->id }}">
              {{ $technology->name }}
            </label>
          </div>
        @endforeach
      </div>

      <button type="submit" class="btn btn-primary">Create Project</button>
    </form>
  </div>
@endsection
