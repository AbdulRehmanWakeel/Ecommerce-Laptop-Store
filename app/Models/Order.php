<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id', 'total_amount', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeStatus($query, $status)
    {
        if ($status) return $query->where('status', $status);
        return $query;
    }

    public function scopeOfCustomer($query, $customerId)
    {
        if ($customerId) return $query->where('customer_id', $customerId);
        return $query;
    }
}
