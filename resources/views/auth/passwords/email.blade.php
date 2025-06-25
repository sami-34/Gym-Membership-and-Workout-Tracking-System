@extends('layouts.guest')
@section('title', 'Forgot Password')

@section('content')
<h2>Forgot Your Password?</h2>

<form method="POST" action="{{ route('password.email') }}">
  @csrf
  <label for="email">Enter your registered email:</label>
  <input type="email" name="email" required>
  <button type="submit">Send Password Reset Link</button>
</form>

<a href="/login">Back to Login</a>
@endsection
