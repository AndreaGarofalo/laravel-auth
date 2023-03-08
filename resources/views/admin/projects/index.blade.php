@extends('layouts.app')

@section('title', 'Projects')


@section('content')
<table class="table my-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Slug</th>
      <th scope="col">Created at</th>
      <th scope="col">Updated at</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @forelse($projects as $project)
    <tr>
      <th scope="row">{{ $project->id }}</th>
      <td>{{ $project->title }}</td>
      <td>{{ $project->slug }}</td>
      <td>{{ $project->created_at }}</td>
      <td>{{ $project->updated_at }}</td>
      <td class="d-flex">
        <a href="{{ route('admin.projects.show', $project->id)}}" class="btn btn-small btn-primary mx-2"><i class="fa-solid fa-eye"></i></a>
        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></button>
        </form>
      </td>
    </tr>
    @empty
    <tr>
        <th scope="row" colspan="6" class="text-center">There are no projects</th>
    </tr>
        
    @endempty
  </tbody>
</table>
@endsection