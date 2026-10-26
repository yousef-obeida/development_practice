<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    protected $fillable = ['name', 'email', 'position', 'password'];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $hidden = ['password'];
    
}
