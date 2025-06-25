@extends('layouts.app')
@section('title','Add Diet Plan')
@section('content')
  <h2>Add Diet Plan</h2>
  {{-- <form method="POST" action="/diets">
    @csrf
    <input name="title" type="text" placeholder="Diet Plan Title" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <button type="submit">Save</button>
  </form> --}}
  <form method="POST" action="/diets">
    @csrf
    <label>Title:</label>
    <input name="title" required>

    <label>Duration (weeks):</label>
    <select name="duration_weeks" required>
      @for($i=1;$i<=12;$i++)
        <option>{{ $i }}</option>
      @endfor
    </select>

    <label>Calories/day:</label>
    <input type="number" name="calories" min="800" max="2000" required>

    <label>Meals per day:</label>
    <select name="meals_per_day">
      <option>1</option><option>2</option><option>4</option><option>5</option>
    </select>

    <label>Description:</label>
    <textarea name="description" required></textarea>

    <button type="submit">Create</button>
  </form>

@endsection
