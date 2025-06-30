<div>
    {{-- Header Section --}}
    <x-tmk.section class="mb-6" padding="py-8" background="white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Products Management</h1>
                <p class="mt-1 text-sm text-gray-600">Manage your product inventory and details</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <div class="min-w-80">
                    <x-tmk.form.search placeholder="Search products by name..." wire:model.live.debounce.1000ms="search"
                                       size="md" variant="filled" clearable="true" icon="true"/>
                </div>

                <x-tmk.form.button variant="primary" size="md" wire:click="newProduct">New Product</x-tmk.form.button>
            </div>
        </div>
    </x-tmk.section>

    {{-- Stats Cards --}}
    <x-tmk.section class="mb-6" padding="py-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <x-phosphor-archive class="w-6 h-6 text-blue-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Products</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $products->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <x-phosphor-check-circle class="w-6 h-6 text-green-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">In Stock</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $products->where('stock', '>', 0)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <x-phosphor-warning class="w-6 h-6 text-red-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Out of Stock</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $products->where('stock', 0)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </x-tmk.section>

    {{-- Error/Success Messages --}}
    @if (session()->has('error'))
        <x-tmk.section class="mb-4">
            <x-tmk.alert type="danger">
                {{ session('error') }}
            </x-tmk.alert>
        </x-tmk.section>
    @endif

    @if (session()->has('success'))
        <x-tmk.section class="mb-4">
            <x-tmk.alert type="success">
                {{ session('success') }}
            </x-tmk.alert>
        </x-tmk.section>
    @endif

    {{-- Products Table Section --}}
    <x-tmk.section padding="py-6">
        {{-- Table Header with Pagination Controls --}}
        <div class="flex  flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div class="flex items-center gap-4">
                <h2 class="text-lg font-semibold text-gray-900">Products List</h2>

                {{-- Per Page Selector --}}
                <div class="flex items-center gap-2">
                    <label for="perPage" class="text-sm text-gray-600">Show:</label>
                    <x-tmk.form.select id="perPage" wire:model.live="perPage" variant="outline"
                                       size="sm" class="w-20" :options="[5 => '5', 10 => '10', 15 => '15', 20 => '20', 50 => '50']"/>
                    <span class="text-sm text-gray-600">entries</span>
                </div>
            </div>

            <div class="text-sm text-gray-600">
                Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Product
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Stock
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                    <tr wire:key="{{ $product->id }}" class="hover:bg-gray-50 transition-colors duration-200">
                        {{-- Product Info --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-12 w-12 flex-shrink-0">
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                             class="h-12 w-12 rounded-lg object-cover">
                                    @else
                                        <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-black to-gray-50 flex items-center justify-center">
                                            <span class="text-white font-semibold text-lg">{{ $product->name ? substr($product->name, 0, 1) : '?' }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($product->description, 50) }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Category --}}
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $product->category->name ?? 'No Category' }}
                            </span>
                        </td>

                        {{-- Price --}}
                        <td class="px-6 py-4 text-center">
                            <div class="text-sm font-semibold text-gray-900">${{ number_format($product->price, 2) }}</div>
                        </td>

                        {{-- Stock --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center">
                                @if($product->stock > 10)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $product->stock }} units
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        {{ $product->stock }} units
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Out of stock
                                    </span>
                                @endif
                            </div>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <x-tmk.form.button variant="secondary" size="sm" wire:click="editRecord({{ $product->id }})" title="Edit product">
                                    <x-phosphor-pencil class="w-4 h-4 mr-1" />
                                    Edit
                                </x-tmk.form.button>

                                <x-tmk.form.button variant="danger" size="sm" wire:click="confirmDelete({{ $product->id }})" title="Delete product">
                                    <x-phosphor-trash class="w-4 h-4 mr-1" />
                                    Delete
                                </x-tmk.form.button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12">
                            <div class="text-center">
                                <x-phosphor-package class="mx-auto h-12 w-12 text-gray-400" />
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    @if($search)
                                        No products match your search criteria.
                                    @else
                                        Get started by creating your first product.
                                    @endif
                                </p>
                                @if(!$search)
                                    <div class="mt-6"><x-tmk.button color="primary" wire:click="newProduct">
                                            Add Product
                                        </x-tmk.button>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @endif
    </x-tmk.section>

    {{-- Modal for add and update product --}}
    <x-dialog-modal id="productModal" wire:model.live="showModal">
        <x-slot name="title">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                    @if(is_null($form->id))
                        <x-phosphor-plus class="w-6 h-6 text-blue-600" />
                    @else
                        <x-phosphor-pencil class="w-6 h-6 text-blue-600" />
                    @endif
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">
                        {{ is_null($form->id) ? 'Create New Product' : 'Edit Product' }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ is_null($form->id) ? 'Add a new product to your inventory' : 'Update product information' }}
                    </p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            {{-- Error messages --}}
            <x-tmk.error-bag />

            <div class="space-y-6 mt-6">
                {{-- Product Image Upload with Drag & Drop --}}
                <div x-data="{
                    isDragging: false,
                    hasImage: @entangle('form.imageUpload').defer || @entangle('form.image').defer,
                    imagePreview: null,
                    handleDrop(e) {
                        if (e.dataTransfer.files.length > 0) {
                            const file = e.dataTransfer.files[0];
                            if (file.type.startsWith('image/')) {
                                @this.upload('form.imageUpload', file,
                                    (uploadedFilename) => {
                                        // Success callback
                                    },
                                    () => {
                                        // Error callback
                                        alert('Error uploading image. Please try again.');
                                    },
                                    (event) => {
                                        // Progress callback
                                    }
                                );
                                this.previewImage(file);
                            } else {
                                alert('Please upload an image file');
                            }
                        }
                        this.isDragging = false;
                    },
                    previewImage(file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imagePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>

                    {{-- Drag & Drop Zone --}}
                    <div
                        x-on:dragover.prevent="isDragging = true"
                        x-on:dragleave.prevent="isDragging = false"
                        x-on:drop.prevent="handleDrop($event)"
                        :class="{ 'border-blue-500 bg-blue-50': isDragging, 'border-gray-300': !isDragging }"
                        class="relative border-2 border-dashed rounded-lg p-6 transition-colors duration-200"
                    >
                        {{-- Preview existing or uploaded image --}}
                        <div x-show="hasImage || imagePreview" class="mb-4">
                            <div class="relative inline-block">
                                <img
                                    x-show="imagePreview"
                                    :src="imagePreview"
                                    class="h-32 w-32 object-cover rounded-lg"
                                >
                                @if($form->image && !$form->imageUpload)
                                    <img
                                        x-show="!imagePreview && '{{ $form->image }}'"
                                        src="{{ Storage::url($form->image) }}"
                                        class="h-32 w-32 object-cover rounded-lg"
                                    >
                                @endif
                                @if($form->imageUpload)
                                    <img
                                        x-show="!imagePreview"
                                        src="{{ $form->imageUpload->temporaryUrl() }}"
                                        class="h-32 w-32 object-cover rounded-lg"
                                    >
                                @endif
                                <button
                                    type="button"
                                    wire:click="removeImage"
                                    @click="imagePreview = null; hasImage = false"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors"
                                >
                                    <x-phosphor-x class="w-4 h-4" />
                                </button>
                            </div>
                        </div>

                        {{-- Upload instructions --}}
                        <div x-show="!hasImage && !imagePreview" class="text-center">
                            <x-phosphor-image class="mx-auto h-12 w-12 text-gray-400" />
                            <div class="mt-4">
                                <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500">
                                    <span>Upload a file</span>
                                    <input
                                        id="file-upload"
                                        wire:model="form.imageUpload"
                                        type="file"
                                        class="sr-only"
                                        accept="image/*"
                                        @change="if($event.target.files.length > 0) previewImage($event.target.files[0])"
                                    >
                                </label>
                                <p class="pl-1 text-gray-600">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF up to 2MB</p>
                        </div>

                        {{-- Loading state --}}
                        <div wire:loading wire:target="form.imageUpload" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center rounded-lg">
                            <div class="text-center">
                                <svg class="animate-spin h-8 w-8 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-600">Uploading...</p>
                            </div>
                        </div>
                    </div>

                    {{-- Image upload error --}}
                    @error('form.imageUpload')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Product Name --}}
                <div>
                    <x-label for="name" value="Product Name" class="text-sm font-medium text-gray-700" />
                    <x-input id="name" type="text" wire:model="form.name" placeholder="Enter a descriptive product name"
                             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"/>
                </div>

                {{-- Description --}}
                <div>
                    <x-label for="description" value="Description" class="text-sm font-medium text-gray-700" />
                    <x-tmk.form.textarea id="description" name="description" wire:model="form.description"
                                         placeholder="Provide a detailed description of the product" rows="3" maxlength="500"
                                         showCounter="true" class="mt-1"/>
                </div>

                {{-- Category and Supplier Row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-label for="category_id" value="Category" class="text-sm font-medium text-gray-700" />
                        <x-tmk.form.select wire:model="form.category_id" id="category_id" name="category_id"
                                           class="mt-1 w-full" variant="default" emptyText="Select a category">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </x-tmk.form.select>
                    </div>

                    <div>
                        <x-label for="supplier_id" value="Supplier" class="text-sm font-medium text-gray-700" />
                        <x-tmk.form.select wire:model="form.supplier_id" id="supplier_id" name="supplier_id"
                                           class="mt-1 w-full" variant="default" emptyText="Select a supplier">
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </x-tmk.form.select>
                    </div>
                </div>

                {{-- Price and Stock Row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-label for="price" value="Price ($)" class="text-sm font-medium text-gray-700" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <x-input id="price" type="number" step="0.01" min="0" wire:model="form.price" placeholder="0.00"
                                     class="pl-7 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"/>
                        </div>
                    </div>

                    <div>
                        <x-label for="stock" value="Stock Quantity" class="text-sm font-medium text-gray-700" />
                        <x-input id="stock" type="number" min="0" wire:model="form.stock" placeholder="0"
                                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"/>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end space-x-3">
                <x-tmk.form.button variant="secondary" @click="$wire.showModal = false">
                    Cancel
                </x-tmk.form.button>

                @if(is_null($form->id))
                    <x-tmk.form.button variant="success" wire:click="createProduct" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="createProduct">Create Product</span>
                        <span wire:loading wire:target="createProduct">Creating...</span>
                    </x-tmk.form.button>
                @else
                    <x-tmk.form.button variant="primary" wire:click="updateRecord({{ $form->id }})" wire:loading.attr="disabled">
                        <x-phosphor-check class="w-4 h-4 mr-2 text-current" />
                        <span wire:loading.remove wire:target="updateRecord">Save Changes</span>
                        <span wire:loading wire:target="updateRecord">Saving...</span>
                    </x-tmk.form.button>
                @endif
            </div>
        </x-slot>
    </x-dialog-modal>

    {{-- Enhanced Delete Confirmation Modal --}}
    <x-confirmation-modal wire:model.live="showDeleteModal">
        <x-slot name="title">
            <div class="flex items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Delete Product</h3>
                    <p class="text-sm text-gray-500">This action cannot be undone</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-tmk.alert type="warning" class="mb-4">
                    <strong>Warning:</strong> You are about to permanently delete this product from your inventory.
                </x-tmk.alert>

                @if($productToDelete)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900">Product Details:</h4>
                        <div class="mt-2 space-y-1 text-sm text-gray-600">
                            <p><span class="font-medium">Name:</span> {{ $productToDelete->name }}</p>
                            <p><span class="font-medium">Price:</span> ${{ number_format($productToDelete->price, 2) }}</p>
                            <p><span class="font-medium">Stock:</span> {{ $productToDelete->stock }} units</p>
                            @if($productToDelete->image)
                                <div class="mt-3">
                                    <span class="font-medium">Image:</span>
                                    <img src="{{ Storage::url($productToDelete->image) }}" alt="{{ $productToDelete->name }}" class="mt-2 h-20 w-20 object-cover rounded-lg">
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <p class="mt-4 text-sm text-gray-600">
                    Are you sure you want to delete this product? This action will permanently remove the product and cannot be undone.
                </p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end space-x-3">
                <x-tmk.form.button variant="secondary" wire:click="cancelDelete" wire:loading.attr="disabled">
                    Cancel
                </x-tmk.form.button>

                <x-tmk.form.button variant="danger" wire:click="deleteProduct" wire:loading.attr="disabled">
                    <x-phosphor-trash class="w-4 h-4 mr-2 text-current" />
                    <span wire:loading.remove wire:target="deleteProduct">Delete Product</span>
                    <span wire:loading wire:target="deleteProduct">Deleting...</span>
                </x-tmk.form.button>
            </div>
        </x-slot>
    </x-confirmation-modal>
</div>
