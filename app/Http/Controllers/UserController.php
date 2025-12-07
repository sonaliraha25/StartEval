<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}
