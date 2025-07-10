<?php

namespace App\Modules\Mutasi\Services;
use App\Modules\Mutasi\Repositories\MutasiRepository;
use App\Modules\Produk\Repositories\ProdukRepository;

class MutasiService
{
    protected $repository, $produkRepository;

    public function __construct(MutasiRepository $repository, ProdukRepository $produkRepository)
    {
        $this->repository = $repository;
        $this->produkRepository = $produkRepository;
    }
    
    public function index()
    {
        return $this->repository->all();
    }

    public function store($request)
    {
        return $this->repository->create($request->all());
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

    public function historyByProduk($id)
    {
        return $this->produkRepository->historyByProduk($id);
    }
}