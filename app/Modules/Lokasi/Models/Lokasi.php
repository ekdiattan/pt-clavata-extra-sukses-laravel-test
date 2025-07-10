<?php

namespace App\Modules\Lokasi\Models;
use App\Modules\Produk\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lokasi extends Model
{
    use SoftDeletes;

    protected $table = 'lokasi';

    protected $guarded = [

    ];
    
    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'produk_lokasi')->withPivot('stok')->withTimestamps();
    }

}
