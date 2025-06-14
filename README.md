# 🏋️‍♂️ Gym Membership and Workout Tracking System

A Laravel-based web application to manage gym members, trainers, workouts, diet plans, payments, and performance reports.

---

## 🔧 Technologies Used

-   **Laravel** (PHP Framework)
-   **Blade Templates** (HTML + CSS)
-   **MySQL** (Database)
-   **Chart.js** (for dashboard graphs)
-   **DOMPDF** (PDF report export)

---

## 📁 Project Structure

├── app/
│ ├── Http/Controllers/ → All app logic
│ ├── Models/ → User, Membership, Payment, etc.
│
├── resources/views/ → Blade templates
│ ├── auth/ → Login & Register pages
│ ├── dashboards/ → Member, Trainer, Admin dashboards
│ ├── admin/ → Memberships, Trainers, Payments, Reports
│ ├── trainer/ → Workouts, Diets, Assign Plans
│ ├── member/ → Attendance, Progress, My Plans
│
├── routes/web.php → Application routes
├── database/migrations/ → Database schema
├── public/ → CSS, assets
├── README.md → This file

---

## 👥 User Roles

### 🧑 Member

-   Check in attendance
-   Track body progress (weight, muscle, fat)
-   View assigned workout & diet
-   Choose and rate trainer

### 🧑‍🏫 Trainer

-   Create workouts and diet plans
-   Assign plans to members who selected them
-   View dashboard of selected members and engagement

### 🛠️ Admin

-   Manage memberships and payments
-   Manage trainers (add/edit/delete)
-   Generate detailed performance reports
-   Export reports as PDF

---

## 🚀 Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/your-username/gym-tracker.git
cd gym-tracker
```

---

### 2. Install dependencies

composer install

---

### 3. Setup .env file

cp .env.example .env

Update the following lines in .env:
DB_DATABASE=gym_tracker
DB_USERNAME=root
DB_PASSWORD=
CACHE_DRIVER=file

---

### 4. Generate app key

php artisan key:generate

---

### 5. Run migrations and seeders

php artisan migrate --seed

---

### 6. Start the server

php artisan serve

visit: http://localhost:8000

---

### 🔐 Default Credentials

You can register users from the registration page or use seeded users (if added).

---

### 📦 Features

Role-based login (Admin, Trainer, Member)

Membership management

Attendance and progress logging

Workout & diet plan assignment

Trainer selection and rating

Admin dashboards with statistics and graphs

PDF export for advanced reports

---

### 📄 License

This project is for academic purposes and is not licensed for commercial use.

---

### Made with Laravel & by Mohammad Sameer Ansari

---
