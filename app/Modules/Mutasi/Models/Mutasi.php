<?php

namespace App\Modules\Mutasi\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mutasi extends Model
{
    use SoftDeletes;
    
    protected $table = 'mutasi';
    
    protected $guarded = [
        
    ];
}
