<?php

namespace App\Modules\ProdukLokasi\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Modules\ProdukLokasi\Services\ProdukLokasiService;
use App\Modules\ProdukLokasi\Resources\ProdukLokasiResource;
use App\Modules\ProdukLokasi\Requests\CreateProdukLokasiRequest;
use App\Modules\ProdukLokasi\Requests\UpdateProdukLokasiRequest;

class ProdukLokasiController extends Controller
{
    protected $service;

    public function __construct(ProdukLokasiService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $produkLokasi = $this->service->index();
        } catch (\Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
        }

        return $this->successResponse(
                ProdukLokasiResource::collection($produkLokasi),
                'ProdukLokasi retrieved successfully'
            );
    }

    public function store(CreateProdukLokasiRequest $request)
    {
        try {

            DB::beginTransaction();
            $produkLokasi = $this->service->store($request);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
            
        }

        DB::commit();
        return $this->successResponse(
            new ProdukLokasiResource($produkLokasi),
            'ProdukLokasi created successfully',
            201
        );
    }

    public function show($id)
    {
        try {

            $produkLokasi = $this->service->show($id);

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
           new ProdukLokasiResource($produkLokasi),
           'ProdukLokasi retrieved successfully'
       );
    }

    public function update($id, UpdateProdukLokasiRequest $request)
    {
        try {
            
            $produkLokasi = $this->service->update($request, $id);
            
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
                new ProdukLokasiResource($produkLokasi),
                'ProdukLokasi updated successfully'
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
                'ProdukLokasi deleted successfully'
            );
    }
}