@extends('layouts.app')
@section('content')
<div>
    <h2 class="my-12 text-2xl text-center">Projects:</h2>
    <div class="grid grid-cols-4 gap-4">
        @forelse ($projects as $project)
        <div class="rounded-md border border-cyan-700 bg-white p-2 shadow-sm">
            <img src="{{Storage::url($project->project_photo)}}" alt="{{$project->name}}">
            <h3 class="text-center">{{ $project->name}}</h3>
        </div>
        @empty
    </div>
    <p class="text-center text-red-600">there is no projects created yet.</p>
    @endforelse
</div>
@endsection