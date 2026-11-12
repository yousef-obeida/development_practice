<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Book extends Model
{
    protected $fillable = ['title', 'author'];

    protected $table = 'book';

    public function category(){
        return $this->belongsTo(Category::class);
    }
}

