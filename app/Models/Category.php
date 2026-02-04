<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $guarded = ['id'];

    // Kategori ke Buku (Many to Many via pivot book_category_relations)
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_category_relations', 'category_id', 'book_id');
    }
}
