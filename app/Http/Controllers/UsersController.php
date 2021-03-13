<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function manage()
    {
        $users = User::all();
        return view('users-list', compact('users'));
    }

    public function toggleEditor(User $user)
    {
        if($user->is_editor) {
            $user->is_editor = 0;
        } else {
            $user->is_editor = 1;
        }
        $user->save();
        $users = User::all();
        return view('users-list', compact('users'));
    }

    public function delete(Request $request, User $user)
    {
        if(isset($_POST['delete'])) {
    		$user->delete();
    	}
        $users = User::all();
        return view('users-list', compact('users'));
    }
}
