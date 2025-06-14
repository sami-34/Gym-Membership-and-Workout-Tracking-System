@extends('layouts.app')
@section('title','Diet Plans')
@section('content')
  <h2>My Diet Plans</h2>
  <a href="/diets/create">+ New Diet Plan</a>
  <ul>
    @foreach($diets as $d)
      <li>{{ $d->title }} — {{ Str::limit($d->description, 50) }}</li>
    @endforeach
  </ul>
@endsection
