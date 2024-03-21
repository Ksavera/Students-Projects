@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">{{ session('success') }}
</div>
@endif

<div class="p-5">
    <div class="flex my-5 gap-5">
        <h1 class="text-2xl text-red-600">Students list</h1>
    </div>
    <div class="grid grid-cols-4 gap-4">
        @foreach($profiles as $profile)
        <div class="rounded-md border border-cyan-700 bg-white p-2 shadow-sm">
            <a href="{{route('profiles.show', compact('profile'))}}">
                <h3>{{ $profile->name }} {{ $profile->last_name }}</h3>
                <img src="{{ Storage::url($profile->profile_photo) }}" alt="{{ $profile->name }}" width="500">
            </a>


        </div>
        @endforeach
    </div>

</div>
@endsection