@extends('layouts.app')
@section('title','Add Workout')
@section('content')
  <h2>Add Workout</h2>
  <form method="POST" action="/workouts">
    @csrf
    <input name="name" placeholder="Workout Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <select name="difficulty_level">
      <option>beginner</option>
      <option>intermediate</option>
      <option>advanced</option>
    </select>
    <button type="submit">Save</button>
  </form>
@endsection
