<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id','variant_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function getSpecificationsAttribute()
    {
        if ($this->variant) {
            return "{$this->variant->processor}, {$this->variant->ram} RAM, {$this->variant->storage}";
        }
        
        return $this->product->name;
    }

    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}
