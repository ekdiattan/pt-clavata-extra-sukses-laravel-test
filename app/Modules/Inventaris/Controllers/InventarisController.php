<?php

namespace App\Modules\Inventaris\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Modules\Inventaris\Services\InventarisService;
use App\Modules\Inventaris\Resources\InventarisResource;
use App\Modules\Inventaris\Requests\CreateInventarisRequest;
use App\Modules\Inventaris\Requests\UpdateInventarisRequest;

class InventarisController extends Controller
{
    protected $service;

    public function __construct(InventarisService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {

            $Inventaris = $this->service->index();

            return $this->successResponse(
                InventarisResource::collection($Inventaris),
                'Inventaris retrieved successfully'
            );

        } catch (\Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
        }
    }

    public function store(CreateInventarisRequest $request)
    {
        try {

            DB::beginTransaction();
            $Inventaris = $this->service->store($request);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
            
        }

        DB::commit();
        return $this->successResponse(
            new InventarisResource($Inventaris),
            'Inventaris created successfully',
            201
        );
    }

    public function show($id)
    {
        try {

            $Inventaris = $this->service->show($id);

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
           new InventarisResource($Inventaris),
           'Inventaris retrieved successfully'
       );
    }

    public function update($id, UpdateInventarisRequest $request)
    {
        try {
            
            $Inventaris = $this->service->update($request, $id);
            
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
                new InventarisResource($Inventaris),
                'Inventaris updated successfully'
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
                'Inventaris deleted successfully'
            );
    }
}