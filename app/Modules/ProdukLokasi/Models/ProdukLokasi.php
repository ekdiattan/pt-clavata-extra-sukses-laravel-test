<?php

namespace App\Modules\ProdukLokasi\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukLokasi extends Model
{
    // use SoftDeletes;

    protected $table = 'produk_lokasi';

    protected $guarded = [

    ];
    
    // public function produks()
    // {
    //     return $this->belongsToMany(Produk::class, 'produk_ProdukLokasi')->withPivot('stok')->withTimestamps();
    // }

}
