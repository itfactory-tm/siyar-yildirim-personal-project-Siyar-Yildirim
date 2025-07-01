<div class="bg-white">
    {{-- Pre-loader --}}
    <div class="hidden fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50" wire:loading>
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center space-x-3">
            <x-phosphor-spinner class="animate-spin h-5 w-5 text-indigo-600" />
            <span class="text-gray-700">{{ $loading }}</span>
        </div>
    </div>

    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        {{-- Header --}}
        <div class="border-b border-gray-200 pb-10">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900">Products</h1>
            <p class="mt-4 text-base text-gray-500">Discover our collection of high-quality products carefully selected for you</p>
        </div>

        {{-- Filters --}}
        <div class="pt-12 pb-6">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                {{-- Sidebar (desktop) --}}
                <div class="hidden lg:block">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Filters</h3>
                    {{-- Search --}}
                    <div class="border-b border-gray-200 pb-6">
                        <label for="filter" class="block text-sm font-medium text-gray-700">Search</label>
                        <div class="mt-2">
                            <input id="filter" type="text" wire:model.live.debounce.500ms="filter" placeholder="Product name…"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="border-b border-gray-200 py-6">
                        <h3 class="text-sm font-medium text-gray-900 mb-4">Category</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input id="category-all" name="category" value="%" type="radio" wire:model.live="category"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                <label for="category-all" class="ml-3 text-sm text-gray-600">All Categories</label>
                            </div>
                            @foreach ($allCategories as $cat)
                                <div class="flex items-center">
                                    <input id="category-{{ $cat->id }}" name="category" value="{{ $cat->id }}" type="radio" wire:model.live="category"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                    <label for="category-{{ $cat->id }}" class="ml-3 text-sm text-gray-600">
                                        {{ $cat->name }} <span class="text-gray-400">({{ $cat->products_count }})</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Price range --}}
                    <div class="border-b border-gray-200 py-6">
                        <h3 class="text-sm font-medium text-gray-900 mb-4">Price Range</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">{{ $priceMin }}$</span>
                                <span class="font-medium text-gray-900">{{ $price }}$</span>
                                <span class="text-gray-500">{{ $priceMax }}$</span>
                            </div>
                            <input type="range" wire:model.live.debounce.500ms="price" min="{{ $priceMin }}" max="{{ $priceMax }}"
                                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"/>
                        </div>
                    </div>

                    {{-- Per-page --}}
                    <div class="py-6">
                        <label for="perPage" class="block text-sm font-medium text-gray-900 mb-2">Items per page</label>
                        <select id="perPage" wire:model.live="perPage"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach ([3,6,9,12,15,18,24] as $value)
                                <option value="{{ $value }}">{{ $value }} items</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Mobile filter toggle --}}
                <div class="block lg:hidden mb-8" x-data="{ open: false }">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                        <button class="text-sm font-medium text-indigo-600 hover:text-indigo-500" @click="open = !open">
                            <span x-show="!open">Show filters</span>
                            <span x-show="open">Hide filters</span>
                        </button>
                    </div>

                    <div x-show="open" x-cloak class="mt-4 border-t border-gray-200 pt-4">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            {{-- Search --}}
                            <div>
                                <label for="m-filter" class="block text-sm font-medium text-gray-700">Search</label>
                                <input id="m-filter" type="text" wire:model.live.debounce.500ms="filter" placeholder="Product name…"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                            </div>

                            {{-- Category --}}
                            <div>
                                <label for="m-category" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="m-category" wire:model.live="category"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="%">All Categories</option>
                                    @foreach ($allCategories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }} ({{ $cat->products_count }})</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Price --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Max price: {{ $price }}$</label>
                                <input type="range" wire:model.live.debounce.500ms="price" min="{{ $priceMin }}" max="{{ $priceMax }}"
                                    class="mt-1 w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"/>
                            </div>

                            {{-- Per-page --}}
                            <div>
                                <label for="m-perPage" class="block text-sm font-medium text-gray-700">Items per page</label>
                                <select id="m-perPage" wire:model.live="perPage"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @foreach ([3,6,9,12,15,18,24] as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Product grid --}}
                <div class="lg:col-span-3">
                    {{-- Active filter chips --}}
                    @if ($filter || $category !== '%' || $price < $priceMax)
                        <div class="mb-6">
                            <div class="flex items-center">
                                <h3 class="text-sm font-medium text-gray-500 mr-3">Active filters:</h3>
                                <div class="flex flex-wrap gap-2">
                                    @if($filter)
                                        <span class="inline-flex items-center gap-x-0.5 rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                            {{ $filter }}
                                            <button type="button" wire:click="$set('filter', '')" class="group -mr-1 h-3.5 w-3.5 rounded-sm hover:bg-gray-500/20 relative">
                                                <x-phosphor-x class="h-3.5 w-3.5 stroke-gray-600/50 group-hover:stroke-gray-600/75" />
                                            </button>
                                        </span>
                                    @endif

                                    @if($category !== '%')
                                        <span class="inline-flex items-center gap-x-0.5 rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                            {{ $allCategories->find($category)?->name }}
                                            <button type="button" wire:click="$set('category', '%')" class="group -mr-1 h-3.5 w-3.5 rounded-sm hover:bg-gray-500/20 relative">
                                                <x-phosphor-x class="h-3.5 w-3.5 stroke-gray-600/50 group-hover:stroke-gray-600/75" />
                                            </button>
                                        </span>
                                    @endif

                                    @if($price < $priceMax)
                                        <span class="inline-flex items-center gap-x-0.5 rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                            Max {{ $price }}$
                                            <button type="button" wire:click="$set('price', {{ $priceMax }})" class="group -mr-1 h-3.5 w-3.5 rounded-sm hover:bg-gray-500/20 relative">
                                                <x-phosphor-x class="h-3.5 w-3.5 stroke-gray-600/50 group-hover:stroke-gray-600/75" />
                                            </button>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Grid --}}
                    <div class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-8 lg:grid-cols-3 lg:gap-x-6">
                        @forelse ($products as $product)
                            <div wire:key="product-{{ $product->id }}"
                                 class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white cursor-pointer hover:shadow-lg transition-shadow duration-200"
                                 wire:click="showProduct({{ $product->id }})">

                                <div class="bg-white flex items-center justify-center aspect-square">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" loading="lazy"
                                            class="h-full w-full object-cover object-center group-hover:opacity-90 transition-opacity"/>
                                    @else
                                        <div class="flex items-center justify-center h-full w-full bg-gray-100 text-gray-400 group-hover:bg-gray-200 transition-colors">
                                            <x-phosphor-image class="h-10 w-10" />
                                        </div>
                                    @endif

                                    {{-- Hover overlay --}}
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-5 transition-all duration-200 flex items-center justify-center">
                                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 bg-white rounded-full p-2 shadow-lg">
                                            <x-phosphor-eye class="h-5 w-5 text-indigo-600" />
                                        </div>
                                    </div>
                                </div>

                                {{-- Details --}}
                                <div class="flex flex-1 flex-col space-y-2 p-3">
                                    <h3 class="text-sm font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">
                                        {{ $product->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                    <div class="flex flex-1 flex-col justify-end">
                                        <div class="flex items-center justify-between">
                                            <p class="text-base font-medium text-gray-900">{{ number_format($product->price, 2) }}$</p>
                                            @if($product->stock <= 0)
                                                <span class="text-xs font-semibold text-red-600 bg-red-50 px-2 py-1 rounded">Uitverkocht</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <div class="text-center py-12">
                                    <x-phosphor-envelope class="mx-auto h-12 w-12 text-gray-400" />
                                    <h3 class="mt-2 text-sm font-semibold text-gray-900">No products found</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        @if($filter)
                                            No products matching "{{ $filter }}"
                                        @else
                                            Try adjusting your filters
                                        @endif
                                    </p>
                                    <div class="mt-6">
                                        <button type="button" wire:click="$set('filter', '')"
                                                class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                            Clear search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if($products->hasPages())
                        <div class="mt-12 border-t border-gray-200 pt-6">
                            <nav class="flex items-center justify-between">
                                {{-- Mobile --}}
                                <div class="flex flex-1 justify-between sm:hidden">
                                    @if($products->onFirstPage())
                                        <span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-300">Previous</span>
                                    @else
                                        <button wire:click="previousPage"
                                            class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                        >Previous</button>
                                    @endif

                                    @if($products->hasMorePages())
                                        <button wire:click="nextPage"
                                            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                            Next</button>
                                    @else
                                        <span class="relative ml-3 inline-flex items-centers rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-300">Next</span>
                                    @endif
                                </div>

                                {{-- Desktop --}}
                                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700">
                                            Showing
                                            <span class="font-medium">{{ $products->firstItem() }}</span>
                                            to
                                            <span class="font-medium">{{ $products->lastItem() }}</span>
                                            of
                                            <span class="font-medium">{{ $products->total() }}</span>
                                            results
                                        </p>
                                    </div>
                                    <div>{{ $products->links() }}</div>
                                </div>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Product modal --}}
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">{{ $selectedProduct->name ?? '' }}</x-slot>

        <x-slot name="content">
            @if($selectedProduct)
                <div class="space-y-6">
                    {{-- Image --}}
                    <div class="bg-white flex items-center justify-center rounded-lg">
                        <img src="{{ $selectedProduct->image ? asset('storage/'.$selectedProduct->image) : asset('images/placeholder.svg') }}"
                            alt="{{ $selectedProduct->name }}" class="h-80 w-full object-cover object-center rounded-lg"/>
                    </div>

                    {{-- Category --}}
                    <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                    {{ $selectedProduct->category->name ?? 'Uncategorized' }}
                </span>

                    {{-- Description --}}
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 mb-2">Description</h3>
                        <p class="text-sm text-gray-600">{{ $selectedProduct->description }}</p>
                    </div>

                    {{-- Stock Status --}}
                    @if($selectedProduct->stock <= 0)
                        <div class="bg-red-50 border border-red-200 rounded-md p-3">
                            <div class="flex">
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Sold out</h3>
                                    <p class="mt-1 text-sm text-red-700">This product is currently not available.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-green-50 border border-green-200 rounded-md p-3">
                            <div class="flex">
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-green-800">In stock</h3>
                                    <p class="mt-1 text-sm text-green-700">{{ $selectedProduct->stock }} pieces available</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Price --}}
                    <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                        <span class="text-base text-gray-900">Price</span>
                        <span class="text-2xl font-semibold text-gray-900">{{ number_format($selectedProduct->price, 2) }}$</span>
                    </div>
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-between w-full">
                <button type="button" wire:click="$set('showModal', false)"
                    class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Close</button>

                @if($selectedProduct && $selectedProduct->stock > 0)
                    <button type="button"
                            class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            wire:click="addToBasket({{ $selectedProduct->id }}); $set('showModal', false)">
                        Add to Basket
                    </button>
                @endif
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
