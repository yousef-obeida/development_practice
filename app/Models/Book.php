<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'name',
        'publisher',
        'publication_year',
        'category_id',
    ];

    protected $table = 'book';

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function borrowing()
    {
        return $this->belongsToMany(Customer::class, 'borrowing')->withPivot('borrowed_at', 'returned_at', 'is_returned')->withTimestamps();
    }
}
