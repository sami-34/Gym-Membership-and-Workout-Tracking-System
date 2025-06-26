@extends('layouts.app')
@section('title','Add Workout')
@section('content')
  <h2>Add Workout</h2>
  {{-- <form method="POST" action="/workouts">
    @csrf
    <input name="name" placeholder="Workout Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <select name="difficulty_level">
      <option>beginner</option>
      <option>intermediate</option>
      <option>advanced</option>
    </select>
    <button type="submit">Save</button>
  </form> --}}
  <form method="POST" action="/workouts">
    @csrf
    <label>Name:</label>
    <input name="name" required><br>

    <label>Reps:</label>
    <select name="reps">
      <option>12</option><option>10</option><option>8</option>
    </select><br>

    <label>Sets:</label>
    <select name="sets">
      <option>3</option><option>2</option><option>1</option>
    </select><br>

    <label>Description:</label><br>
    <textarea name="description" required class="notes-textarea"></textarea><br>

    <label>Difficulty:</label>
    <select name="difficulty_level" required>
      <option value="beginner">Beginner</option>
      <option value="intermediate">Intermediate</option>
      <option value="advanced">Advanced</option>
    </select><br>

    <button type="submit">Create</button>
  </form>

@endsection
