<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 15;
    public $showModal = false;
    public UserForm $form;

    public $showDeleteModal = false;
    public $userToDelete = null;

    public $showPasswordModal = false;
    public $userForPassword = null;
    public $generatedPassword = '';

    // Filters
    public $showActiveOnly = false;
    public $showAdminsOnly = false;

    // Sorting
    public $sortField = 'name';
    public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'showActiveOnly' => ['except' => false],
        'showAdminsOnly' => ['except' => false],
    ];

    public function newUser()
    {
        $this->form->reset();
        $this->resetErrorBag();
        $this->showModal = true;
    }

    public function editRecord(User $user)
    {
        $this->resetErrorBag();
        $this->form->fill($user->toArray());
        $this->form->id = $user->id;
        $this->form->password = ''; // Always empty for editing
        $this->showModal = true;
    }

    public function updateRecord(User $user)
    {
        // Prevent self-modification of critical fields
        if ($user->id === Auth::id()) {
            $this->form->admin = Auth::user()->admin;
            $this->form->active = Auth::user()->active;
        }

        $this->form->update($user);
        $this->showModal = false;
        session()->flash('success', 'User updated successfully');
    }

    public function createUser()
    {
        $this->form->create();
        $this->showModal = false;
        session()->flash('success', 'User created successfully');
    }

    public function confirmDelete(User $user)
    {
        if ($user->id === Auth::id()) {
            session()->flash('error', 'You cannot delete your own account');
            return;
        }

        $this->userToDelete = $user;
        $this->showDeleteModal = true;
    }

    public function deleteUser()
    {
        if ($this->userToDelete && $this->userToDelete->id !== Auth::id()) {
            $this->userToDelete->delete();
            session()->flash('success', 'User deleted successfully');
            $this->userToDelete = null;
        }
        $this->showDeleteModal = false;
    }

    public function cancelDelete()
    {
        $this->userToDelete = null;
        $this->showDeleteModal = false;
    }

    public function generatePassword(User $user)
    {
        $this->generatedPassword = Str::random(12);
        $user->update(['password' => Hash::make($this->generatedPassword)]);

        $this->userForPassword = $user;
        $this->showPasswordModal = true;
    }

    public function closePasswordModal()
    {
        $this->userForPassword = null;
        $this->generatedPassword = '';
        $this->showPasswordModal = false;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function toggleActiveFilter()
    {
        $this->showActiveOnly = !$this->showActiveOnly;
        $this->showAdminsOnly = false;
        $this->resetPage();
    }

    public function toggleAdminFilter()
    {
        $this->showAdminsOnly = !$this->showAdminsOnly;
        $this->showActiveOnly = false;
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->showActiveOnly = false;
        $this->showAdminsOnly = false;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[Layout('layouts.earthify', ['title' => 'Users', 'description' => 'Manage your users'])]
    public function render()
    {
        $query = User::query()
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->showActiveOnly, function ($q) {
                $q->where('active', true);
            })
            ->when($this->showAdminsOnly, function ($q) {
                $q->where('admin', true);
            });

        if ($this->sortField === 'admin' || $this->sortField === 'active') {
            // For boolean fields, apply the user's chosen direction and add name as secondary sort
            $query->orderBy($this->sortField, $this->sortDirection)
                ->orderBy('name', 'asc');
        } else {
            // For other fields, use the user's chosen direction
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        $users = $query->paginate($this->perPage);

        return view('livewire.admin.users', compact('users'));
    }
}
