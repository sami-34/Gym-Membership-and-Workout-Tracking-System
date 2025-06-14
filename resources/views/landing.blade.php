<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Gym Tracker</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{asset('css/landing.css')}}">
</head>
<body>

  <div class="landing-header">
    <h1>🏋️ Gym Tracker</h1>
    <div class="links">
      <a href="/login">Login</a>
      <a href="/register">Register</a>
    </div>
  </div>

  <section class="hero">
    <h2>Track Your Fitness. Transform Your Life.</h2>
    <p>Welcome to Gym Tracker – the ultimate platform to manage your workouts, diet plans, attendance, and progress under professional trainers.</p>
  </section>

  <section class="features">
    <div class="feature">
      <h3>💪 Workout Plans</h3>
      <p>Get customized workout plans from professional trainers tailored just for your goals.</p>
    </div>
    <div class="feature">
      <h3>🍎 Diet Monitoring</h3>
      <p>Track your meal plans and stay on top of your nutrition game with ease.</p>
    </div>
    <div class="feature">
      <h3>📊 Progress Charts</h3>
      <p>Visualize your weight, muscle, and fat improvements with dynamic charts.</p>
    </div>
    <div class="feature">
      <h3>✅ Attendance Tracking</h3>
      <p>Check in and stay consistent — build your gym habit with accountability!</p>
    </div>
  </section>
  <footer class="site-footer">
    <div class="footer-container">
        <div class="footer-section">
        <h4>Quick Links</h4>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
        </ul>
        </div>

        <div class="footer-section">
        <h4>Contact</h4>
        <p>Email: mohammadsameer2058@gmail.com</p>
        <p>Phone: +977-9800000000</p>
        <p>Location: Hetuada, Nepal</p>
        </div>

        <div class="footer-section">
        <h4>Follow Me</h4>
        <p>
            <a href="https://github.com/sami-34" target="_blank">🐙 GitHub</a><br>
            <a href="https://linkedin.com/in/mohammad-sameer-ansari" target="_blank">💼 LinkedIn</a><br>
            <a href="https://instagram.com/_samii_34" target="_blank">📷 Instagram</a>
        </p>
        </div>
    </div>

    <hr>
    <p class="copyright">&copy; {{ date('Y') }} Gym Tracker — Built with 💪 by Mohammad Sameer Ansari</p>
    </footer>

</body>
</html>
