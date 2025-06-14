@extends('layouts.app')
@section('title', 'Attendance Report')
@section('content')
  <h2>Today's Attendance ({{ now()->format('F j, Y') }})</h2>

  <table>
    <tr>
      <th>Member Name</th>
      <th>Status</th>
    </tr>
    @foreach($allMembers as $member)
      <tr>
        <td>{{ $member->name }}</td>
        <td>
          @if(in_array($member->id, $present))
            ✅ Present
          @else
            ❌ Absent
          @endif
        </td>
      </tr>
    @endforeach
  </table>
@endsection
