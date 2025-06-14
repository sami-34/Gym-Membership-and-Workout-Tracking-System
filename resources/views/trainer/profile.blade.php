@extends('layouts.app')
@section('title','My Profile')
@section('content')
  <h2>Edit Profile</h2>
  <form method="POST" action="{{ route('trainer.profile.update') }}">
    @csrf
    <label>Price / Month</label>
    <input name="price_per_month" type="number" value="{{ $profile->price_per_month }}" required>
    <label>Description</label>
    <textarea name="description" required>{{ $profile->description }}</textarea>
    <button type="submit">Update</button>
  </form>
@endsection
