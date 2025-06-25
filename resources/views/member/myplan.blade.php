@extends('layouts.app')
@section('title','My Plans')
@section('content')
  {{-- <h2>Assigned Workout</h2>
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
  </ul> --}}

  <h2>Weekly Plan Overview</h2>

    @php
      $weekdays = ['1' => 'Mon', '2' => 'Tue', '3' => 'Wed', '4' => 'Thu', '5' => 'Fri', '6' => 'Sat', '7' => 'Sun'];
    @endphp

    {{-- AUTO GENERATE BUTTON (only if no trainer) --}}
    @if(auth()->user()->trainer_id === null)
      <form method="POST" action="/myplan/autogenerate" style="margin-bottom: 1rem;">
        @csrf
        <button type="submit">Auto-Generate Weekly Plan</button>
      </form>

      {{-- MANUAL PLAN ADD --}}
      <form method="POST" action="/myplan/addplan" style="margin-bottom: 2rem;">
        @csrf
        <label>Day:</label>
        <select name="day_of_week" required>
          @foreach($weekdays as $num => $label)
            <option value="{{ $num }}">{{ $label }}</option>
          @endforeach
        </select>

        <label>Workout:</label>
        <select name="workout_id">
          <option value="">-- None --</option>
          @foreach($allWorkouts as $w)
            <option value="{{ $w->id }}">{{ $w->name }}</option>
          @endforeach
        </select>

        <label>Diet:</label>
        <select name="diet_id">
          <option value="">-- None --</option>
          @foreach($allDiets as $d)
            <option value="{{ $d->id }}">{{ $d->title }}</option>
          @endforeach
        </select>

        <button>Add Plan</button>
      </form>
    @endif

    {{-- WEEKLY VIEW --}}
    <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px;">
      @foreach($weekdays as $dayNum => $dayLabel)
        <div style="border: 1px solid #444; padding: 10px;">
          <h4>{{ $dayLabel }}</h4>
          <strong>Workout:</strong><br>
          @php
            $w = $plans['workouts'][$dayNum] ?? null;
          @endphp
          @if($w)
            <p>{{ $w->workout->name ?? 'Deleted' }}</p>
          @else
            <p><em>No workout</em></p>
          @endif

          <strong>Diet:</strong><br>
          @php
            $d = $plans['diets'][$dayNum] ?? null;
          @endphp
          @if($d)
            <p>{{ $d->dietPlan->title ?? 'Deleted' }}</p>
          @else
            <p><em>No diet</em></p>
          @endif
        </div>
      @endforeach
    </div>
@endsection
