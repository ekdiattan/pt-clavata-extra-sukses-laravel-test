<?php

namespace App\Modules\Lokasi\Models;
use App\Modules\Mutasi\Models\Mutasi;
use App\Modules\Produk\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\ProdukLokasi\Models\ProdukLokasi;

class Lokasi extends Model
{
    use SoftDeletes;

    protected $table = 'lokasi';

    protected $guarded = [

    ];
}
