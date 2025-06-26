@extends('layouts.app')
@section('title','Recommended Trainers')
@section('content')
<h2>Recommended Trainers</h2>
    <div class="trainer-card-containers">
      @forelse($scored as $data)
        <div class="trainer-card">
          <h3>{{ $data['trainer']->name }}</h3>
          <p><strong>Rating:</strong> {{ $data['trainer']->trainerProfile->rating ?? 0 }} ⭐</p>
          <p><strong>Members:</strong> {{ $data['trainer']->members->count() }} </p>
          <p><strong>Price Per Month:</strong> Rs.{{ $data['trainer']->trainerProfile->price_per_month ?? 'N/A' }}</p>
          <p><strong>Experience:</strong> {{ $data['trainer']->trainerProfile->experience_years }} years</p>
          <p><strong>Specialization:</strong> {{ ucfirst($data['trainer']->trainerProfile->specialization) }}</p>
          <p><strong>Workout Types:</strong> {{ $data['trainer']->trainerProfile->workout_types }}</p>
          <p> {{ $data['trainer']->trainerProfile->description ?? 'No description.' }}</p>
          
          <p><strong>Score:</strong> <span class="score">{{ $data['score'] }}</span></p>
          @if($currentTrainer && $currentTrainer->id == $data['trainer']->id)
            <p class="current-badge">✔️ Selected Trainer</p>
          @else
            <form method="POST" action="/trainers/select">
              @csrf
              <input type="hidden" name="trainer_id" value="{{ $data['trainer']->id }}">
              <button class="select-btn">Select</button>
            </form>
          @endif
        </div>
        @empty
            <p>No trainers found.</p>
      @endforelse
    </div>
@endsection
