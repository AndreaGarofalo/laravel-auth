@extends('layouts.app')

@section('title', 'Projects')


@section('content')
<div class="d-flex justify-content-between mt-5">
    <div class="title">
        <h1>Title: {{ $project->title }}</h1>
        <h5>Slug: {{ $project->slug }}</h5>
        <p class="mt-5">Description: {{ $project->description }}</p>
    </div>
    <img src="{{ $project->screen }}" alt="{{ $project->slug }}">
</div>
<div class="d-flex justify-content-between mt-5">
    <div class="text-danger"><strong>Created: {{ $project->created_at }}</strong></div>
    <div class="text-danger"><strong>Updated: {{ $project->updated_at }}</strong></div>   
</div>
@endsection
