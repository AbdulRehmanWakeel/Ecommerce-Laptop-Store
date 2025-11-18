<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'password', 'address', 'phone'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function scopeSearch($query, $keyword)
    {
        if ($keyword) {
            return $query->where('name', 'like', "%$keyword%")
                         ->orWhere('email', 'like', "%$keyword%");
        }
        return $query;
    }
}
