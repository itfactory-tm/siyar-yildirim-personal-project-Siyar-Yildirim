<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id', 'supplier_id', 'image'];
    protected $casts = ['price' => 'decimal:2', 'stock' => 'integer',];

    /** A product belongs to a category */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /** A product belongs to a supplier */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /** A product appears in many order lines */
    public function orderLines()
    {
        return $this->hasMany(Orderline::class);
    }

    /** Check if the product has been ordered */
    public function hasOrders()
    {
        return $this->orderLines()->exists();
    }

    /** Get the full image URL attribute. */
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}
