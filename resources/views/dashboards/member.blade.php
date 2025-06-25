@extends('layouts.app')
@section('title','Member Dashboard')
@section('content')
  <h2>Welcome, {{ auth()->user()->name }}</h2>

  <div class="grid-2">
    <div class="card">
      <h3>Attendance</h3>
      <p>Days Present: {{ $attCount }} / {{ $totalDays }}</p>
    </div>

    <div class="card">
      <h3>Your Current Selected Trainer</h3>
      @if($trainer)
        <p>{{ $trainer->name }}</p>
        <p>Price Per Month: Rs. {{ $trainer->trainerProfile->price_per_month ?? 'N/A' }}</p>
        <p>Rating: {{ $trainer->trainerProfile->rating ?? 'N/A' }} ⭐</p>
      @else
        <p><a href="/trainers">Choose a Trainer</a></p>
      @endif
    </div>
  </div>
@endsection
