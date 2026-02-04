<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $guarded = ['id'];

    //  Buku ke Kategori (Many to Many via pivot book_category_relations)
    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'book_category_relations', 'book_id', 'category_id');
    }

    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function review(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function collection(): HasMany
    {
        return $this->hasMany(Collection::class);
    }
}
