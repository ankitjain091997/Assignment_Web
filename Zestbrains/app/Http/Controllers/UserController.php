<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\EmailEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\loginRegisterRequest;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function loginOrRegister(Request $request)
    {
        $validatorResponse  = Validator::make($request->all(), [
            'name' => ['string', 'required_if:register,on'],
            'file' => ['required_if:register,on', 'image'],
            'email' => ['required', 'email'],
            'password' => ['required', 'alpha_num'],
        ]);

        if ($validatorResponse->fails()) {

            return redirect()->back()->withErrors($validatorResponse)->withInput();
        }

        $validatedData = $validatorResponse->getData();
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $image->store('public/images');
            $image = $image->getClientOriginalName();
        }
        $credentials = $request->only('email', 'password');
        $register = $request->has('register');

        if ($register) {
            $name = $request->input('name');
            $user = User::create([
                'name' => $validatedData['name'],
                'image' => $image ?? null,
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);
            event(new EmailEvent($user));
            // Additional logic for registration, such as sending a welcome email

            Auth::login($user);

            return redirect()->route('post-listing');
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('post-listing');
        }

        return redirect()->back()->withErrors(['login_error' => 'Invalid credentials.']);
    }
}