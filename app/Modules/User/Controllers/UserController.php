<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Requests\CreateUserRequest;
use App\Modules\User\Requests\UpdateUserRequest;
use App\Modules\User\Services\UserService;
use App\Modules\User\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $users = $this->service->index();
            return $this->successResponse(
                UserResource::collection($users),
                'Users retrieved successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
        }
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $user = $this->service->store($request->validated());
            
        } catch (\Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );

        }

        return $this->successResponse(
            new UserResource($user),
            'User created successfully',
            201
        );
    }

    public function show($id)
    {
        try {
            $user = $this->service->show($id);
           
        } catch (\Exception $e) {

            if ($e->getCode() === 404) {
                return $this->notFoundResponse($e->getMessage());
            }

            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
        }

        return $this->successResponse(
           new UserResource($user),
           'User retrieved successfully'
       );
    }
    
    public function update($request, $id)
    {
        try {
            $user = $this->service->update($request->validated(), $id);
           
        } catch (\Exception $e) {
            if ($e->getCode() === 404) {
                return $this->notFoundResponse($e->getMessage());
            }
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
            
        }

         return $this->successResponse(
                new UserResource($user),
                'User updated successfully'
        );
    }

    public function destroy($id)
    {
        try {
            $this->service->destroy($id);
            
        } catch (\Exception $e) {
            if ($e->getCode() === 404) {
                return $this->notFoundResponse($e->getMessage());
            }
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
        }

        return $this->successResponse(
                null,
                'User deleted successfully'
            );
    }
}