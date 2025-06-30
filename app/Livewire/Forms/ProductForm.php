<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductForm extends Form
{
    use WithFileUploads;

    public $id = null;
    #[Validate('required|unique:products,name', as: 'name of the product')]
    public $name = null;
    #[Validate('required', as: 'description for this product')]
    public $description = null;
    #[Validate('required|numeric|min:0', as: 'price')]
    public $price = null;
    #[Validate('required|numeric|min:0', as: 'stock')]
    public $stock = null;
    #[Validate('required|exists:categories,id', as: 'category')]
    public $category_id = null;
    #[Validate('required|exists:suppliers,id', as: 'supplier')]
    public $supplier_id = null;

    #[Validate('nullable|image|max:2048', as: 'product image')] // 2MB max
    public $imageUpload = null;
    public $image = null; // Existing image path

    public function create()
    {
        $this->validate();

        $imagePath = null;
        if ($this->imageUpload) {
            $imagePath = $this->imageUpload->store('products', 'public');
        }

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'supplier_id' => $this->supplier_id,
            'image' => $imagePath,
        ]);

        $this->reset();
    }

    public function update(Product $record)
    {
        $this->validate([
            'name' => 'required|unique:products,name,' . $record->id,
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'imageUpload' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'supplier_id' => $this->supplier_id,
        ];

        // Only update image if new one is uploaded
        if ($this->imageUpload) {
            // Delete old image if exists
            if ($record->image && Storage::disk('public')->exists($record->image)) {
                Storage::disk('public')->delete($record->image);
            }
            $data['image'] = $this->imageUpload->store('products', 'public');
        }

        $record->update($data);
    }

    public function fill($product)
    {
        $this->id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->supplier_id = $product->supplier_id;
        $this->image = $product->image;
        $this->imageUpload = null; // Reset upload field
    }
}
