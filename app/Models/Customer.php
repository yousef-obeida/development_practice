<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'city',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function borrowing()
    {
        return $this->belongsToMany(Book::class, 'borrowing')->withPivot('borrowed_at', 'returned_at', 'is_returned')->withTimestamps();
    }
}
