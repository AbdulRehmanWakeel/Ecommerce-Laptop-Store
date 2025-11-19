<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'shop_owner_id', 'name', 'brand', 'description', 
        'model_name', 'category', 'operating_system', 'price', 'stock', 'image'
    ];

    public function shopOwner()
    {
        return $this->belongsTo(ShopOwner::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function scopeAvailable($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeOfShop($query, $shopOwnerId)
    {
        if ($shopOwnerId) {
            return $query->where('shop_owner_id', $shopOwnerId);
        }
        return $query;
    }

    public function scopeLaptops($query)
    {
        return $query->where('category', 'laptop');
    }

    public function getMinPriceAttribute()
    {
        return $this->variants()->min('price') ?? $this->base_price;
    }

    public function getMaxPriceAttribute()
    {
        return $this->variants()->max('price') ?? $this->base_price;
    }

    public function getHasVariantsAttribute()
    {
        return $this->variants()->count() > 0;
    }
}