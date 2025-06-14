<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title') — Gym Tracker</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body style="background:#1e1e1e; color:#ddd; padding: 4rem; text-align: center;">

  <h1>Gym Tracker</h1>

  <div style="max-width: 400px; margin: auto; text-align: left;">
    @if(session('success'))
      <div class="flash">{{ session('success') }}</div>
    @endif
    @yield('content')
  </div>

</body>
</html>
