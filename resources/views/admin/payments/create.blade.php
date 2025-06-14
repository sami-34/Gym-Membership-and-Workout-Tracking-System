@extends('layouts.app')
@section('title','Add Payment')
@section('content')
  <h2>Add Payment</h2>
  <form method="POST" action="/payments">
    @csrf
    <select name="user_id">@foreach($members as $u)
      <option value="{{ $u->id }}">{{ $u->name }}</option>
    @endforeach</select>
    <input name="amount" type="number" placeholder="Amount" required>
    <input name="payment_date" type="date" required>
    <select name="status">
      <option>paid</option><option>due</option><option>pending</option>
    </select>
    <button type="submit">Save</button>
  </form>
@endsection
