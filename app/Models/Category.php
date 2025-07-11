<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /** A category has many products */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function hasOrders()
    {
        return $this->products()
            ->whereHas('orderLines')
            ->exists();
    }
}
