<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JustController extends Controller
{

    //profile
    public function profile()
    {
        $user = auth()->user();
        $contents = Content::where('user_id', $user->id)->get();
        return view('profile', compact('user', 'contents'));
    }
    //profile

    //admin
    public function admin()
    {

        $user = auth()->user();
        $users = User::all();

        return view('admin', compact('users','user'));
    }
    //admin


    //create

    //create



    //dashboard

    //dashboard



    public function banUser(User $user)
    {
        // Check if the user is currently banned or not
        if ($user->is_banned) {
            // If user is already banned, unban them
            $user->update(['is_banned' => false]);
            return redirect()->back()->with('success', 'User has been unbanned successfully!');
        } else {
            // If user is not banned, ban them
            $user->update(['is_banned' => true]);
            return redirect()->back()->with('success', 'User has been banned successfully!');
        }
    }


}
