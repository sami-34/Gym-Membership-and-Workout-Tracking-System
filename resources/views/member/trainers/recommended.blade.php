@extends('layouts.app')
@section('title','Recommended Trainers')
@section('content')
<h2>Recommended Trainers</h2>
    <div class="trainer-card-containers">
      @forelse($scored as $data)
        <div class="trainer-card">
          <h3>{{ $data['trainer']->name }}</h3>
          <p>Desc: {{ $data['trainer']->trainerProfile->description ?? 'No description.' }}</p>
          <p>Rating: {{ $data['trainer']->trainerProfile->rating ?? 0 }} ⭐</p>
          <p>Members: {{ $data['trainer']->members->count() }} </p>
          <p>Price Per Month: Rs.{{ $data['trainer']->trainerProfile->price_per_month ?? 'N/A' }}</p>
          
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
