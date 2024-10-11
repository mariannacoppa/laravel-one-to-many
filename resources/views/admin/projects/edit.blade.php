@extends('layouts.dashboard')

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Modifica un progetto</h2>
        </div>
        <div class="col-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('admin.projects.update', ['project' => $project->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <label for="" class="control-label">Nome progetto</label>
                        <input type="text" name="name" id=""
                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                            placeholder="Nome pogetto" value="{{ old('name', $project->name) }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        @if ($project->image !== null)
                        <img src="{{ asset('./storage/' . $project->image) }}" alt="{{ $project->name }}"
                            class="project-image">
                        @else
                        <img src="https://placehold.co/400" alt="{{ $project->name }}">
                        @endif
                    </div>
                    <div class="col-12">
                        <label for="" class="control-label">Immagine</label>
                        <input type="file" name="image" id="image" class="form-control form-control-sm">
                    </div>
                    <div class="col-12">
                        <label for="" class="control-label">Sommario progetto</label>
                        <textarea name="summary" id="" cols="30" rows="10" class="form-control form-control-sm"
                            placeholder="Nome pogetto">{{ old('summary', $project->summary) }}</textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-sm btn-success">Salva</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection