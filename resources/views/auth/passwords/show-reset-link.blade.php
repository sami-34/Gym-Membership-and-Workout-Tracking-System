@extends('layouts.guest')

@section('title', 'Reset Link')

@section('content')
  <h2>Password Reset Link</h2>
  <p>This link will expire in <strong>{{ $expires }}</strong> minutes.</p>
  <p>Click the link below to reset your password:</p>
  <p><a href="{{ $resetUrl }}" target="_blank">{{ $resetUrl }}</a></p>
  <br>
  <a href="/login">← Back to Login</a>
@endsection
