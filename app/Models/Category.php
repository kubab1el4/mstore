<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'featured',
        'image'
    ];

    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }

    public function media(): MorphMany {
        return $this->morphMany(Media::class, 'mediable');
    }
}
