@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">{{ session('success') }}
</div>
@endif


<div>
    <h1 class="space-y-5 my-8 text-center text-2xl">Project's info:</h1>
    @if(auth()->check() && auth()->user()->profile && auth()->user()->profile->id == $project->profile_id)

    <x-secondary-button>
        <a href="{{route('projects.edit', compact('project'))}}">Edit</a>
    </x-secondary-button>

    <form action="{{route('projects.destroy', ['project' => $project->id, 'profile=> $profile'] ) }}" method="POST">
        @csrf
        @method('DELETE')
        <x-danger-button>Delete</x-danger-button>
    </form>
</div>
@endif
<div class="rounded-md border border-cyan-700 bg-white p-2 shadow-sm">
    <h3 class="text-xl my-6 text-center">{{ $project->name }}</h3>
    <img src="{{Storage::url($project->project_photo)}}" alt="{{$project->name}}">
    <p class="text-sm text-center">{{ $project->description }}</p>

</div>

</div>

@endsection