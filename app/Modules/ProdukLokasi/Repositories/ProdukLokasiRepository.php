<?php

namespace App\Modules\ProdukLokasi\Repositories;
use App\Modules\ProdukLokasi\Models\ProdukLokasi;

class ProdukLokasiRepository
{
    protected $model;

    public function __construct(ProdukLokasi $model)
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
    
    public function fetchProdukLokasiByProdukIdLokasiId($produkId, $lokasiId)
    {
        return $this->model->where('produk_id', $produkId)->where('lokasi_id', $lokasiId)->first();
    }

    public function countHandleStock($id, $jumlah, $operator)
    {
        
        $produkLokasi = $this->model->findOrFail($id);
        $stok = $operator == '+' ? $produkLokasi->stok + $jumlah : $produkLokasi->stok - $jumlah;
        $this->model->findOrFail($id)->update(['stok' => $stok]);

        return $stok;
    }
    
}