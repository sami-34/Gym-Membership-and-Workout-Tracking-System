@extends('layouts.app')
@section('title','Report Summary')
@section('content')
  <h2>Report Summary</h2>

  <p><strong>Report Type:</strong> {{ $request->report_type }}</p>
  <p><strong>Date Range:</strong> {{ $request->start_date }} to {{ $request->end_date }}</p>

  <hr>

  @if($request->membership_type)
    <p><strong>Membership Plan:</strong> {{ $request->membership_type }}</p>
  @else
    <p><strong>Membership Plan:</strong> All</p>
  @endif

  <hr>
  <h3>Key Data</h3>
  <ul>
    <li>Total Active Members: {{ $activeMembers }}</li>
    <li>Revenue This Period: Rs. {{ $revenue }}</li>
    <li>Membership Growth: {{ $growth }}</li>
  </ul>

  @if($request->trainer_performance == 'on')
    <hr>
    <h3>Trainer Performance</h3>
    <table>
      <tr><th>Name</th><th>Members</th></tr>
      @foreach($trainerPerformance as $trainer)
        <tr>
          <td>{{ $trainer['name'] }}</td>
          <td>{{ $trainer['members_count'] }}</td>
        </tr>
      @endforeach
    </table>
  @endif

  @if($request->report_type === 'detailed')
    <hr>
    <h3>Detailed Membership Records</h3>
    <table>
      <tr><th>Member</th><th>Plan</th><th>Start Date</th><th>End Date</th></tr>
      @foreach($detailedMembers as $m)
        <tr>
          <td>{{ $m->user->name ?? 'N/A' }}</td>
          <td>{{ $m->plan_name }}</td>
          <td>{{ $m->start_date }}</td>
          <td>{{ $m->end_date }}</td>
        </tr>
      @endforeach
    </table>

    <h3>Payment Records</h3>
    <table>
      <tr><th>Member</th><th>Amount</th><th>Status</th><th>Date</th></tr>
      @foreach($paymentDetails as $p)
        <tr>
          <td>{{ $p->user->name ?? 'N/A' }}</td>
          <td>Rs. {{ $p->amount }}</td>
          <td>{{ ucfirst($p->status) }}</td>
          <td>{{ $p->payment_date }}</td>
        </tr>
      @endforeach
    </table>
  @endif


  <br>
  <form method="POST" action="{{ route('export.pdf') }}">
    @csrf
    <input type="hidden" name="start_date" value="{{ $request->start_date }}">
    <input type="hidden" name="end_date" value="{{ $request->end_date }}">
    <input type="hidden" name="report_type" value="{{ $request->report_type }}">
    <input type="hidden" name="membership_type" value="{{ $request->membership_type }}">
    <input type="hidden" name="payment_status" value="{{ $request->payment_status }}">
    <input type="hidden" name="trainer_performance" value="{{ $request->trainer_performance }}">
    <button type="submit">Export as PDF</button>
  </form>
@endsection
