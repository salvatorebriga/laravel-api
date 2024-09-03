@extends('layouts.app')

@section('content')
  <div class="container">

    <div class="header-page py-4 d-flex justify-content-between align-items-center">
      <h1>Technologies</h1>
      <div>
        <a href="{{ route('admin.technologies.create') }}" class="btn btn-primary">Add New Technology</a>
      </div>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($technologies as $technology)
          <tr>
            <td>{{ $technology->name }}</td>
            <td>
              <div class="d-flex justify-content-end">
                <a href="{{ route('admin.technologies.edit', $technology->id) }}" class="btn btn-primary btn-sm mr-1">
                  <i class="fas fa-pencil"></i>
                </a>
                <a href="{{ route('admin.technologies.show', $technology->id) }}" class="btn btn-warning btn-sm mr-1">
                  <i class="fas fa-search"></i>
                </a>
                <form action="{{ route('admin.technologies.destroy', $technology->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this technology?')">
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
