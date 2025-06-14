@extends('layouts.app')
@section('title','My Plans')
@section('content')
  <h2>Assigned Workout</h2>
  <ul>
    @forelse($workouts as $w)
      <li>{{ $w->workout->name ?? 'Deleted Workout' }} — {{ $w->progress_notes ?? 'No notes' }}</li>
    @empty
      <li>No workout assigned yet.</li>
    @endforelse
  </ul>

  <h2>Assigned Diet</h2>
  <ul>
    @forelse($diets as $d)
      <li>{{ $d->dietPlan->title ?? 'Deleted Plan' }} — {{ $d->notes ?? 'No notes' }}</li>
    @empty
      <li>No diet plan assigned yet.</li>
    @endforelse
  </ul>
@endsection
