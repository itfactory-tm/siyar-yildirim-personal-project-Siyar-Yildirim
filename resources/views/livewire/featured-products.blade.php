<div>
    <!-- Featured Products Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $title }}</h2>
                <p class="text-lg text-gray-600">Discover our handpicked selection of sustainable products</p>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div wire:key="featured-{{ $product->id }}" class="group relative bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-200">
                            <!-- Product Image -->
                            <div class="aspect-w-16 aspect-h-12 bg-gray-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-emerald-100 to-green-200 flex items-center justify-center">
                                        <x-phosphor-image class="w-12 h-12 text-emerald-400" />
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <!-- Product Name -->
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors">{{ $product->name }}</h3>

                                <!-- Description -->
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>

                                <!-- Price and Stock -->
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xl font-bold">${{ number_format($product->price, 2) }}</span>
                                    <span class="text-sm text-gray-500">{{ $product->stock }} in stock</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- View All Products Link -->
                <div class="text-center mt-8">
                    <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 border border-emerald-600 text-emerald-600 font-medium rounded-md hover:bg-emerald-600 hover:text-white transition-all duration-200">
                        View All Products
                        <x-phosphor-arrow-right class="w-4 h-4 ml-2" />
                    </a>
                </div>
            @else
                <!-- No Products State -->
                <div class="text-center py-12">
                    <x-phosphor-package class="w-16 h-16 text-gray-400 mx-auto mb-4" />
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No products available</h3>
                    <p class="text-gray-600">Check back soon for new sustainable products!</p>
                </div>
            @endif
        </div>
    </section>
</div>
