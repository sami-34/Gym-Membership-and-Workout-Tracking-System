<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\MemberWorkout;
use App\Models\Membership;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function memberDashboard()
    {
        $userId = auth()->id();

        
        $att = Attendance::where('user_id', $userId)
                ->selectRaw('date, 1 as present')->get();
        $attLabels = $att->pluck('date');
        $attData   = $att->pluck('present');

        
        $attCount = Attendance::where('user_id', $userId)->count();
        $totalDays = now()->day;

        $trainer = User::find(auth()->user()->trainer_id);

        
        return view('dashboards.member', compact('attCount', 'totalDays', 'trainer'));
    }

    public function trainerDashboard(){
        $activeCount = User::where('trainer_id',auth()->id())->count();
        $weekLabels = []; $weekData = [];
        for($i=6;$i>=0;$i--){
        $day = now()->subDays($i)->format('D');
        $weekLabels[] = $day;
        $weekData[]   = MemberWorkout::whereHas('user',fn($q)=>$q->where('trainer_id',auth()->id()))
                        ->whereDate('created_at', now()->subDays($i)->toDateString())
                        ->count();
        }
        return view('dashboards.trainer',compact('activeCount','weekLabels','weekData'));

    }
    
    public function adminDashboard() {
        $totalUsers     = User::where('role', 'member')->count();
        $activeMembers  = Membership::where('status', 'active')->count();
        $newThisMonth   = User::whereMonth('created_at', now()->month)->count();
        $recentPayments = Payment::with('user')->orderBy('payment_date', 'desc')->limit(5)->get();

        $monthLabels = [];
        $monthData   = [];
        foreach (['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $i => $m) {
            $monthLabels[] = $m;
            $monthData[]   = Membership::whereMonth('start_date', $i + 1)->count();
        }

        return view('dashboards.admin', compact(
            'totalUsers', 'activeMembers', 'newThisMonth',
            'recentPayments', 'monthLabels', 'monthData'
        ));
    }
}
