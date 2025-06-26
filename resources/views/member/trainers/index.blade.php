@extends('layouts.app')
@section('title','Choose Trainer')
@section('content')

  <h2>Find Your Trainer</h2>

  <form method="GET" action="/trainers" style="margin-bottom: 1rem;">
    <label for="rating">Rating:</label>
    <input type="number" step="0.1" name="rating" placeholder="Min Rating (e.g. 3.5)" value="{{ $filters['rating'] ?? '' }}">
    <label for="price">Price:</label>
    <input type="number" name="price" placeholder="Max Price (Rs.)" value="{{ $filters['price'] ?? '' }}">
    <button type="submit">Search</button>
  </form>

  @if($trainers->isEmpty())
    <p>No trainers found based on your filters.</p>
  @else
    <div class="trainer-card-container">
      @foreach($trainers as $t)
        <div class="trainer-card">
          <h3>{{ $t->name }}</h3>
          <p><strong>Rating:</strong> {{ number_format($t->trainerProfile->rating, 2) }} ⭐</p>
          <p><strong>Price Per Month:</strong> Rs.{{ $t->trainerProfile->price_per_month }}</p>
          <p><strong>Experience:</strong> {{ $t->trainerProfile->experience_years }} years</p>
          <p><strong>Specialization:</strong> {{ ucfirst($t->trainerProfile->specialization) }}</p>
          <p><strong>Workout Types:</strong> {{ $t->trainerProfile->workout_types }}</p>
          <p>{{ $t->trainerProfile->description ?? 'No description.' }}</p>
          {{-- @if(isset($t->score))
            <p><strong>Score:</strong> <span class="score">{{ number_format($t->score, 2) }}</span></p>
          @endif --}}

          @if($current && $current->id == $t->id)
            <p class="current-badge">✔️ Selected Trainer</p>
          @else
            <form method="POST" action="/trainers/select">
              @csrf
              <input type="hidden" name="trainer_id" value="{{ $t->id }}">
              <button class="select-btn">Select</button>
            </form>
          @endif
        </div>
      @endforeach
    </div>
  @endif

  @if($current)
    <hr>
    <h3>Your Current Trainer</h3>
    <p>{{ $current->name }}</p>

    <form method="POST" action="/trainers/rate">
      @csrf
      <label>Rate:</label>
      <select name="rating">
        @for($i=1; $i<=5; $i++)
          <option>{{ $i }}</option>
        @endfor
      </select>
      <button>Submit Rating</button>
    </form>
    <form method="POST" action="/trainers/unselect">
      @csrf
      <button type="submit" style="margin-top: 0.5rem; background: darkred; color: white;">Remove Trainer</button>
    </form>

  @endif
@endsection