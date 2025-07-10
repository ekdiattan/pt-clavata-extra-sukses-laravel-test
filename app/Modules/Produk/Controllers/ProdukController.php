<?php

namespace App\Modules\Produk\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Modules\Produk\Services\ProdukService;
use App\Modules\Produk\Resources\ProdukResource;
use App\Modules\Produk\Requests\CreateProdukRequest;
use App\Modules\Produk\Requests\UpdateProdukRequest;

class ProdukController extends Controller
{
    protected $service;

    public function __construct(ProdukService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {

            $produk = $this->service->index();

            return $this->successResponse(
                ProdukResource::collection($produk),
                'Produks retrieved successfully'
            );

        } catch (\Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
        }
    }

    public function store(CreateProdukRequest $request)
    {
        try {

            DB::beginTransaction();
            $produk = $this->service->store($request);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
            
        }

        DB::commit();
        return $this->successResponse(
            new ProdukResource($produk),
            'Produk created successfully',
            201
        );
    }

    public function show($id)
    {
        try {
            $produk = $this->service->show($id);
           
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
           new ProdukResource($produk),
           'Produk retrieved successfully'
       );
    }

    public function update($id, UpdateProdukRequest $request)
    {
        try {

            $produk = $this->service->update($request, $id);
            
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
                new ProdukResource($produk),
                'Produk updated successfully'
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
                'Produk deleted successfully'
            );
    }
}