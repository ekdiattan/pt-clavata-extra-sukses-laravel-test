<?php

namespace App\Modules\Lokasi\Services;
use App\Modules\Lokasi\Repositories\LokasiRepository;

class LokasiService
{
    protected $repository;

    public function __construct(LokasiRepository $repository)
    {
        $this->repository = $repository;
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
}