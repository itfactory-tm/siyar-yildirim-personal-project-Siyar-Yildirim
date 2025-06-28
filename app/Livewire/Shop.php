<?php

namespace App\Livewire;

use App\Helpers\Cart;
use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;

    public $perPage = 9;
    public $filter;
    public $category = '%';
    public $price;
    public $priceMin, $priceMax;

    public $loading = 'Please wait...';
    public $selectedProduct;
    public $showModal = false;

    // reset paginator when a filter changes
    public function updated($property, $value)
    {
        if (in_array($property, ['perPage', 'filter', 'category', 'price']))
            $this->resetPage();
    }

    public function showProduct(Product $product)
    {
        $this->selectedProduct = $product;
        $this->showModal = true;
    }

    public function mount()
    {
        $this->priceMin = ceil(Product::min('price'));
        $this->priceMax = ceil(Product::max('price'));
        $this->price    = $this->priceMax;
    }

    public function addToBasket(Product $product)
    {
        Cart::add($product);
        $this->dispatch('basket-updated');
    }

    #[Layout('layouts.earthify', ['title' => 'Shop', 'description' => 'Browse our durable goods'])]
    public function render()
    {
        $allCategories = Category::has('products')
            ->withCount('products')
            ->orderBy('name')
            ->get();

        $products = Product::orderBy('name')
            ->where([
                ['name',        'like', "%{$this->filter}%"],
                ['category_id', 'like', $this->category],
                ['price',       '<=',   $this->price],
            ])
            ->orWhere([
                ['description', 'like', "%{$this->filter}%"],
                ['category_id', 'like', $this->category],
                ['price',       '<=',   $this->price],
            ])
            ->paginate($this->perPage);

        return view('livewire.shop', compact('products', 'allCategories'));
    }
}
