@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">{{ session('success') }}
</div>
@endif


<div>
    <h1 class="space-y-5 my-2 text-center text-2xl">Students personal info</h1>
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

@endsection