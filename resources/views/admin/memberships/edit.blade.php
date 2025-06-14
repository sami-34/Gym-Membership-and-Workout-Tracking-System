@extends('layouts.app')
@section('title','Edit Membership')
@section('content')
  <h2>Edit Membership</h2>
  <form method="POST" action="/memberships/{{ $membership->id }}">
    @csrf
    <select name="user_id">
      @foreach($members as $u)
        <option value="{{ $u->id }}" {{ $u->id==$membership->user_id?'selected':'' }}>{{ $u->name }}</option>
      @endforeach
    </select>
    <input name="plan_name" value="{{ $membership->plan_name }}" required>
    <input name="price" type="number" value="{{ $membership->price }}" required>
    <input name="start_date" type="date" value="{{ $membership->start_date }}" required>
    <input name="end_date" type="date" value="{{ $membership->end_date }}" required>
    <button type="submit">Update</button>
  </form>
@endsection
