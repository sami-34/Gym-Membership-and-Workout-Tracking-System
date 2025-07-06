<!DOCTYPE html>
<html>
<head>
  <title>Gym Report</title>
  <style>
    body { font-family: sans-serif; }
    h2, h3 { margin-top: 0.5em; }
    table { width: 100%; border-collapse: collapse; margin-top: 1em; }
    table, th, td { border: 1px solid #444; }
    th, td { padding: 8px; text-align: left; }
  </style>
</head>
<body>
  <h2>Gym Report Summary</h2>
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

</body>
</html>
