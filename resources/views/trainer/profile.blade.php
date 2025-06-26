@extends('layouts.app')
@section('title','My Profile')
@section('content')
  <h2>Edit Profile</h2>

  <form method="POST" action="{{ route('trainer.profile.update') }}">
    @csrf

    <label>Name</label>
    <input name="name" type="text" value="{{ auth()->user()->name }}" required><br>

    <label>Price / Month (Rs)</label>
    <input name="price_per_month" type="number" value="{{ $profile->price_per_month }}" required><br>

    <label>Experience (Years)</label>
    <input name="experience_years" type="number" value="{{ $profile->experience_years }}" required><br>

    <label>Specialization</label>
    <select name="specialization" required>
      @foreach(['weight loss','muscle gain','rehabilitation','functional training','sports specific'] as $s)
        <option value="{{ $s }}" {{ $profile->specialization == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
      @endforeach
    </select><br>

    <label>Workout Type</label><br>
    <select name="workout_types" required>
      @foreach(['HIIT','Yoga','Cardio','Pilates','Strength'] as $w)
        <option value="{{ $w }}" {{ $profile->workout_types == $s ? 'selected' : '' }}>{{ ucfirst($w) }}</option>
      @endforeach
    </select><br>

    <label>Professional Bio</label><br>
    <textarea name="description" required class="notes-textarea">{{ $profile->description }}</textarea><br>

    <button type="submit">Update Profile</button>
  </form>
@endsection
