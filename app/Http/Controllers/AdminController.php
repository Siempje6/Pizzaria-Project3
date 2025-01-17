<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all(); 
        return view('Manager.MedewerkerOverzicht', compact('users')); 
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('Manager.MedewerkerAdd', compact('roles')); 
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);

        if ($request->role) {
            $user->assignRole($request->role);
        }

        return redirect()->route('admin.index')->with('success', 'User created successfully!');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); 
        $roles = Role::all(); 
        return view('Manager.MedewerkerEdit', compact('user', 'roles')); 
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . '|max:255',
            'password' => 'nullable|string|min:8|confirmed', 
            'role' => 'nullable|exists:roles,id', 
        ]);

        $user = User::findOrFail($id); 

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password, 
        ]);
        if ($request->role) {
            $user->syncRoles([$request->role]);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('admin.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id); 
        $user->delete(); 

        return redirect()->route('admin.index')->with('success', 'User deleted successfully!');
    }
}
