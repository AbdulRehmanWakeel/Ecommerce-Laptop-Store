<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'product_id', 'sku', 'processor', 'ram', 'storage', 
        'graphics_card', 'display_size', 'resolution', 'stock', 'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function getFullSpecificationAttribute()
    {
        $specs = [
            $this->processor,
            $this->ram . ' RAM',
            $this->storage . ' Storage',
            $this->display_size . ' Display',
            $this->resolution
        ];

        if ($this->graphics_card) {
            $specs[] = $this->graphics_card;
        }

        return implode(', ', $specs);
    }

    public function getIsLowStockAttribute()
    {
        return $this->stock > 0 && $this->stock <= 5;
    }

    public function getIsOutOfStockAttribute()
    {
        return $this->stock === 0;
    }
}