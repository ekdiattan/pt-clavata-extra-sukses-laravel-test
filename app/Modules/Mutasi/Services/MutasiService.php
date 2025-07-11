<?php

namespace App\Modules\Mutasi\Services;

use App\Modules\User\Models\User;
use App\Modules\Mutasi\Models\Mutasi;
use App\Modules\Produk\Models\Produk;
use App\Modules\Mutasi\Repositories\MutasiRepository;
use App\Modules\Produk\Repositories\ProdukRepository;
use App\Modules\ProdukLokasi\Repositories\ProdukLokasiRepository;

class MutasiService
{
    protected $repository, $produkRepository, $produkLokasiRepository;

    public function __construct(MutasiRepository $repository, ProdukRepository $produkRepository, ProdukLokasiRepository $produkLokasiRepository)
    {
        $this->repository = $repository;
        $this->produkRepository = $produkRepository;
        $this->produkLokasiRepository = $produkLokasiRepository;
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function store($request, $userId)
    {
        $dataProdukLokasi = $this->produkLokasiRepository->find($request->produk_lokasi_id);

        if ($request->jenis_mutasi == 'masuk') {

            $this->produkLokasiRepository->countHandleStock($dataProdukLokasi->id, $request->jumlah, '+');
        } elseif ($request->jenis_mutasi == 'keluar') {

            $this->produkLokasiRepository->countHandleStock($dataProdukLokasi->id, $request->jumlah, '-');
        }

        $request['produk_id'] = $dataProdukLokasi->produk_id;
        $request['lokasi_id'] = $dataProdukLokasi->lokasi_id;

        $request['user_id'] = $userId->id;
        return $this->repository->create($request->except('produk_lokasi_id'));
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function update($request, $id)
    {
        $this->repository->update($request->all(), $id);

        return $this->repository->find($id);
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
    
    public function historyByProduk($produkId)
    {
        return Produk::with('mutasis')->findOrFail($produkId);
    }
    
    public function historyByUser($userId)
    {
        return User::with('mutasis')->findOrFail($userId);
    }
}
