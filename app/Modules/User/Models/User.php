<?php

namespace App\Modules\User\Models;

use Laravel\Sanctum\HasApiTokens;
use Database\Factories\UserFactory;
use App\Modules\Mutasi\Models\Mutasi;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    
    protected static function newFactory()
    {
        return UserFactory::new();
    }
    
    protected $guarded = [

    ];
    
    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }
}
