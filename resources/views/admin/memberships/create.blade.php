@extends('layouts.app')
@section('title','Add Membership')
@section('content')
  <h2>Add Membership</h2>
  <form method="POST" action="/memberships">
    @csrf
    <label>Member</label>
    <select name="user_id">@foreach($members as $u)
      <option value="{{ $u->id }}">{{ $u->name }}</option>
    @endforeach</select>
    <label>Plan Name</label><input name="plan_name" required>
    @error('plan_name')
        {{$message}}
    @enderror
    <label>Price</label><input name="price" type="number" required>
    @error('price')
        {{$message}}
    @enderror
    <label>Start Date</label><input name="start_date" type="date" required>
    @error('start_date')
        {{$message}}
    @enderror
    <label>End Date</label><input name="end_date" type="date" required>
    @error('end_date')
        {{$message}}
    @enderror
    <button type="submit">Save</button>
  </form>
@endsection
