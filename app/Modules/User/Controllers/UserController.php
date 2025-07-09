<?php

namespace App\Modules\User\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Modules\User\Services\UserService;
use App\Modules\User\Resources\UserResource;
use App\Modules\User\Requests\CreateUserRequest;
use App\Modules\User\Requests\UpdateUserRequest;

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

            DB::beginTransaction();
            $user = $this->service->store($request);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
            
        }

        DB::commit();
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

    public function update($id, UpdateUserRequest $request)
    {
        try {

            $user = $this->service->update($request, $id);
            
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