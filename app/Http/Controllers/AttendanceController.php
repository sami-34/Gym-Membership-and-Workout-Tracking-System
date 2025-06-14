<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;


class AttendanceController extends Controller
{
    public function index() {
        return view('member.attendance');
    }

    public function checkin(Request $request) {
        Attendance::create([
            'user_id' => auth()->id(),
            'date' => now()->toDateString(),
            'status' => 'present',
            'check_in_time' => now()->toTimeString(),
        ]);
        return redirect('/attendance/checkin')->with('success', 'You have successfully checked in!');
    }
}
