<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'staff';
    protected $fillable = [
     'name',
     'email',
    'position', 
    'password'
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $hidden = ['password' , 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
}
