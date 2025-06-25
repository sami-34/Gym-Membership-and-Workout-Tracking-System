@extends('layouts.app')
@section('title', 'Assign Diet Plan')
@section('content')
  <h2>Assign Diet Plan to Member</h2>

  {{-- <form method="POST" action="/assign-diet">
    @csrf

    <label>Member</label>
    <select name="user_id" required>
      @foreach($members as $m)
        <option value="{{ $m->id }}">{{ $m->name }}</option>
      @endforeach
    </select>

    <label>Diet Plan</label>
    <select name="diet_plan_id" required>
      @foreach($diets as $d)
        <option value="{{ $d->id }}">{{ $d->title }}</option>
      @endforeach
    </select>

    <label>Notes (optional)</label>
    <textarea name="notes" rows="3" placeholder="e.g., Follow for 1 month..."></textarea>

    <button type="submit">Assign</button>
  </form> --}}

  <form method="POST" action="/assign-diet">
  @csrf

  <label>Member:</label>
  <select name="user_id" required>
    @foreach($members as $m)
      <option value="{{ $m->id }}">{{ $m->name }}</option>
    @endforeach
  </select>

  <label>Diet Plan:</label>
  <select name="diet_plan_id" required>
    @foreach($diets as $d)
      <option value="{{ $d->id }}">
        {{ $d->title }} ({{ $d->duration_weeks }} wk, {{ $d->calories }} kcal, {{ $d->meals_per_day }} meals/day)
      </option>
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
  <textarea name="notes"></textarea>

  <button type="submit">Assign Diet</button>
</form>

@endsection
