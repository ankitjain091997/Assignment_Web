<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\coustomerService;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthenticationService;

class CoustomerController extends Controller
{
    private $coustomerService;

    public function __construct(coustomerService $coustomerService)
    {
        $this->coustomerService = $coustomerService;
    }

    public function coustomerList()
    {

        return $this->coustomerService->coustomerList();
    }

    public function coustomerDestroy(Request $request, $id)
    {
        return $this->coustomerService->coustomerDestroy($request, $id);
    }

    public function coustomerMulipleDestroy(Request $request)
    {
        return $this->coustomerService->coustomerMulipleDestroy($request);
    }

    public function coustomerStatus(Request $request)
    {
        return $this->coustomerService->coustomerStatus($request);
    }
}