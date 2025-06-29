@extends('layouts.app')
@section('title','Admin Dashboard')
@section('content')
  <h2>Admin Overview</h2>
  <div class="grid-3">
    <div class="card"><h3>Total Users</h3><p>{{ $totalUsers }}</p></div>
    <div class="card"><h3>Active Memberships</h3><p>{{ $activeMembers }}</p></div>
    <div class="card"><h3>New This Month</h3><p>{{ $newThisMonth }}</p></div>
  </div>

  <div class="card">
    <h3>Membership Growth</h3>
    <canvas id="growthChart"  width="500" height="300"></canvas>
  </div>

  <div class="card">
    <h3>Recent Payments</h3>
    <table>
      <tr><th>Member</th><th>Amount</th><th>Date</th><th>Status</th></tr>
      @foreach($recentPayments as $p)
        <tr>
          <td>{{ $p->user->name }}</td>
          <td>Rs.{{ $p->amount }}</td>
          <td>{{ $p->payment_date }}</td>
          <td>{{ ucfirst($p->status) }}</td>
        </tr>
      @endforeach
    </table>
  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    new Chart(document.getElementById('growthChart'), {
      type: 'bar',
      data: {
        labels: {!! json_encode($monthLabels) !!},
        datasets: [{
          label: 'New Memberships',
          data: {!! json_encode($monthData) !!},
          backgroundColor: '#444'
        }]
      }
    });
  </script>
@endsection
