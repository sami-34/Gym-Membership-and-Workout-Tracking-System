<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProgressReport;
use Illuminate\Http\Request;

class AdminProgressController extends Controller
{
    public function members()
    {
        $members = User::where('role', 'member')->get();
        return view('admin.members.index', compact('members'));
    }

    public function view(User $user)
    {
        $progress = ProgressReport::where('user_id', $user->id)->orderBy('recorded_date', 'desc')->get();
        return view('admin.members.progress', compact('user', 'progress'));
    }
}
