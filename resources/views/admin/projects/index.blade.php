@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="header-page py-4 d-flex justify-content-between align-items-center">
      <h1>Projects</h1>
      <div>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Add New Project</a>
      </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Category</th>
          <th scope="col">Technologies</th>
          <th scope="col">Image</th> <!-- Nuova colonna per l'immagine -->
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($projects as $project)
          <tr>
            <td>{{ $project->id }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->description }}</td>
            <td>{{ $project->category->name ?? 'N/A' }}</td>
            <td>
              @foreach ($project->technologies as $technology)
                <span class="badge bg-secondary">{{ $technology->name }}</span>
              @endforeach
            </td>
            <td>
              @if ($project->image_path)
                <div>
                  <img src="{{ Storage::url($project->image_path) }}" alt="Project Image" class="img-thumbnail"
                    style="max-width: 100px;">
                </div>
              @else
                <p>No image available</p>
              @endif
            </td>
            <td>
              <div class="d-flex justify-content-end">
                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-primary btn-sm me-1"
                  title="Edit">
                  <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-warning btn-sm me-1"
                  title="View">
                  <i class="fas fa-search"></i>
                </a>
                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this project?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
