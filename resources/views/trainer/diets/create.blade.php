@extends('layouts.app')
@section('title','Add Diet Plan')
@section('content')
  <h2>Add Diet Plan</h2>
  <form method="POST" action="/diets">
    @csrf
    <input name="title" type="text" placeholder="Diet Plan Title" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <button type="submit">Save</button>
  </form>
@endsection
