<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class FeaturedProducts extends Component
{
    public $limit = 3;
    public $title = 'Featured Products';

    public function mount($limit = 3, $title = 'Featured Products')
    {
        $this->limit = $limit;
        $this->title = $title;
    }

    public function render()
    {
        $products = Product::with('category')
            ->where('stock', '>', 0) // Only show in-stock products
            ->inRandomOrder() // Random selection for variety
            ->limit($this->limit)->get();

        return view('livewire.featured-products', compact('products'));
    }
}
