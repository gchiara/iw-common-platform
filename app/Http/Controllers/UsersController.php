<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UsersController extends Controller
{
    public function download()
    {
        $users = User::all();
        $filename = "users.csv";
        $delimiter=",";
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        $f = fopen('php://output', 'w');
        fputcsv($f, array('name','email','organization','category','platform_role','contact_consent'), $delimiter);
        foreach ($users as $user) {
            $role = "user";
            if($user->is_admin) { $role = "admin"; }
            else if($user->is_editor) { $role = "editor"; }
            $line = array($user->name,$user->email,$user->org_name,$user->org_category,$role,$user->contact_consent);
            fputcsv($f, $line, $delimiter);
        }
    }

    public function manage()
    {
        //$users = User::all();
        $users = User::paginate(20);
        //$users = DB::table('users')->paginate(1);
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
        $users = User::paginate(20);
        return view('users-list', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        if($user->id == 1) {
            return view('users-list', compact('users'));
        }
        if($user->is_admin) {
            $user->is_admin = 0;
        } else {
            $user->is_admin = 1;
            $user->is_editor = 0;
        }
        $user->save();
        $users = User::paginate(20);
        return view('users-list', compact('users'));
    }

    public function delete(Request $request, User $user)
    {
        if(isset($_POST['delete']) && $user->id !== 1) {
    		$user->delete();
    	}
        $users = User::paginate(20);
        return view('users-list', compact('users'));
    }
}
