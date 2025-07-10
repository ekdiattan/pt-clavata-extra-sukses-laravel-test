<?php

namespace App\Modules\Lokasi\Repositories;
use App\Modules\Lokasi\Models\Lokasi;

class LokasiRepository
{
    protected $model;

    public function __construct(Lokasi $model)
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
    
}