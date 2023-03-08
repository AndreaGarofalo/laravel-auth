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
      <td>
        <a href="{{ route('admin.projects.show', $project->id)}}" class="btn btn-small btn-primary">See Details</a>
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
