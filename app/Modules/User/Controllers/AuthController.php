<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\User\Requests\LoginRequest;
use App\Modules\User\Services\AuthService;

class AuthController extends Controller
{
    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequest $request)
    {
        try {

            $login = $this->service->login($request);

        } catch (\Exception $e) {

            return $this->errorResponse($e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Login successfully',
            'token' => $login
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
