@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="py-4">{{ $project->name }}</h1>

    @if ($project->image_path)
      <div class="mb-4">
        <img src="{{ Storage::url($project->image_path) }}" alt="Project Image" class="img-fluid"
          style="max-width: 100%; height: auto;">
      </div>
    @endif

    <div class="mb-3">
      <p><strong>Description:</strong> {{ $project->description ?? 'N/A' }}</p>
    </div>

    <div class="mb-3">
      <p><strong>Category:</strong> {{ $project->category->name ?? 'N/A' }}</p>
    </div>

    <div class="mb-3">
      <p><strong>Technologies:</strong>
        @if ($project->technologies->isEmpty())
          N/A
        @else
          {{ $project->technologies->pluck('name')->implode(', ') }}
        @endif
      </p>
    </div>

    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Back to Projects</a>
  </div>
@endsection
