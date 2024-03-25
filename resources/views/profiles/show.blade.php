@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">{{ session('success') }}
</div>
@endif



<h1 class="text-center my-12">Users Dashboard where will be displayed his profile info and projects</h1>

<div class="flex my-5 gap-5 justify-around">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <div>
                    <h1 class="space-y-5 my-2 text-center text-2xl">Students profile info</h1>
                    <h2>My name: {{ $profile->name }} {{$profile->last_name}}</h2>
                    <h2>about me: {{$profile->about}}</h2>
                    <h2>skills: {{$profile->skills}}</h2>
                    <h2>Linkedin: {{$profile->linkedin}}</h2>
                    <h2>Github: {{$profile->github}}</h2>
                    <h2>Phone: {{$profile->phone}}</h2>
                    <h2>Views: {{$profile->views}}</h2>
                    <h2>Category: {{$profile->category}}</h2>
                    <h2>Location: {{$profile->location}}</h2>
                    <img src="{{  Storage::url($profile->profile_photo) }}" alt="{{ $profile->name }}" width="200">
                </div>
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <div>

                    <section>
                        <div>
                            <h2 class="my-12 text-2xl text-center">Projects:</h2>
                            <div class="grid grid-cols-4 gap-4">
                                @forelse ($projects as $project)
                                <div class="rounded-md border border-cyan-700 bg-white p-2 shadow-sm">
                                    <a href="{{ route('projects.show', ['profile' => $profile, 'project' => $project])}}">
                                        <img src="{{Storage::url($project->project_photo)}}" alt="{{$project->name}}">
                                        <h3 class="text-center">{{ $project->name}}</h3>
                                    </a>

                                </div>
                                @empty
                            </div>
                            <p class="text-center text-red-600">there is no projects created yet.</p>
                            @endforelse
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection