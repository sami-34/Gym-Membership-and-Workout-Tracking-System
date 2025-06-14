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
        $today = now()->toDateString();
        $userId = auth()->id();

        // Check if the user has already checked in today
        $alreadyCheckedIn = Attendance::where('user_id', $userId)
                            ->where('date', $today)
                            ->exists();

        if (!$alreadyCheckedIn) {
            Attendance::create([
                'user_id' => $userId,
                'date' => $today,
                'status' => 'present',
                'check_in_time' => now()->toTimeString(),
            ]);
            return redirect('/attendance/checkin')->with('success', 'You have successfully checked in!');
        }

        return redirect('/attendance/checkin')->with('success', 'You already checked in today.');
    }
}
