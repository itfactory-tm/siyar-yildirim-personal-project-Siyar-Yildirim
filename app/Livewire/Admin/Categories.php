<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Categories extends Component
{
    public $sortColumn = 'name';
    public $sortOrder = 'asc';

    #[Validate('required|min:3|max:30|unique:categories,name', attribute: 'name for this category',)]
    public $newCategory;

    #[Validate(['editCategory.name' => 'required|min:3|max:30|unique:categories,name',], as: ['editCategory.name' => 'name for this Category',])]
    public $editCategory = ['id' => null, 'name' => null];

    public function resetValues()
    {
        $this->reset('newCategory', 'editCategory');
        $this->resetErrorBag();
        #method to clear all the validation errors
    }

    public function edit(Category $category)
    {
        $this->editCategory = [
            'id' => $category->id,
            'name' => $category->name,
        ];
    }

    public function update(Category $category)
    {
        $this->editCategory['name'] = trim($this->editCategory['name']);
        // if the name is not changed, do nothing
        if(strtolower($this->editCategory['name']) === strtolower($category->name)) {
            $this->resetValues();
            return;
        }
        $this->validateOnly('editCategory.name');
        $category->update([
            'name' => trim($this->editCategory['name']),
        ]);
        $this->resetValues();
    }

    public function create()
    {
        $this->validateOnly('newCategory');
        Category::create([
            'name' => trim($this->newCategory),
        ]);

        $this->resetValues();
    }

    public function delete(Category $category)
    {
        $category->delete();
    }

    #[Layout('layouts.earthify', ['title' => 'Categories', 'description' => 'Manage the categories of your products',])]
    public function render()
    {
        $categories = Category::withCount('products')
            ->orderBy($this->sortColumn, $this->sortOrder)
            ->get();
        return view('livewire.admin.categories', compact('categories'));
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
}
