<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request; 


class MembershipController extends Controller
{
    public function index() {
        $memberships = Membership::with('user')->get();
        return view('admin.memberships.index', compact('memberships'));
    }

    public function create() {
        $members = User::where('role', 'member')->get();
        return view('admin.memberships.create', compact('members'));
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_name' => 'required|string',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        Membership::create($request->all());
        return redirect()->route('memberships.index')->with('success', 'Membership created!');
    }

    public function edit($id) {
        $membership = Membership::findOrFail($id);
        $members = User::where('role', 'member')->get();
        return view('admin.memberships.edit', compact('membership', 'members'));
    }

    public function update(Request $request, $id) {
        $membership = Membership::findOrFail($id);
        $membership->update($request->all());
        return redirect('/memberships')->with('success', 'Membership updated!');
    }

    public function destroy($id) {
        Membership::destroy($id);
        return redirect('/memberships')->with('success', 'Membership deleted!');
    }
}
