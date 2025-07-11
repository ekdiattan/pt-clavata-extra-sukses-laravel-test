<?php

namespace App\Modules\Mutasi\Models;
use App\Modules\User\Models\User;
use App\Modules\Produk\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\ProdukLokasi\Models\ProdukLokasi;

class Mutasi extends Model
{
    use SoftDeletes;
    
    protected $table = 'mutasi';
    
    protected $guarded = [
        
    ];
}
