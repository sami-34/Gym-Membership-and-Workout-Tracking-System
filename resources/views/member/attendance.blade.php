@extends('layouts.app')
@section('title','Check‑In')
@section('content')
  <h2>Welcome Back, {{ auth()->user()->name }}!</h2>
  <p>Today: {{ now()->format('F j, Y') }}</p>
  <p>“Keep pushing your limits!”</p>
  <form method="POST" action="/attendance/checkin">
    @csrf
    <button>Check In Now</button>
  </form>
@endsection
