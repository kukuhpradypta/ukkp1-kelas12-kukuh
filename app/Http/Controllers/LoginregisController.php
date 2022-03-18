<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class LoginregisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('id')) {
            return redirect('/');
        }
        return view('loginregis.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'nik'      => 'required|min:3|max:255|unique:users',
            'email'     => 'required|email:dns|unique:users',
            'password'  => 'required|min:3|max:255',
        ]);

        //upload foto

        $user = User::create([
            'name'     => $request->name,
            'nik'     => $request->nik,
            'foto'     => 'default.png',
            'email'     => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            //redirect dengan pesan sukses
            return redirect('/loginregis')->with('registerSuccess', 'Registration successfull! Please login');
        } else {
            //redirect dengan pesan error
            return redirect('/loginregis')->with('registerError', 'Registration Failled! Check Register Page!');
        }
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->put('id', Auth::id());
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->with('loginError', 'Login Failed!');
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/loginregis');
    }
}
