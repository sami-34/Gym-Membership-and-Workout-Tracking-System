@extends('layouts.guest')
@section('title','Login')
@section('content')
  <h2>Login</h2>
  <form method="POST" action="/login">
    @csrf
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Password" required>
    <br>
    <button type="submit">Login</button><br>
    <a href="/register">Register an account  |  </a>
    <a href="{{ route('password.request') }}" style="color:#ccc;">Forgot your password?</a>
  </form>
@endsection
