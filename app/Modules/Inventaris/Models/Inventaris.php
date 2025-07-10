<?php

namespace App\Modules\Inventaris\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventaris extends Model
{
    use SoftDeletes;
    
    protected $table = 'inventaris';

    protected $guarded = [];

}
