@extends('layouts.dashboard')

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>{{ $project->name }}</h2>
            <img class="project-image"
                src="{{ $project->image !== null ? asset('./storage/'.$project->image) : 'https://placehold.co/400' }}"
                alt="{{ $project->name }}">
            <p>{{ $project->slug }}</p>
            <p>{{ $project->summary }}</p>
        </div>
    </div>
</div>
@endsection