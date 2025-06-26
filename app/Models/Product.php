<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','supplier_id','name','description', 'price','stock','image'];

    /** A product belongs to a category */
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    /** A product belongs to a supplier */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withDefault();
    }

    /** A product appears in many order lines */
    public function orderlines()
    {
        return $this->hasMany(Orderline::class);
    }
}
