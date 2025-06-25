@extends('layouts.app')
@section('title','My Plans')
@section('content')
  {{-- <h2>Assigned Workout</h2> --}}

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
    @foreach($weekdays as $dayNum => $dayLabel)
      <div style="border: 1px solid #444; padding: 15px; margin-bottom: 10px; border-radius: 8px; background: #222;">
        <h3>{{ $dayLabel }}</h3>

        {{-- Workout --}}
        @php $w = $plans['workouts'][$dayNum] ?? null; @endphp
        <div>
          <strong>Workout:</strong><br>
          @if($w)
            <p>Name: {{ $w->workout->name ?? 'Deleted' }}</p>
            <p>Reps x Sets: {{ $w->workout->reps }} x {{ $w->workout->sets }}</p>
            <p>Level: {{ ucfirst($w->workout->difficulty_level) }}</p>
            <p>Note: {{ $w->progress_notes ?? 'No notes' }}</p>
            <form method="POST" action="/myplan/mark-done/workout">
              @csrf
              <input type="hidden" name="day_of_week" value="{{ $dayNum }}">
              <button>✔️ Mark Workout Done</button>
            </form>
          @else
            <p><em>No workout</em></p>
          @endif
        </div>

        {{-- Diet --}}
        @php $d = $plans['diets'][$dayNum] ?? null; @endphp
        <div>
          <strong>Diet Plan:</strong><br>
          @if($d)
            <p>Title: {{ $d->dietPlan->title ?? 'Deleted' }}</p>
            <p>Calories: {{ $d->dietPlan->daily_calories }} kcal</p>
            <p>Meals/day: {{ $d->dietPlan->meals_per_day }}</p>
            <p>Duration: {{ $d->dietPlan->duration_weeks }} week(s)</p>
            <p>Note: {{ $d->notes ?? 'No notes' }}</p>
            <form method="POST" action="/myplan/mark-done/diet">
              @csrf
              <input type="hidden" name="day_of_week" value="{{ $dayNum }}">
              <button>✔️ Mark Diet Done</button>
            </form>
          @else
            <p><em>No diet</em></p>
          @endif
        </div>
      </div>
    @endforeach

@endsection
