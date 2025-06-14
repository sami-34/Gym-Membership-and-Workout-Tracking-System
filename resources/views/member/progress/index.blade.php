@extends('layouts.app')
@section('title','My Progress')
@section('content')
  <h2>Progress Reports</h2>
  <form method="POST" action="/progress">
    @csrf
    <input name="weight" type="number" placeholder="Weight (kg)" required>
    <input name="body_fat" type="number" placeholder="Body Fat (%)" required>
    <input name="muscle" type="number" placeholder="Muscle Mass (kg)" required>
    <button type="submit">Log Progress</button>
  </form>

  <table>
    <tr><th>Date</th><th>Weight</th><th>Body Fat</th><th>Muscle</th></tr>
    @foreach($progress as $p)
      <tr>
        <td>{{ $p->recorded_date }}</td>
        <td>{{ $p->weight }}</td>
        <td>{{ $p->body_fat_percentage }}</td>
        <td>{{ $p->muscle_mass }}</td>
      </tr>
    @endforeach
  </table>
  @if($latest)
  <div class="card">
    <h3>Latest Body Composition</h3>
    <canvas id="compChart"></canvas>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx2 = document.getElementById('compChart').getContext('2d');
    new Chart(ctx2, {
      type: 'pie',
      data: {
        labels: ['Weight','Body Fat','Muscle'],
        datasets: [{
          data: [
            {{ $latest->weight }},
            {{ $latest->body_fat_percentage }},
            {{ $latest->muscle_mass }}
          ],
          backgroundColor: ['#666','#444','#888']
        }]
      }
    });
  </script>
@else
  <p>No progress data available yet.</p>
@endif
@endsection
