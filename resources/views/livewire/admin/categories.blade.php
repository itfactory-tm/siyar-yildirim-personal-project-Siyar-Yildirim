<div>
    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Category Management</h1>
        <p class="mt-2 text-gray-600">Organize and manage your product categories</p>
    </div>

    {{-- Add New Category Section --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-6">
        {{-- Section Header --}}
        <div class="p-6 bg-gradient-to-r from-gray-50 to-white">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Add New Category</h2>
            <div class="flex items-start gap-4">
                <div class="relative flex-1 max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <x-phosphor-folder-plus class="size-5 text-gray-400"/>
                    </div>
                    <x-input id="newCategory" type="text" placeholder="Enter category name..."
                             @keydown.enter="$el.setAttribute('disabled', true); $el.value = '';"
                             @keydown.tab="$el.setAttribute('disabled', true); $el.value = '';"
                             @keydown.esc="$el.setAttribute('disabled', true); $el.value = '';"
                             wire:model="newCategory"
                             wire:keydown.enter="create()"
                             wire:keydown.tab="create()"
                             wire:keydown.escape="resetValues()"
                             class="pl-10 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 placeholder-gray-400 shadow-sm"/>
                    <x-phosphor-arrows-clockwise
                        wire:loading
                        wire:target="create"
                        class="hidden size-5 text-blue-500 absolute top-3 right-3 animate-spin"/>
                </div>
                <x-tmk.button wire:click="create()" color="primary" size="lg" class="shadow-sm">
                    <x-phosphor-plus class="size-5 mr-2"/>
                    Add Category
                </x-tmk.button>
            </div>
            <x-input-error for="newCategory" class="mt-2"/>
        </div>

        {{-- Quick Stats Bar --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            <div class="flex items-center gap-6 text-sm">
                <span class="text-gray-600">
                    Total Categories: <span class="font-semibold text-gray-900">{{ $categories->count() }}</span>
                </span>
                <span class="text-gray-600">
                    With Products: <span class="font-semibold text-blue-600">{{ $categories->where('products_count', '>', 0)->count() }}</span>
                </span>
                <span class="text-gray-600">
                    Empty: <span class="font-semibold text-orange-600">{{ $categories->where('products_count', 0)->count() }}</span>
                </span>
            </div>
        </div>
    </div>

    {{-- Error Messages Section --}}
    @if ($errors->has('delete'))
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <x-phosphor-warning-circle class="size-5 text-red-400" />
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">
                        Unable to Delete Category
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                        {{ $errors->first('delete') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Success Messages Section --}}
    @if (session()->has('message'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <x-phosphor-check-circle class="size-5 text-green-400" />
                </div>
                <div class="ml-3">
                    <div class="text-sm text-green-700">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Categories Table Section --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        {{-- Table Header --}}
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Existing Categories</h2>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <colgroup>
                    <col class="w-20">
                    <col class="w-32">
                    <col class="w-28">
                    <col class="w-max">
                </colgroup>
                <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <x-tmk.table.sortable-header
                        wire:click="resort('id')" position="center" :sortColumn="$sortColumn" :sortOrder="$sortOrder"
                        class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors">
                        <div class="flex items-center justify-center gap-1">
                            ID
                            @if($sortColumn === 'id')
                                @if($sortOrder === 'asc')
                                    <x-phosphor-arrow-up class="size-3"/>
                                @else
                                    <x-phosphor-arrow-down class="size-3"/>
                                @endif
                            @else
                                <x-phosphor-arrows-down-up class="size-3 opacity-30"/>
                            @endif
                        </div>
                    </x-tmk.table.sortable-header>
                    <x-tmk.table.sortable-header
                        wire:click="resort('products_count')" position="center" :sortColumn="$sortColumn" :sortOrder="$sortOrder"
                        class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors">
                        <div class="flex items-center justify-center gap-1">
                            Products
                            @if($sortColumn === 'products_count')
                                @if($sortOrder === 'asc')
                                    <x-phosphor-arrow-up class="size-3"/>
                                @else
                                    <x-phosphor-arrow-down class="size-3"/>
                                @endif
                            @else
                                <x-phosphor-arrows-down-up class="size-3 opacity-30"/>
                            @endif
                        </div>
                    </x-tmk.table.sortable-header>
                    <th class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                        Actions
                    </th>
                    <x-tmk.table.sortable-header
                        wire:click="resort('name')" :sortColumn="$sortColumn" :sortOrder="$sortOrder"
                        class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-left cursor-pointer hover:bg-gray-100 transition-colors">
                        <div class="flex items-center gap-1">
                            Category Name
                            @if($sortColumn === 'name')
                                @if($sortOrder === 'asc')
                                    <x-phosphor-arrow-up class="size-3"/>
                                @else
                                    <x-phosphor-arrow-down class="size-3"/>
                                @endif
                            @else
                                <x-phosphor-arrows-down-up class="size-3 opacity-30"/>
                            @endif
                        </div>
                    </x-tmk.table.sortable-header>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $category)
                    <tr wire:key="{{ $category->id }}" class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                            #{{ $category->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($category->products_count > 0)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200">
                                        {{ $category->products_count }}</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                    0</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($editCategory['id'] !== $category->id)
                                <div class="flex items-center justify-center gap-2">
                                    <button
                                        wire:click="edit({{ $category->id }})"
                                        class="inline-flex items-center p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200"
                                        title="Edit category">
                                        <x-phosphor-pencil-line class="size-5"/>
                                    </button>
                                    <button
                                        wire:click="delete({{ $category->id }})"
                                        wire:confirm="Are you sure you want to delete this category?"
                                        class="inline-flex items-center p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200"
                                        title="Delete category">
                                        <x-phosphor-trash class="size-5"/>
                                    </button>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($editCategory['id'] !== $category->id)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-semibold text-sm">
                                            {{ strtoupper(substr($category->name, 0, 2)) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $category->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center gap-3">
                                    <div class="relative flex-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <x-phosphor-pencil class="size-4 text-gray-400"/>
                                        </div>
                                        <x-input id="edit_{{ $category->id }}" type="text"
                                                 x-init="$el.focus()"
                                                 @keydown.enter="$el.setAttribute('disabled', true);"
                                                 @keydown.tab="$el.setAttribute('disabled', true);"
                                                 @keydown.esc="$el.setAttribute('disabled', true);"
                                                 wire:model="editCategory.name"
                                                 wire:keydown.enter="update({{ $category->id }})"
                                                 wire:keydown.tab="update({{ $category->id }})"
                                                 wire:keydown.escape="resetValues()"
                                                 class="pl-10 w-full max-w-xs rounded-lg border-blue-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200"/>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button
                                            wire:click="update({{ $category->id }})"
                                            class="inline-flex items-center p-2 text-green-600 hover:bg-green-50 rounded-lg transition-all duration-200"
                                            title="Save">
                                            <x-phosphor-check-circle class="size-5"/>
                                        </button>
                                        <button
                                            wire:click="resetValues()"
                                            class="inline-flex items-center p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-all duration-200"
                                            title="Cancel">
                                            <x-phosphor-x-circle class="size-5"/>
                                        </button>
                                    </div>
                                </div>
                                <x-input-error for="editCategory.name" class="mt-2"/>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <x-phosphor-folder-open class="size-12 text-gray-400 mb-4"/>
                                <p class="text-lg font-medium text-gray-900">No categories found</p>
                                <p class="text-sm text-gray-500 mt-1">Create your first category to get started</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
