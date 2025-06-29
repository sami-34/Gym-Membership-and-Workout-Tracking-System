@extends('layouts.app')
@section('title','Manage Trainers')
@section('content')
  <h2>Trainers</h2>

  <table border="1" cellpadding="8">
    <tr>
      <th>Name</th>
      <th>Price</th>
      <th>Rating</th>
      <th>Action</th>
    </tr>
    @foreach($trainers as $t)
      <tr>
        <td>{{ $t->name }}</td>
        <td>Rs.{{ $t->trainerProfile->price_per_month }}</td>
        <td>{{ $t->trainerProfile->rating }}</td>
        <td>
          <a href="/admin/manageTrainers/{{ $t->id }}/edit">Edit</a> | 
          <a href="/admin/manageTrainers/{{ $t->id }}/delete">
            <button onclick="return confirm('Are you sure?')" style="color:red;">Delete</button>
          </a>
        </td>
      </tr>
    @endforeach
  </table>
@endsection
