@extends('layouts.app')
@section('content')

<h1 class="text-center text-2xl text-red-500 my-5">Top 5 STUDENTS</h1>
<div class="grid grid-cols-4 gap-4 my-5">
    @forelse($students as $student)
    <div class="rounded-md border border-cyan-700 bg-white p-2 shadow-sm text-center">
        <p>Name:{{$student->name}}</p>
        <p>Views: {{$student->views}}</p>
    </div>
    @empty
</div>
<p class="text-center text-red-600">There is no students created yet.</p>
@endforelse
@endsection