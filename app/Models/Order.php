<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /** An order belongs to a user */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /** An order has many order lines */
    public function orderlines()
    {
        return $this->hasMany(Orderline::class);
    }
}
