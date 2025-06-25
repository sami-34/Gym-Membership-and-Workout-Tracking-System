@extends('layouts.app')
@section('title','Assign Workout')
@section('content')
  <h2>Assign Workout to Member</h2>
  {{-- <form method="POST" action="/assign-workout">
    @csrf
    <select name="user_id">@foreach($members as $m)
      <option value="{{ $m->id }}">{{ $m->name }}</option>
    @endforeach</select>
    <select name="workout_id">@foreach($workouts as $w)
      <option value="{{ $w->id }}">{{ $w->name }}</option>
    @endforeach</select>
    <textarea name="progress_notes" placeholder="Notes"></textarea>
    <button type="submit">Assign</button>
  </form> --}}
  
<form method="POST" action="/assign-workout">
    @csrf

    <label>Member:</label>
    <select name="user_id" required>
      @foreach($members as $m)
        <option value="{{ $m->id }}">{{ $m->name }}</option>
      @endforeach
    </select>

    <label>Workout:</label>
    <select name="workout_id" required>
      @foreach($workouts as $w)
        <option value="{{ $w->id }}">{{ $w->name }} ({{ $w->reps }} reps × {{ $w->sets }} sets)</option>
      @endforeach
    </select>

    <label>Day of Week:</label>
    <select name="day_of_week" required>
      <option value="1">Mon</option>
      <option value="2">Tue</option>
      <option value="3">Wed</option>
      <option value="4">Thu</option>
      <option value="5">Fri</option>
      <option value="6">Sat</option>
      <option value="7">Sun</option>
    </select>

    <label>Notes (optional):</label>
    <textarea name="progress_notes"></textarea>

    <button type="submit">Assign Workout</button>
  </form>
@endsection
