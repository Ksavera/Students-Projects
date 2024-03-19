@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">{{ session('success') }}
</div>
@elseif(session('error'))
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    {{ session('error') }}
</div>
@endif




<h1 class="text-center my-12">Users Dashboard where will be displayed his profile info and projects</h1>

<div class="flex my-5 gap-5 justify-around">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <div>
                    <h1 class="space-y-5 my-2 text-center text-2xl">Students profile info</h1>
                    <h2>My name: {{ $student->name }} {{$student->last_name}}</h2>
                    <h2>about me: {{$student->about}}</h2>
                    <h2>skills: {{$student->skills}}</h2>
                    <h2>Linkedin: {{$student->linkedin}}</h2>
                    <h2>Github: {{$student->github}}</h2>
                    <h2>Phone: {{$student->phone}}</h2>
                    <h2>Views: {{$student->views}}</h2>
                    <h2>Category: {{$student->category}}</h2>
                    <h2>Location: {{$student->location}}</h2>
                    <img src="{{  Storage::url($student->profile_photo) }}" alt="{{ $student->name }}" width="200">
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <div>
                    <div class="mb-8 flex justify-center">
                        <x-primary-button class="bg-blue-200">
                            <a href="{{route('projects.create', ['student'=>$student])}}">Create a project</a>
                        </x-primary-button>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        @forelse ($projects as $project)

                        <div class="rounded-md border border-cyan-700 bg-white p-2 shadow-sm">
                            <a href="{{route('projects.show', ['project'=>$project->id])}}">
                                <img src="{{Storage::url($project->project_photo)}}" alt="{{$project->name}}">
                                <h3>{{ $project->name}}</h3>
                            </a>
                        </div>


                        @empty
                    </div>
                    <p class="text-red-500 text-center">there is no projects yet.</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>



@endsection