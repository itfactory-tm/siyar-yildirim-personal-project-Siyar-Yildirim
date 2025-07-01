<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Products extends Component
{
    use WithPagination, WithFileUploads;

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

        // Dispatch event to reset Alpine.js image state
        $this->dispatch('reset-image-preview');
    }

    public function editRecord(Product $product)
    {
        $this->resetErrorBag();
        $this->form->fill($product);
        $this->showModal = true;

        // Dispatch event to reset Alpine.js image state
        $this->dispatch('reset-image-preview');
    }

    public function updateRecord(Product $product)
    {
        $this->form->update($product);
        $this->showModal = false;

        // Dispatch event to reset Alpine.js image state after closing
        $this->dispatch('reset-image-preview');
    }

    public function createProduct()
    {
        $this->form->create();
        $this->showModal = false;

        // Dispatch event to reset Alpine.js image state after closing
        $this->dispatch('reset-image-preview');
    }

    public function removeImage()
    {
        $this->form->imageUpload = null;
        $this->form->image = null;
    }

    // Add method to handle modal closing
    public function closeModal()
    {
        $this->showModal = false;
        $this->dispatch('reset-image-preview');
    }

    public function confirmDelete(Product $product)
    {
        // Check if product has been ordered
        if ($product->hasOrders()) {
            session()->flash('error', 'Cannot delete this product because it has been ordered. This product must be preserved for order history.');
            return;
        }

        $this->productToDelete = $product;
        $this->showDeleteModal = true;
    }

    public function deleteProduct()
    {
        if ($this->productToDelete) {
            // Double-check before deletion
            if ($this->productToDelete->hasOrders()) {
                session()->flash('error', 'Cannot delete this product because it has been ordered.');
                $this->showDeleteModal = false;
                $this->productToDelete = null;
                return;
            }

            // Delete image if exists
            if ($this->productToDelete->image && Storage::disk('public')->exists($this->productToDelete->image)) {
                Storage::disk('public')->delete($this->productToDelete->image);
            }

            $this->productToDelete->delete();
            session()->flash('success', 'Product deleted successfully.');
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
