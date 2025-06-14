@extends('layouts.app')
@section('title','Payments')
@section('content')
  <h2>Payments</h2>
  <a href="/payments/create">+ Record Payment</a>
  <table>
    <tr><th>Member</th><th>Amount</th><th>Date</th><th>Status</th></tr>
    @foreach($payments as $p)
      <tr>
        <td>{{ $p->user->name }}</td>
        <td>Rs. {{ $p->amount }}</td>
        <td>{{ $p->payment_date }}</td>
        <td>{{ ucfirst($p->status) }}</td>
      </tr>
    @endforeach
  </table>
@endsection
