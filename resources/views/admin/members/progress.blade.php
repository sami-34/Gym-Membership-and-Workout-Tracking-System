@extends('layouts.app')
@section('title','Progress Report')
@section('content')
<h2>Progress of {{ $user->name }}</h2>

@if($progress->isEmpty())
  <p>No progress data found for this member.</p>
@else
  <table>
    <tr><th>Date</th><th>Weight</th><th>Body Fat (%)</th><th>Muscle Mass</th></tr>
    @foreach($progress as $p)
      <tr>
        <td>{{ $p->recorded_date }}</td>
        <td>{{ $p->weight }} kg</td>
        <td>{{ $p->body_fat_percentage }}%</td>
        <td>{{ $p->muscle_mass }} kg</td>
      </tr>
    @endforeach
  </table>
@endif

<a href="{{ route('admin.members') }}">← Back to Members</a>
@endsection
