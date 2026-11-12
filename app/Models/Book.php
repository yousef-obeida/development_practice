<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    protected $fillable = ['title', 'author'];

    protected $table = 'book';

    public function category(){
        return $this->belongsToMany(Category::class);
    }
    public function borrowing()
    {
        return $this->belongsToMany(Customer::class, 'borrowing')->withPivot('borrowed_at', 'returned_at', 'is_returned')->withTimestamps();
    }
}

