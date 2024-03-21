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
        @foreach($students as $student)
        <div class="rounded-md border border-cyan-700 bg-white p-2 shadow-sm">
            <a href="{{ route('students.show', ['student' => $student]) }}">
                <h3>{{ $student->name }} {{ $student->last_name }}</h3>
                <img src="{{ Storage::url($student->profile_photo) }}" alt="{{ $student->name }}" width="500">
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection