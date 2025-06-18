@extends('layouts.app')
@section('title','Edit Trainer')
@section('content')
    <h2>Edit Trainer: {{ $trainer->name }}</h2>
    <form method="POST" action="/admin/manageTrainers/{{ $trainer->id }}}}">
    @csrf
    @method('PUT')
    
    <label>Price per Month</label>
    <input type="number" name="price_per_month" value="{{ $trainer->trainerProfile->price_per_month }}" required>

    <label>Rating</label>
    <input type="number" step="0.1" max="5" name="rating" value="{{ $trainer->trainerProfile->rating }}">

    <label>Description</label>
    <textarea name="description">{{ $trainer->trainerProfile->description }}</textarea>

    <button type="submit">Update</button>
    </form>
@endsection