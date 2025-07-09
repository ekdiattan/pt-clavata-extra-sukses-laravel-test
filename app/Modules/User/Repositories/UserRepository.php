<?php

namespace App\Modules\User\Repositories;
use App\Modules\User\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }


    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        return $this->model->findOrFail($id)->update($data);
    }
    
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
    
}