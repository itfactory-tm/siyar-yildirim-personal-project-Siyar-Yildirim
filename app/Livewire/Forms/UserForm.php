<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public $id = null;

    #[Validate('required|min:2|max:255', as: 'name')]
    public $name = '';

    #[Validate('required|email|max:255', as: 'email')]
    public $email = '';

    #[Validate('nullable|string|min:6', as: 'password')]
    public $password = '';

    #[Validate('boolean', as: 'admin status')]
    public $admin = false;

    #[Validate('boolean', as: 'active status')]
    public $active = true;

    public function create()
    {
        $this->validate([
            'name' => 'required|min:2|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'nullable|string|min:6',
            'admin' => 'boolean',
            'active' => 'boolean',
        ]);

        // Use default password if none provided
        $password = $this->password ?: 'user1234';

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($password),
            'admin' => $this->admin,
            'active' => $this->active,
        ]);
    }

    public function update(User $record)
    {
        $this->validate([
            'name' => 'required|min:2|max:255|unique:users,name,' . $record->id,
            'email' => 'required|email|max:255|unique:users,email,' . $record->id,
            'password' => 'nullable|string|min:6',
            'admin' => 'boolean',
            'active' => 'boolean',
        ]);

        $updateData = [
            'name' => $this->name,
            'email' => $this->email,
            'admin' => $this->admin,
            'active' => $this->active,
        ];

        // Only update password if provided
        if (!empty($this->password)) {
            $updateData['password'] = Hash::make($this->password);
        }

        $record->update($updateData);
    }
}
