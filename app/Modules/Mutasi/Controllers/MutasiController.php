<?php

namespace App\Modules\Mutasi\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Modules\Mutasi\Services\MutasiService;
use App\Modules\Mutasi\Resources\MutasiResource;
use App\Modules\Mutasi\Requests\CreateMutasiRequest;
use App\Modules\Mutasi\Requests\UpdateMutasiRequest;

class MutasiController extends Controller
{
    protected $service;

    public function __construct(MutasiService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {

            $Mutasi = $this->service->index();

            return $this->successResponse(
                MutasiResource::collection($Mutasi),
                'Mutasis retrieved successfully'
            );

        } catch (\Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
        }
    }

    public function store(CreateMutasiRequest $request)
    {
        try {

            DB::beginTransaction();
            $Mutasi = $this->service->store($request);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 400
            );
            
        }

        DB::commit();
        return $this->successResponse(
            new MutasiResource($Mutasi),
            'Mutasi created successfully',
            201
        );
    }

    public function show($id)
    {
        try {
            $Mutasi = $this->service->show($id);
           
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
           new MutasiResource($Mutasi),
           'Mutasi retrieved successfully'
       );
    }

    public function update($id, UpdateMutasiRequest $request)
    {
        try {

            $Mutasi = $this->service->update($request, $id);
            
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
                new MutasiResource($Mutasi),
                'Mutasi updated successfully'
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
                'Mutasi deleted successfully'
            );
    }

    public function historyByProduk($id)
    {
        $produk = $this->service->historyByProduk($id);
        
        return response()->json([
            'success' => true,
            'produk' => $produk->nama_produk,
            'mutasi' => $produk->mutasis
        ]);
    }

    // History mutasi per user
    // public function historyByUser($id)
    // {
    //     $user = User::with('mutasis.produk', 'mutasis.lokasi')->findOrFail($id);
        
    //     return response()->json([
    //         'success' => true,
    //         'user' => $user->name,
    //         'mutasi' => $user->mutasis
    //     ]);
    // }
}