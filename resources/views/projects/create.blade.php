@extends('layouts.app')

@section('content')
<form method="POST" action="{{ isset($project) ? route('projects.update', ['student' => $student->id, 'project' => $project->id]) : route('projects.store', ['student' => $student->id]) }}" enctype="multipart/form-data">
    @csrf
    @isset($project)
    @method('PUT')
    @endisset
    <div>
        <x-input-label for="name" :value="__('Title')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', isset($project) ? $project->name : '')" required autofocus autocomplete=" name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>
    <div>
        <x-input-label for="description" :value="__('Description')" />
        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', isset($project) ? $project->description : '')" required autofocus autocomplete="description" />
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>
    <div>
        <x-input-label for="github" :value="__('Github')" />
        <x-text-input id="github" name="github" type="text" class="mt-1 block w-full" :value="old('github', isset($project) ? $project->github : '')" required autofocus autocomplete="github" />
        <x-input-error class="mt-2" :messages="$errors->get('github')" />
    </div>
    <div>
        <x-input-label for="project_photo" :value="__('Project photo')" />
        <x-text-input id="project_photo" name="project_photo" type="file" class="mt-1 block w-full" :value="old('project_photo')" autofocus autocomplete="project_photo" />
        <x-input-error class="mt-2" :messages="$errors->get('project_photo')" />

    </div>
    <x-button type="submit" class="bg-green-400 text-white"> @if(isset($project))
        Update
        @else
        Create
        @endif</x-button>
</form>

@endsection