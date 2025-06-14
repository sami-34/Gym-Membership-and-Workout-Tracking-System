@extends('layouts.app')
@section('title','Assign Workout')
@section('content')
  <h2>Assign Workout to Member</h2>
  <form method="POST" action="/assign-workout">
    @csrf
    <select name="user_id">@foreach($members as $m)
      <option value="{{ $m->id }}">{{ $m->name }}</option>
    @endforeach</select>
    <select name="workout_id">@foreach($workouts as $w)
      <option value="{{ $w->id }}">{{ $w->name }}</option>
    @endforeach</select>
    <textarea name="progress_notes" placeholder="Notes"></textarea>
    <button type="submit">Assign</button>
  </form>
@endsection
