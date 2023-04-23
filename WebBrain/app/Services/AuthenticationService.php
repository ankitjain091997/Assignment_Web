<?php

namespace App\Services;

use Auth;
use Hash;
use App\Models\User;

class AuthenticationService
{
    public function login($request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            };
            return redirect()->route('home')->with('sucess', 'Login Success');
        }
        return redirect()->back()->with('error', 'Login details are not valid');
    }

    public function coustomerRegistration($request)
    {
        $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'mobile' => ['required', 'digits:10'],
            'address' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);

        User::insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'Active',
            'role' => 'coustomer'
        ]);

        return redirect('/')->with('success', 'Sucessfully registered in');
    }

    public function editProfile()
    {
        $userId = Auth::user()->id;
        $user =  User::where('id', $userId)->first();

        return view('coustomer.editProfile', compact('user'));
    }

    public function updateProfile($request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'mobile' => ['required', 'digits:10'],
            'address' => ['required', 'string'],
        ]);

        User::whereId($request->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'email' => $request->email
        ]);

        return redirect()->route('home')->with('sucess', 'Updated succesfully');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('/');
    }
}