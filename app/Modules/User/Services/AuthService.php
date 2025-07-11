<?php

namespace App\Modules\User\Services;
use Illuminate\Support\Facades\Auth;
use App\Modules\User\Repositories\UserRepository;

class AuthService
{
    protected $repository;
    
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function login($request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (!Auth::attempt($credentials)) {
          throw new \Exception('Invalid credentials');
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return $token;
    }

}