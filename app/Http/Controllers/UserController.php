<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = User::query();
        
        // Apply search filter if search parameter exists
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        
        // Get paginated results
        $users = $query->orderBy('name')->paginate(10);
        
        return view('users.index', compact('users'));
    }


    public function show(User $user)
    {
        return view('users.show' ,compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'is_admin' => 'required'
        ]);

        User::create($validated);
        return redirect()->route('users.index')->with('success', 'user created successfully');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'is_admin' => 'required'
        ]);

        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        try{
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully');

        }catch(\Exception $e){
            return redirect()->back()->with('errors', 'User cannot be deleted please clear all dependencies');
        }
    }
}
    

