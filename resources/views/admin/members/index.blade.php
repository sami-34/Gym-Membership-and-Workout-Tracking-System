@extends('layouts.app')
@section('title','All Members')
@section('content')
<h2>Members</h2>
<table>
  <tr><th>Name</th><th>Email</th><th>Action</th></tr>
  @foreach($members as $m)
    <tr>
      <td>{{ $m->name }}</td>
      <td>{{ $m->email }}</td>
      <td>
        <a href="{{ route('admin.progress.view', $m->id) }}">View Progress</a>
      </td>
    </tr>
  @endforeach
</table>
@endsection
