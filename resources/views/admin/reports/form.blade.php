@extends('layouts.app')
@section('title','Generate Report')
@section('content')
  <h2>Generate Report</h2>
  <form method="POST" action="/admin/reports">
    @csrf
    <label>Report Type:</label>
    <select name="report_type" required>
      <option value="summary">Summary</option>
      <option value="detailed">Detailed</option>
    </select><br><br>

    <label>Start Date:</label>
    <input type="date" name="start_date" required><br><br>

    <label>End Date:</label>
    <input type="date" name="end_date" required><br><br>

    <label>Plan Name (optional):</label>
    <select name="membership_type">
      <option value="">All</option>
      @foreach($planNames as $plan)
        <option value="{{ $plan }}">{{ $plan }}</option>
      @endforeach
    </select><br><br>

    <label>Payment Status (optional):</label>
    <select name="payment_status">
      <option value="">All</option>
      <option value="paid">Paid</option>
      <option value="unpaid">Unpaid</option>
    </select><br><br>

    <label>Include Trainer Performance:</label>
    <input type="checkbox" name="trainer_performance"><br><br>

    <button type="submit">Generate</button>
  </form>
@endsection
