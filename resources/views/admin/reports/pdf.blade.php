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
          <td>{{ $trainer->name }}</td>
          <td>{{ $trainer->members_count }}</td>
        </tr>
      @endforeach
    </table>
  @endif
</body>
</html>
