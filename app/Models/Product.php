<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['shop_owner_id', 'name', 'brand', 'description', 'price', 'stock', 'image'];

    public function shopOwner()
    {
        return $this->belongsTo(ShopOwner::class);
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
}
