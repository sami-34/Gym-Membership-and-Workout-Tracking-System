@extends('layouts.app')
@section('title','My Workouts')
@section('content')
  <h2>My Workouts</h2>
  <a href="/workouts/create">+ New Workout</a>
  <ul>
    @foreach($workouts as $w)
      <li>{{ $w->name }} ({{ $w->difficulty_level }})</li>
    @endforeach
  </ul>
@endsection
