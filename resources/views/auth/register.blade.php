@extends('layouts.guest')
@section('title','Register')
@section('content')
  <h2>Register</h2>
  <form method="POST" action="/register">
    @csrf
    <input name="name" type="text" placeholder="Full Name" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Password" required>
    <input name="password_confirmation" type="password" placeholder="Confirm Password" required>
    <br>
    <select name="role" required>
      <option value="member">Member</option>
      <option value="trainer">Trainer</option>
    </select>
    <br>
    <button type="submit">Register</button><br>
    <a href="/login">Already have an account? Login</a>
  </form>
  
@endsection
