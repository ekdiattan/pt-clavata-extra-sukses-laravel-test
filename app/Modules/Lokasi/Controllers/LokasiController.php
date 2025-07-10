<?php

namespace App\Modules\Lokasi\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Modules\Lokasi\Services\LokasiService;
use App\Modules\Lokasi\Resources\LokasiResource;
use App\Modules\Lokasi\Requests\CreateLokasiRequest;
use App\Modules\Lokasi\Requests\UpdateLokasiRequest;

class LokasiController extends Controller
{
    protected $service;

    public function __construct(LokasiService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {

            $lokasi = $this->service->index();

            return $this->successResponse(
                LokasiResource::collection($lokasi),
                'Lokasi retrieved successfully'
            );

        } catch (\Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
        }
    }

    public function store(CreateLokasiRequest $request)
    {
        try {

            DB::beginTransaction();
            $lokasi = $this->service->store($request);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
            
        }

        DB::commit();
        return $this->successResponse(
            new LokasiResource($lokasi),
            'Lokasi created successfully',
            201
        );
    }

    public function show($id)
    {
        try {

            $lokasi = $this->service->show($id);

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
           new LokasiResource($lokasi),
           'Lokasi retrieved successfully'
       );
    }

    public function update($id, UpdateLokasiRequest $request)
    {
        try {
            
            $lokasi = $this->service->update($request, $id);
            
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
                new LokasiResource($lokasi),
                'Lokasi updated successfully'
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
                'Lokasi deleted successfully'
            );
    }
}