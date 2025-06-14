@extends('layouts.app')
@section('title', 'Assign Diet Plan')
@section('content')
  <h2>Assign Diet Plan to Member</h2>

  <form method="POST" action="/assign-diet">
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
  </form>
@endsection
