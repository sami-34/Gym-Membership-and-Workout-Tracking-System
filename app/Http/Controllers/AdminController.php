<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\Attendance;
use App\Models\TrainerProfile;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function attendanceReport() {
        $today = now()->toDateString();
        $present = Attendance::where('date', $today)->pluck('user_id')->toArray();
        $allMembers = User::where('role', 'member')->get();

        return view('admin.attendance', compact('present', 'allMembers'));
    }

    public function manageTrainers(){
        $trainers = User::where('role','trainer')->with('trainerProfile')->get();
        return view('admin.trainers.index', compact('trainers'));
    }

    public function editTrainer($id) {
        $trainer = User::where('role','trainer')->with('trainerProfile')->findOrFail($id);
        return view('admin.trainers.edit', compact('trainer'));
    }

    public function updateTrainer(Request $request, $id) {
        $request->validate([
            'price_per_month' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'nullable|string|max:255',
        ]);

        $trainer = User::findOrFail($id);
        $profile = $trainer->trainerProfile;

        $profile->update([
            'price_per_month' => $request->price_per_month,
            'rating' => $request->rating,
            'description' => $request->description
        ]);

        return redirect('/admin/manageTrainers')->with('success', 'Trainer updated successfully.');
    }

    public function deleteTrainer($id) {
        $trainer = User::where('role', 'trainer')->findOrFail($id);

        // Detach members who selected this trainer
        User::where('trainer_id', $trainer->id)->update(['trainer_id' => null]);

        // Delete profile and trainer
        $trainer->trainerProfile?->delete();
        $trainer->delete();

        return redirect('/admin/manageTrainers')->with('success', 'Trainer deleted successfully.');
    }

    public function reportForm() {
        $planNames = Membership::select('plan_name')->distinct()->pluck('plan_name');
        if ($planNames->isEmpty()) {
            $planNames = collect(['Monthly Plan', 'Yearly Plan', '6-Month Plan']);
        }
        return view('admin.reports.form', compact('planNames'));
    }

    /*
        *ALGORITHM USED: Custom sorting algorithm (Bubble Sort) to simulates a comparison-based sorting algorithm like Bubble Sort or Merge Sort.  
    */
    private function bubbleSortTrainers(array $trainers){
        for ($i = 0; $i < count($trainers) - 1; $i++) {
            for ($j = 0; $j < count($trainers) - $i - 1; $j++) {
                if ($trainers[$j]['members_count'] < $trainers[$j + 1]['members_count']) {
                    $temp = $trainers[$j];
                    $trainers[$j] = $trainers[$j + 1];
                    $trainers[$j + 1] = $temp;
                }
            }
        }
        return $trainers;
    }

    public function generateReport(Request $request) {
        $request->validate([
            'report_type' => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'membership_type' => 'nullable',
            'payment_status'  => 'nullable',
            'trainer_performance' => 'nullable'
        ]);

        $activeMembers = Membership::whereBetween('start_date', [$request->start_date, $request->end_date])
            ->when($request->membership_type, fn($q) => $q->where('plan_name', $request->membership_type))
            ->count();

        $revenue = Payment::whereBetween('payment_date', [$request->start_date, $request->end_date])
            ->when($request->payment_status, fn($q) => $q->where('status', $request->payment_status))
            ->sum('amount');

        $growth = Membership::whereBetween('start_date', [$request->start_date, $request->end_date])->count();
        $trainerPerformance = [];

        if ($request->trainer_performance == 'on') {
            $allTrainers = User::where('role', 'trainer')->withCount('members')->get()->toArray();

            // - Custom Sorting Algorithm:
            $allTrainers = $this->bubbleSortTrainers($allTrainers);

            $trainerPerformance = collect($allTrainers); // Convert back to collection
        }

        return view('admin.reports.result', compact(
            'activeMembers', 'revenue', 'growth', 'trainerPerformance', 'request'
        ));
    }

    

    public function exportPDF(Request $request)
    {
        $activeMembers = Membership::whereBetween('start_date', [$request->start_date, $request->end_date])
            ->when($request->membership_type, fn($q) => $q->where('plan_name', $request->membership_type))
            ->count();

        $revenue = Payment::whereBetween('payment_date', [$request->start_date, $request->end_date])
            ->when($request->payment_status, fn($q) => $q->where('status', $request->payment_status))
            ->sum('amount');

        $growth = Membership::whereBetween('start_date', [$request->start_date, $request->end_date])->count();
        $trainerPerformance = [];

        if ($request->trainer_performance == 'on') {
            $allTrainers = User::where('role', 'trainer')->withCount('members')->get()->toArray();

            // - Custom Sorting Algorithm:
            $allTrainers = $this->bubbleSortTrainers($allTrainers);

            $trainerPerformance = collect($allTrainers); // Convert back to collection
        }


        $pdf = Pdf::loadView('admin.reports.pdf', [
            'activeMembers' => $activeMembers,
            'revenue' => $revenue,
            'growth' => $growth,
            'trainerPerformance' => $trainerPerformance,
            'request' => $request
        ]);

        return $pdf->download('gym_report_' . now()->format('Ymd_His') . '.pdf');
    }

}
