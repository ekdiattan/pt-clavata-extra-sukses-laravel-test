<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        try {

            $login = $this->service->login($request);

        } catch (\Exception $e) {

            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
            
        }

        return $this->successResponse(
            $login,
            'User has logged in successfully!',
            201
        );
    }
    
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
