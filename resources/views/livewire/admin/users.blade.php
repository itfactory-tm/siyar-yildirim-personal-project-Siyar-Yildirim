<div>
    {{-- Flash Messages with improved styling --}}
    @if (session('success'))
        <x-tmk.alert type="success" dismissible="true" class="mb-6 shadow-lg animate-fade-in">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </x-tmk.alert>
    @endif

    @if (session('error'))
        <x-tmk.alert type="danger" dismissible="true" class="mb-6 shadow-lg animate-fade-in">
            <span class="font-medium">Error!</span> {{ session('error') }}
        </x-tmk.alert>
    @endif

    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">User Management</h1>
        <p class="mt-2 text-gray-600">Manage your application users, permissions, and access control</p>
    </div>

    {{-- Filters Section with enhanced design --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-6 py-0" >
            {{-- Search and Filters Bar --}}
            <div class="p-6 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex flex-col lg:flex-row gap-4">
                    {{-- Search Input --}}
                    <div class="flex-1">
                        <x-tmk.form.search
                            placeholder="Search users by name or email..."
                            wire:model.live.debounce.500ms="search"
                            size="lg"
                            variant="filled"
                            icon="true"
                            clearable="true"
                            class="shadow-sm"
                        />
                    </div>

                    {{-- Filter Buttons --}}
                    <div class="flex items-center gap-3">
                        <button wire:click="toggleActiveFilter"
                                class="px-5 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 flex items-center gap-2 shadow-sm
                                {{ $showActiveOnly
                                    ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-green-500/25'
                                    : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}">
                            @if($showActiveOnly)
                                <x-phosphor-check-circle-fill class="size-4"/>
                            @else
                                <x-phosphor-check-circle class="size-4"/>
                            @endif
                            Active Only
                        </button>

                        <button wire:click="toggleAdminFilter"
                                class="px-5 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 flex items-center gap-2 shadow-sm
                                {{ $showAdminsOnly
                                    ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-purple-500/25'
                                    : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}">
                            @if($showAdminsOnly)
                                <x-phosphor-crown-fill class="size-4"/>
                            @else
                                <x-phosphor-crown class="size-4"/>
                            @endif
                            Admins Only
                        </button>

                        @if($search || $showActiveOnly || $showAdminsOnly)
                            <button wire:click="clearFilters"
                                    class="px-5 py-2.5 text-sm font-medium bg-white border border-gray-300 text-gray-700
                                           hover:bg-red-50 hover:border-red-300 hover:text-red-700 rounded-lg
                                           transition-all duration-200 flex items-center gap-2 shadow-sm">
                                <x-phosphor-x class="size-4"/>
                                Clear Filters
                            </button>
                        @endif
                    </div>

                    {{-- Add New User Button --}}
                    <x-tmk.button
                        wire:click="newUser()"
                        color="primary"
                        size="lg"
                        class="shadow-sm">
                        Add New User
                    </x-tmk.button>
                </div>
            </div>

            {{-- Quick Stats Bar --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-6">
                        <span class="text-gray-600">
                            Total Users: <span class="font-semibold text-gray-900">{{ $users->total() }}</span>
                        </span>
                        <span class="text-gray-600">
                            Active: <span class="font-semibold text-green-600">{{ $users->where('active', true)->count() }}</span>
                        </span>
                        <span class="text-gray-600">
                            Admins: <span class="font-semibold text-purple-600">{{ $users->where('admin', true)->count() }}</span>
                        </span>
                    </div>
                    <div class="text-gray-500">
                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} results
                    </div>
                </div>
            </div>
        </div>

    {{-- Users Table Section --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden py-0">
            {{-- Pagination at top --}}
            <div class="p-4 border-b border-gray-200 bg-gray-50">
                {{ $users->links() }}
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors"
                            wire:click="sortBy('name')">
                            <div class="flex items-center gap-1">
                                User Details
                                @if($sortField === 'name')
                                    @if($sortDirection === 'asc')
                                        <x-phosphor-arrow-up class="size-3"/>
                                    @else
                                        <x-phosphor-arrow-down class="size-3"/>
                                    @endif
                                @else
                                    <x-phosphor-arrows-down-up class="size-3 opacity-30"/>
                                @endif
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors"
                            wire:click="sortBy('admin')">
                            <div class="flex items-center justify-center gap-1">
                                Role
                                @if($sortField === 'admin')
                                    @if($sortDirection === 'asc')
                                        <x-phosphor-arrow-up class="size-3"/>
                                    @else
                                        <x-phosphor-arrow-down class="size-3"/>
                                    @endif
                                @else
                                    <x-phosphor-arrows-down-up class="size-3 opacity-30"/>
                                @endif
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors"
                            wire:click="sortBy('active')">
                            <div class="flex items-center justify-center gap-1">
                                Status
                                @if($sortField === 'active')
                                    @if($sortDirection === 'asc')
                                        <x-phosphor-arrow-up class="size-3"/>
                                    @else
                                        <x-phosphor-arrow-down class="size-3"/>
                                    @endif
                                @else
                                    <x-phosphor-arrows-down-up class="size-3 opacity-30"/>
                                @endif
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Joined
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center justify-end gap-2">
                                <span>Show</span>
                                <x-tmk.form.select
                                    id="perPage"
                                    wire:model.live="perPage"
                                    variant="compact"
                                    size="xs"
                                    class="w-16">
                                    @foreach([5, 10, 15, 20] as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </x-tmk.form.select>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr wire:key="{{ $user->id }}"
                            class="hover:bg-gray-50 transition-colors
                                {{ !$user->active ? 'bg-red-50 hover:bg-red-100' : '' }}
                                {{ $user->id === auth()->id() ? 'bg-blue-50 hover:bg-blue-100' : '' }}">

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                #{{ $user->id }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-semibold">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $user->name }}
                                            @if($user->id === auth()->id())
                                                <span class="ml-1 px-2 py-0.5 text-xs bg-blue-100 text-blue-800 rounded-full">You</span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($user->admin)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 border border-purple-200">
                                            <x-phosphor-crown-fill class="size-3 mr-1"/>
                                            Admin
                                        </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                            User
                                        </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($user->active)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                            Active
                                        </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                            <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                            Inactive
                                        </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ $user->created_at->format('M d, Y') }}</span>
                                    <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="editRecord({{ $user->id }})"
                                            class="inline-flex items-center p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200"
                                            title="Edit user">
                                        <x-phosphor-pencil-line class="size-5"/>
                                    </button>
                                    <button wire:click="generatePassword({{ $user->id }})"
                                            class="inline-flex items-center p-2 text-gray-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all duration-200"
                                            title="Generate new password">
                                        <x-phosphor-key class="size-5"/>
                                    </button>
                                    <button wire:click="confirmDelete({{ $user->id }})"
                                            {{ $user->id === auth()->id() ? 'disabled' : '' }}
                                            class="inline-flex items-center p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200
                                                {{ $user->id === auth()->id() ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            title="{{ $user->id === auth()->id() ? 'Cannot delete yourself' : 'Delete user' }}">
                                        <x-phosphor-trash class="size-5"/>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <x-phosphor-users class="size-12 text-gray-400 mb-4"/>
                                    <p class="text-lg font-medium text-gray-900">No users found</p>
                                    <p class="text-sm text-gray-500 mt-1">Try adjusting your search or filters</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Bottom Pagination --}}
            <div class="p-4 border-t border-gray-200 bg-gray-50">
                {{ $users->links() }}
            </div>
        </div>

    {{-- Modal for add and update user --}}
    <x-dialog-modal id="userModal" wire:model.live="showModal">
        <x-slot name="title">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                @if(is_null($form->id))
                    <x-phosphor-user-plus class="size-6 text-indigo-600"/>
                    Create New User
                @else
                    <x-phosphor-user-gear class="size-6 text-indigo-600"/>
                    Edit User
                @endif
            </h2>
        </x-slot>
        <x-slot name="content">
            {{-- Error messages --}}
            <x-tmk.error-bag />

            <div class="space-y-6 mt-6">
                {{-- Name Field --}}
                <div>
                    <x-label for="name" value="Full Name" class="text-sm font-medium text-gray-700 mb-1"/>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <x-phosphor-user class="size-5 text-gray-400"/>
                        </div>
                        <x-input id="name" type="text"
                                 wire:model="form.name"
                                 placeholder="Enter user's full name"
                                 class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"/>
                    </div>
                </div>

                {{-- Email Field --}}
                <div>
                    <x-label for="email" value="Email Address" class="text-sm font-medium text-gray-700 mb-1"/>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <x-phosphor-envelope class="size-5 text-gray-400"/>
                        </div>
                        <x-input id="email" type="email"
                                 wire:model="form.email"
                                 placeholder="user@example.com"
                                 class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"/>
                    </div>
                </div>

                {{-- Password Field --}}
                <div>
                    <x-label for="password" value="Password" class="text-sm font-medium text-gray-700 mb-1"/>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <x-phosphor-lock class="size-5 text-gray-400"/>
                        </div>
                        <x-input id="password" type="password"
                                 wire:model="form.password"
                                 placeholder="{{ $form->id ? 'Leave empty to keep current password' : 'Leave empty for default (user1234)' }}"
                                 class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"/>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        {{ $form->id ? 'Only fill if you want to change the password' : 'Default password: user1234' }}
                    </p>
                </div>

                {{-- Permissions Section --}}
                <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                    <h3 class="text-sm font-medium text-gray-700 flex items-center gap-2">
                        <x-phosphor-shield-check class="size-4"/>
                        Permissions & Status
                    </h3>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Admin Toggle --}}
                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <x-phosphor-crown class="size-5 text-purple-600"/>
                                    <div>
                                        <span class="text-sm font-medium text-gray-900">Administrator</span>
                                        <p class="text-xs text-gray-500">Full system access</p>
                                    </div>
                                </div>
                                <input type="checkbox"
                                       wire:model="form.admin"
                                       {{ $form->id === auth()->id() ? 'disabled' : '' }}
                                       class="rounded border-gray-300 text-purple-600 focus:ring-purple-500
                                       {{ $form->id === auth()->id() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            </label>
                            @if($form->id === auth()->id())
                                <p class="text-xs text-amber-600 mt-2">You cannot modify your own admin status</p>
                            @endif
                        </div>

                        {{-- Active Toggle --}}
                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <x-phosphor-check-circle class="size-5 text-green-600"/>
                                    <div>
                                        <span class="text-sm font-medium text-gray-900">Active Account</span>
                                        <p class="text-xs text-gray-500">Can login to system</p>
                                    </div>
                                </div>
                                <input type="checkbox"
                                       wire:model="form.active"
                                       {{ $form->id === auth()->id() ? 'disabled' : '' }}
                                       class="rounded border-gray-300 text-green-600 focus:ring-green-500
                                       {{ $form->id === auth()->id() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            </label>
                            @if($form->id === auth()->id())
                                <p class="text-xs text-amber-600 mt-2">You cannot deactivate your own account</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button @click="$wire.showModal = false" class="mr-3">
                Cancel
            </x-secondary-button>
            @if(is_null($form->id))
                <x-tmk.button color="success" wire:click="createUser">
                    Create User
                </x-tmk.button>
            @else
                <x-tmk.button color="primary"
                              wire:click="updateRecord({{ $form->id }})">
                    Save Changes
                </x-tmk.button>
            @endif
        </x-slot>
    </x-dialog-modal>

    {{-- Delete Confirmation Modal --}}
    <x-confirmation-modal wire:model.live="showDeleteModal">
        <x-slot name="title">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-medium text-gray-900">Delete User Account</h3>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="mt-2">
                <p class="text-sm text-gray-500">
                    Are you sure you want to delete this user account? This action cannot be undone.
                </p>
                @if($userToDelete)
                    <div class="mt-4 p-4 bg-red-50 rounded-lg border border-red-200">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-red-500 to-pink-500 flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr($userToDelete->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $userToDelete->name }}</p>
                                <p class="text-sm text-gray-500">{{ $userToDelete->email }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="cancelDelete" wire:loading.attr="disabled" class="mr-3">
                Cancel
            </x-secondary-button>

            <x-danger-button wire:click="deleteUser" wire:loading.attr="disabled">
                <x-phosphor-trash class="size-5 mr-2"/>
                Delete User
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>

    {{-- Password Generated Modal --}}
    <x-dialog-modal wire:model.live="showPasswordModal">
        <x-slot name="title">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <x-phosphor-key class="size-6 text-green-600"/>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Password Generated Successfully</h3>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="mt-2">
                <p class="text-sm text-gray-500 mb-4">
                    A new password has been generated for <span class="font-medium text-gray-900">{{ $userForPassword?->name }}</span>
                </p>

                <div class="relative">
                    <div class="p-6 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg border border-indigo-200">
                        <p class="text-xs text-gray-600 uppercase tracking-wider mb-2">New Password</p>
                        <p class="font-mono text-2xl text-gray-900 text-center select-all">
                            {{ $generatedPassword }}
                        </p>
                    </div>
                    <button onclick="navigator.clipboard.writeText('{{ $generatedPassword }}')"
                            class="absolute top-2 right-2 p-2 text-gray-500 hover:text-gray-700 hover:bg-white rounded-lg transition-colors"
                            title="Copy to clipboard">
                        <x-phosphor-copy class="size-5"/>
                    </button>
                </div>

                <div class="mt-4 p-3 bg-amber-50 rounded-lg border border-amber-200">
                    <div class="flex items-start gap-2">
                        <x-phosphor-warning-circle class="size-5 text-amber-600 flex-shrink-0 mt-0.5"/>
                        <p class="text-xs text-amber-800">
                            Make sure to save this password securely. It won't be shown again and is not stored in plain text.
                        </p>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-tmk.button color="primary" wire:click="closePasswordModal" full="true">
                <x-phosphor-check class="size-5 mr-2"/>
                Done
            </x-tmk.button>
        </x-slot>
    </x-dialog-modal>
</div>
