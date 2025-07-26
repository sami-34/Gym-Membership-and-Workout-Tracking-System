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

  <h2>Your Progress Report (Sorted by Muscle %)</h2>
  <table>
    <tr><th>Date</th><th>Weight</th><th>Body Fat</th><th>Muscle</th></tr>
    @foreach($progress as $p)
      <tr>
        <td>{{ $p['recorded_date'] }}</td>
        <td>{{ $p['weight'] }}</td>
        <td>{{ $p['body_fat_percentage'] }}</td>
        <td>{{ $p['muscle_mass'] }}</td>
      </tr>
    @endforeach
  </table>

  @if(count($smoothed))
    <h2>Smoothed Muscle Trend (3-Day Moving Average)</h2>
    <table>
      <tr><th>Date</th><th>Smoothed Muscle Mass (kg)</th></tr>
      @foreach($smoothed as $entry)
        <tr>
          <td>{{ $entry['date'] }}</td>
          <td>{{ $entry['smoothed_muscle'] }}</td>
        </tr>
      @endforeach
    </table>
  @endif

  @if($latest)
    <div class="card">
      <h3>Body Composition</h3>
      <div style="max-width: 400px; margin: auto;">
        <canvas id="compChart" width="300" height="300"></canvas>
      </div>
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
