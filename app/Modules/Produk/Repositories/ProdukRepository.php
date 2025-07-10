<?php

namespace App\Modules\Produk\Repositories;
use App\Modules\Produk\Models\Produk;

class ProdukRepository
{
    protected $model;

    public function __construct(Produk $model)
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
        return $this->model->with(['mutasis.user', 'mutasis.lokasi'])->findOrFail($id);
    }
}