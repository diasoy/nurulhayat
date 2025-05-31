<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DapurController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('slug', 'dapur');
        })
            ->whereDoesntHave('roles', function ($q) {
                $q->where('slug', '!=', 'dapur');
            })
            ->get();

        return view('Admin.dapur.index', compact('users'));
    }

    public function create()
    {
        return view('Admin.dapur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::where('slug', 'dapur')->first();
        $user->roles()->attach($role);

        return redirect()->route('admin.dapur.index')->with('success', 'User dapur berhasil dibuat.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.dapur.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.dapur.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Pastikan role tetap dapur
        $role = Role::where('slug', 'dapur')->first();
        $user->roles()->sync([$role->id]);

        return redirect()->route('dapur-users.index')->with('success', 'User dapur berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('dapur-users.index')->with('success', 'User dapur berhasil dihapus.');
    }
}
