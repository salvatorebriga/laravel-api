@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="py-4">Create New Project</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Create Project</button>
    </form>
  </div>
@endsection
