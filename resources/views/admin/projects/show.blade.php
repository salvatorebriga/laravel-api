@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="py-4">Project Details</h1>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{ $project->name }}</h3>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <h5>Description</h5>
            <p>{{ $project->description }}</p>
          </div>
          <div class="col-md-6">
            <h5>Category</h5>
            <p>{{ $project->category->name ?? 'N/A' }}</p>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <h5>Technologies</h5>
            <p>
              @foreach ($project->technologies as $technology)
                <span class="badge bg-secondary">{{ $technology->name }}</span>
              @endforeach
            </p>
          </div>
          <div class="col-md-6">
            <h5>Status</h5>
            <p>{{ $project->status == 1 ? 'Active' : 'Not Active' }}</p>
          </div>
        </div>

        @if ($project->image_path)
          <div class="row mb-3">
            <div class="col-md-12">
              <h5>Image</h5>
              <img src="{{ Storage::url($project->image_path) }}" alt="Project Image" class="img-fluid rounded"
                style="max-width: 100%;">
            </div>
          </div>
        @endif
      </div>
      <div class="card-footer text-end">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Back to List</a>
        <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-primary">Edit Project</a>
      </div>
    </div>
  </div>
@endsection
