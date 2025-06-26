@extends('layouts.app')
@section('title','Assign Workout')
@section('content')
  <h2>Assign Workout to Member</h2>
  
<form method="POST" action="/assign-workout">
    @csrf

    <label>Member:</label>
    <select name="user_id" required>
      @foreach($members as $m)
        <option value="{{ $m->id }}">{{ $m->name }}</option>
      @endforeach
    </select><br>

    <label>Workout:</label>
    <select name="workout_id" required>
      @foreach($workouts as $w)
        <option value="{{ $w->id }}">{{ $w->name }} ({{ $w->reps }} reps × {{ $w->sets }} sets)</option>
      @endforeach
    </select><br>

    <label>Day of Week:</label>
    <select name="day_of_week" required>
      <option value="1">Mon</option>
      <option value="2">Tue</option>
      <option value="3">Wed</option>
      <option value="4">Thu</option>
      <option value="5">Fri</option>
      <option value="6">Sat</option>
      <option value="7">Sun</option>
    </select><br>

    <label>Notes (optional):</label><br>
    <textarea name="progress_notes" class="notes-textarea"></textarea><br>

    <button type="submit">Assign Workout</button>
  </form>
@endsection
