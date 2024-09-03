@extends('layouts.app')

@section('content')
  <div class="container">
    <header class="d-flex justify-content-between align-items-center">
      <h1 class="py-4">Categories</h1>
      <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>
    </header>



    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
          <tr>
            <td class="col-9">{{ $category->name }}</td>
            <td>
              <div class="d-flex justify-content-end">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm mr-1">
                  <i class="fas fa-pencil"></i>
                </a>
                <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-warning btn-sm mr-1">
                  <i class="fas fa-search"></i>
                </a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this category?')">
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
