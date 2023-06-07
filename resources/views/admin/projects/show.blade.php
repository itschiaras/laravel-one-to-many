@extends('layouts.admin')

@section('content')
    <h1>{{ $project->title }}</h1>
    <img src="{{ $project->image }}" alt="{{ $project->title }}" style="width: 20rem">
    <p>{!! $project->description !!}</p>
    <p> {{ $project->type ? $project->type->name : 'Senza categoria' }}</p>
@endsection
