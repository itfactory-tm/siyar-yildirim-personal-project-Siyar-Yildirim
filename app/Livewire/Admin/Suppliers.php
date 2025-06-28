<?php

namespace App\Livewire\Admin;

use App\Models\Supplier;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

use Livewire\Component;

class Suppliers extends Component
{
    public $sortColumn = 'name';
    public $sortOrder = 'asc';

    public $newSupplier = [
        'name' => '',
        'email' => '',
        'phone' => ''
    ];

    #[Validate([
        'editSupplier.name' => 'required|min:3|max:30|unique:suppliers,name',
        'editSupplier.email' => 'nullable|email|max:255',
        'editSupplier.phone' => 'nullable|string|max:20',
    ], as: [
        'editSupplier.name' => 'name for this supplier',
        'editSupplier.email' => 'email for this supplier',
        'editSupplier.phone' => 'phone number for this supplier',
    ])]
    public $editSupplier = [
        'id' => null,
        'name' => null,
        'email' => null,
        'phone' => null
    ];

    public function resetValues()
    {
        $this->reset('newSupplier', 'editSupplier');
        $this->resetErrorBag();
    }

    public function edit(Supplier $supplier)
    {
        $this->editSupplier = [
            'id' => $supplier->id,
            'name' => $supplier->name,
            'email' => $supplier->email,
            'phone' => $supplier->phone,
        ];
    }

    public function update(Supplier $supplier)
    {
        // Trim all string values
        $this->editSupplier['name'] = trim($this->editSupplier['name']);
        $this->editSupplier['email'] = trim($this->editSupplier['email']);
        $this->editSupplier['phone'] = trim($this->editSupplier['phone']);

        // Check if any values have actually changed
        if (strtolower($this->editSupplier['name']) === strtolower($supplier->name) &&
            $this->editSupplier['email'] === $supplier->email &&
            $this->editSupplier['phone'] === $supplier->phone) {
            $this->resetValues();
            return;
        }

        // Validate all fields
        $this->validate();

        // Update the supplier
        $supplier->update([
            'name' => $this->editSupplier['name'],
            'email' => $this->editSupplier['email'] ?: null,
            'phone' => $this->editSupplier['phone'] ?: null,
        ]);

        $this->resetValues();
    }

    public function create()
    {
        // Trim all string values
        $this->newSupplier['name'] = trim($this->newSupplier['name']);
        $this->newSupplier['email'] = trim($this->newSupplier['email']);
        $this->newSupplier['phone'] = trim($this->newSupplier['phone']);

        // Validate the new supplier data
        $this->validate([
            'newSupplier.name' => 'required|min:3|max:30|unique:suppliers,name',
            'newSupplier.email' => 'nullable|email|max:255',
            'newSupplier.phone' => 'nullable|string|max:20',
        ], [], [
            'newSupplier.name' => 'supplier name',
            'newSupplier.email' => 'email address',
            'newSupplier.phone' => 'phone number',
        ]);

        Supplier::create([
            'name' => $this->newSupplier['name'],
            'email' => $this->newSupplier['email'] ?: null,
            'phone' => $this->newSupplier['phone'] ?: null,
        ]);

        $this->resetValues();
    }

    public function delete(Supplier $supplier)
    {
        // Check if supplier has products
        if ($supplier->products()->count() > 0) {
            $this->addError('delete', 'Cannot delete supplier "' . $supplier->name . '" because it has ' . $supplier->products()->count() . ' product(s) associated with it.');
            return;
        }

        $supplier->delete();
    }

    public function resort($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortOrder = 'asc';
        }
    }

    #[Layout('layouts.earthify', ['title' => 'Suppliers', 'description' => 'Manage the suppliers of your products',])]
    public function render()
    {
        $suppliers = Supplier::withCount('products')
            ->orderBy($this->sortColumn, $this->sortOrder)
            ->get();
        return view('livewire.admin.suppliers', compact('suppliers'));
    }
}
