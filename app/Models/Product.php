<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'slug',
        'is_active',
    ];


    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn(int $value) => (bool)$value,
        );
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn(null|string $value) => $value ? asset('uploads/products/' . $value) : asset('uploads/users/no_image.jpg'),
        );
    }


    /**
     * return active products
     *
     * @param $query
     * @return mixed
     */
    public function scopeActiveProduct($query)
    {
        return $query->where('is_active', 1);
    }


    public function scopeProductTypePrice($query, $type)
    {
        return match ($type) {
            'silver' => $query->whereBetween('price', [100, 200]),
            'gold' => $query->where('price', '>', 200),
            default => $query->where('price', '<', 100),
        };
    }
}
