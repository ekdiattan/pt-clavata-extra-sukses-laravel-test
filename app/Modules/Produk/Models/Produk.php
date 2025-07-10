<?php

namespace App\Modules\Produk\Models;
use App\Modules\Lokasi\Models\Lokasi;
use App\Modules\Mutasi\Models\Mutasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;
    
    protected $table = 'produk';
    
    protected $guarded = [

    ];  

    public function lokasis()
    {
        return $this->belongsToMany(Lokasi::class, 'produk_lokasi')
                    ->withPivot('stok')
                    ->withTimestamps();
    }
}
