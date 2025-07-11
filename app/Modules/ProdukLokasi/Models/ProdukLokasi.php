<?php

namespace App\Modules\ProdukLokasi\Models;
use App\Modules\Lokasi\Models\Lokasi;
use App\Modules\Mutasi\Models\Mutasi;
use App\Modules\Produk\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukLokasi extends Model
{
    // use SoftDeletes;

    protected $table = 'produk_lokasi';

    protected $guarded = [

    ];
}
