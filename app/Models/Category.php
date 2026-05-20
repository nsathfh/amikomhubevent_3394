<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function booted()
    {
        static::creating(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Menandakan atribut: 1 Kategori dapat memiliki banyak list Event
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
