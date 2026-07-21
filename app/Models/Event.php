<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'category_id', 'user_id', 'title', 'description', 'date', 'location', 'price', 'stock', 'poster_path', 'status'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    //Menandakan atribut : 1 Event harus terpaut pada satu wujud kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
