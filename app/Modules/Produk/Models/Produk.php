<?php

namespace App\Modules\Produk\Models;
use App\Modules\User\Models\User;
use App\Modules\Lokasi\Models\Lokasi;
use App\Modules\Mutasi\Models\Mutasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\ProdukLokasi\Models\ProdukLokasi;

class Produk extends Model
{
    use SoftDeletes;
    
    protected $table = 'produk';
    
    protected $guarded = [

    ];  

    public function mutasis()
    {
        return $this->hasMany(Mutasi::class);
    }
}
