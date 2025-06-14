<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title') — Gym Tracker</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  {{-- <script>
    function toggleMenu() {
      const nav = document.querySelector('nav.sidebar');
      nav.style.display = nav.style.display === 'block' ? 'none' : 'block';
    }
  </script> --}}
</head>
<body>
  <header>
    <button onclick="toggleMenu()">☰</button>
    <h1>Gym Tracker</h1>
    <form action="/logout" method="POST" style="display:inline;">
      @csrf
      <button type="submit" style="background:none; border:none; color:#ccc; cursor:pointer;">
        Logout
      </button>
    </form>
  </header>

  {{-- <nav class="sidebar">
    <ul>
      @if(auth()->user()->role=='admin')
        <li><a href="{{ url('/memberships') }}">Memberships</a></li>
        <li><a href="{{ url('/payments') }}">Payments</a></li>
        <li><a href="{{ url('/admin/reports') }}">Reports</a></li>
      @elseif(auth()->user()->role=='trainer')
        <li><a href="{{ url('/trainer/profile') }}">My Profile</a></li>
        <li><a href="{{ url('/workouts') }}">Workouts</a></li>
        <li><a href="{{ url('/diets') }}">Diet Plans</a></li>
        <li><a href="{{ url('/assign-workout') }}">Assign Workout</a></li>
        <li><a href="{{ url('/assign-diet') }}">Assign Diet</a></li>
      @else
        <li><a href="{{ url('/attendance/checkin') }}">Check-In</a></li>
        <li><a href="{{ url('/progress') }}">My Progress</a></li>
        <li><a href="{{ url('/trainers') }}">Choose Trainer</a></li>
      @endif
    </ul>
  </nav> --}}

    <nav class="sidebar" style="display:none">
      <ul>
        {{-- DASHBOARD (one link only) --}}
        <li><a href="/dashboard">Dashboard</a></li>

        {{-- ROLE-SPECIFIC NAVIGATION --}}
        @if(auth()->user()->role == 'admin')
          <li><a href="/admin/attendance">Attendance Report</a></li>
          <li><a href="/memberships">Memberships</a></li>
          <li><a href="/payments">Payments</a></li>
          <li><a href="/admin/manageTrainers">Manage Trainers</a></li>
          <li><a href="/admin/reports">Reports</a></li>

        @elseif(auth()->user()->role == 'trainer')
          <li><a href="/trainer/profile">My Profile</a></li>
          <li><a href="/workouts">Workouts</a></li>
          <li><a href="/diets">Diet Plans</a></li>
          <li><a href="/assign-workout">Assign Workout</a></li>
          <li><a href="/assign-diet">Assign Diet</a></li>

        @elseif(auth()->user()->role == 'member')
          <li><a href="/attendance/checkin">Check‑In</a></li>
          <li><a href="/progress">My Progress</a></li>
          <li><a href="/trainers">Choose Trainer</a></li>
          <li><a href="/myplan">My Plans</a></li>
        @endif
      </ul>
    </nav>


  <main class="content">
    @if(session('success'))
      <div class="flash">{{ session('success') }}</div>
    @endif
    @yield('content')
  </main>
  <script>
    function toggleMenu() {
      document.querySelector('.sidebar').style.display =
        document.querySelector('.sidebar').style.display==='block'?'none':'block';
    }
  </script>
</body>
</html>
