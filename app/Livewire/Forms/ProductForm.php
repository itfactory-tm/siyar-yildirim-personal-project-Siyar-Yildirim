<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
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

    public function create()
    {
        $this->validate();
        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'supplier_id' => $this->supplier_id,
        ]);
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
        ]);

        $record->update([
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'supplier_id' => $this->supplier_id,
        ]);
    }
}
