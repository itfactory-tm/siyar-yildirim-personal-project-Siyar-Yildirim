<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /** An order line belongs to an order */
    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }

    /** An order line refers to one product */
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }
}
