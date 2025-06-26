<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /** A supplier provides many products */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
