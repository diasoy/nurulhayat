<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('slug', 'supplier');
        })
            ->whereDoesntHave('roles', function ($q) {
                $q->where('slug', '!=', 'supplier');
            })
            ->get();

        return view('Admin.supplier.index', compact('users'));
    }

    public function create()
    {
        return view('Admin.supplier.create');
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

        $role = Role::where('slug', 'supplier')->first();
        $user->roles()->attach($role);

        return redirect()->route('admin.supplier.index')->with('success', 'User supplier berhasil dibuat.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.supplier.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.supplier.edit', compact('user'));
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

        $role = Role::where('slug', 'supplier')->first();
        $user->roles()->sync([$role->id]);

        return redirect()->route('admin.supplier.index')->with('success', 'User supplier berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.supplier.index')->with('success', 'User supplier berhasil dihapus.');
    }
}
