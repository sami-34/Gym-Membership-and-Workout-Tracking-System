@extends('layouts.app')
@section('title','Memberships')
@section('content')
  <h2>Memberships</h2>
  <a href="/memberships/create">+ New Membership</a>
  <table border="1" cellpadding="8">
    <tr>
      <th>Member</th>
      <th>Plan</th>
      <th>Price</th>
      <th>Start</th>
      <th>End</th>
      <th>Actions</th>
    </tr>
    @foreach($memberships as $m)
      <tr>
        <td>{{ $m->user->name }}</td>
        <td>{{ $m->plan_name }}</td>
        <td>Rs. {{ $m->price }}</td>
        <td>{{ $m->start_date }}</td>
        <td>{{ $m->end_date }}</td>
        <td>
          <a href="/memberships/{{ $m->id }}/edit">Edit</a> |
          <a href="/memberships/{{ $m->id }}/delete">
            <button onclick="return confirm('Are you sure?')" style="color:red;">Delete</button>
          </a>
        </td>
      </tr>
    @endforeach
  </table>
@endsection
