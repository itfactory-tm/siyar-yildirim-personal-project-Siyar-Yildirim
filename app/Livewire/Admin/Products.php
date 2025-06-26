<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 15;
    public $showModal = false;
    public ProductForm $form;

    public $showDeleteModal = false;
    public $productToDelete = null;

    public function newProduct()
    {
        $this->form->reset();
        $this->resetErrorBag();
        $this->showModal = true;
    }

    public function editRecord(Product $product)
    {
        $this->resetErrorBag();
        $this->form->fill($product);
        $this->showModal = true;
    }

    public function updateRecord(Product $product)
    {
        $this->form->update($product);
        $this->showModal = false;
    }

    public function createProduct()
    {
        $this->form->create();
        $this->showModal = false;

    }

    public function confirmDelete(Product $product)
    {
        $this->productToDelete = $product;
        $this->showDeleteModal = true;
    }

    public function deleteProduct()
    {
        if ($this->productToDelete) {
            $this->productToDelete->delete();
            $this->productToDelete = null;
        }
        $this->showDeleteModal = false;
    }

    public function cancelDelete()
    {
        $this->productToDelete = null;
        $this->showDeleteModal = false;
    }

    #[Layout('layouts.earthify', ['title' => 'Products', 'description' => 'Manage your products',])]
    public function render()
    {
        $query = Product::orderBy('name')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });

        $products = $query->paginate($this->perPage);
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('livewire.admin.products', compact('products', 'categories', 'suppliers'));
    }
}
