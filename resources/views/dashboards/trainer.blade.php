@extends('layouts.app')
@section('title','Trainer Dashboard')
@section('content')
  <h2>Welcome, {{ auth()->user()->name }}</h2>

  <div class="grid-2">
    <div class="card">
      <h3>Active Members</h3>
      <p>{{ $activeCount }}</p>
    </div>
    <div class="card">
      <h3>Weekly Selections</h3>
      <canvas id="selChart"></canvas>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx3 = document.getElementById('selChart').getContext('2d');
    new Chart(ctx3, {
      type: 'line',
      data: {
        labels: {!! json_encode($weekLabels) !!},
        datasets: [{
          label: 'New Members',
          data: {!! json_encode($weekData) !!},
          borderColor: '#bbb', fill:false
        }]
      }
    });
  </script>
@endsection
