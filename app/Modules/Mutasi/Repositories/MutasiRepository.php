<?php

namespace App\Modules\Mutasi\Repositories;
use App\Modules\Mutasi\Models\Mutasi;

class MutasiRepository
{
    protected $model;

    public function __construct(Mutasi $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($data, $id)
    {
        return $this->model->findOrFail($id)->update($data);
    }
    
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
    
    public function historyByProduk($id)
    {
        return $this->model->with('produk', 'lokasi')->where('produk_id', $id)->get();
    }
    
}