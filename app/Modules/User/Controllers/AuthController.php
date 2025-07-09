<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\User\Services\AuthService;

class AuthController extends Controller
{
    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request)
    {
        $login = $this->service->login($request);

        return response()->json(['token' => $login]);
    }
    
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
