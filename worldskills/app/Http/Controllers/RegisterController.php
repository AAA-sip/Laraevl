<?php
//
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'name' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->save();


        return redirect('/')->with('success', 'Registration successful!');
    }

    public function register(){
        return view('register');
    }
}
