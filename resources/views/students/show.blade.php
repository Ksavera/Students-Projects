@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">{{ session('success') }}
</div>
@endif


<div>
    <h1 class="space-y-5 my-2 text-center text-2xl">Students personal info</h1>
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

@endsection