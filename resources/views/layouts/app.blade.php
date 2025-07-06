<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title') — Gym Tracker</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
    <nav class="sidebar hidden">
      <button class="close-btn" onclick="toggleMenu()">✖</button>
      <ul>
        {{-- DASHBOARD (one link only) --}}
        <li><a href="/dashboard">🏠Dashboard</a></li>

        {{-- ROLE-SPECIFIC NAVIGATION --}}
        @if(auth()->user()->role == 'admin')
          <li><a href="/admin/attendance">📝Attendance Report</a></li>
          <li><a href="{{ route('admin.members') }}">👤 Member Progress</a></li>
          <li><a href="/memberships">🎫Manage Memberships</a></li>
          <li><a href="/admin/manageTrainers">🧑‍🔧Manage Trainers</a></li>
          <li><a href="/payments">💳Payments</a></li>
          <li><a href="/admin/reports">📄Reports</a></li>

        @elseif(auth()->user()->role == 'trainer')
          <li><a href="/trainer/profile">👤My Profile</a></li>
          <li><a href="/workouts">🏋️Workouts</a></li>
          <li><a href="/diets">🍎Diet Plans</a></li>
          <li><a href="/assign-workout">📤Assign Workout</a></li>
          <li><a href="/assign-diet">🍽️Assign Diet</a></li>

        @elseif(auth()->user()->role == 'member')
          <li><a href="/attendance/checkin">✅Check‑In</a></li>
          <li><a href="/progress">📈My Progress</a></li>
          <li><a href="/trainers">🧑‍🏫Choose Trainer</a></li>
          <li><a href="/trainers/recommended">🌟Recommended Trainer</a></li>
          <li><a href="/myplan">🗓️My Plans</a></li>
        @endif
      </ul>
    </nav>


  <main class="content">
    @if(session('success'))
      <div class="flash">{{ session('success') }}</div>
    @endif

    @if(session('error'))
      <div class="flash error">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
      <div class="flash error">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @yield('content')
  </main>
  <script>
    function toggleMenu() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.classList.toggle('hidden');
    }
  </script>
</body>
</html>
