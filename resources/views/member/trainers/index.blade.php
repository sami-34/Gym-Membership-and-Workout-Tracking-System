@extends('layouts.app')
@section('title','Choose Trainer')
@section('content')
  <h2>Choose Your Trainer</h2>
  <form method="POST" action="/trainers/select">
    @csrf
    <select name="trainer_id">
      @foreach($trainers as $t)
        <option value="{{$t->id}}">{{ $t->name }} — Rs.{{$t->trainerProfile->price_per_month}}— Rating: {{ number_format($t->trainerProfile->rating, 2) }}</option>
      @endforeach
    </select>
    <button>Select</button>
  </form>

  @if($current)
    <h3>Your Current Trainer</h3>
    <p>{{ $current->name }}</p>
    <form method="POST" action="/trainers/rate">
      @csrf
      <label>Rate:</label>
      <select name="rating">
        @for($i=1;$i<=5;$i++)
          <option>{{$i}}</option>
        @endfor
      </select>
      <button>Submit Rating</button>
    </form>
  @endif
@endsection
