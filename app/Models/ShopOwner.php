<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopOwner extends Model
{
    protected $fillable = ['name', 'email', 'password', 'shop_name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeSearch($query, $keyword)
    {
        if ($keyword) {
            return $query->where('name', 'like', "%$keyword%")
                         ->orWhere('shop_name', 'like', "%$keyword%");
        }
        return $query;
    }
}
