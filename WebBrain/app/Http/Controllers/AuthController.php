<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthenticationService;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    private $authService;
    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        return $this->authService->login($request);
    }

    public function registration()
    {

        return view('auth.registration');
    }

    public function coustomerRegistration(Request $request)
    {
        return $this->authService->coustomerRegistration($request);
    }


    public function editProfile()
    {
        return $this->authService->editProfile();
    }

    public function updateProfile(Request $request)
    {
        return $this->authService->updateProfile($request);
    }
    //  admin functionality 
    public function dashboard()
    {

        return redirect()->route('coustomerList');
    }

    public function logout()
    {
        return $this->authService->logout();
    }
}