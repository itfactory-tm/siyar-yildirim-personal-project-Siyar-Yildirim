<div>
    <!-- Export Controls -->
    @if($orders->count() > 0)
        <div class="mb-6 bg-white rounded-xl border border-gray-200 shadow-sm p-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="flex items-center">
                        <input type="checkbox"
                               id="selectAll"
                               wire:model.live="selectAll"
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="selectAll" class="ml-2 text-sm text-gray-700">Select All</label>
                    </div>

                    @if(count($selectedOrders) > 0)
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-600">{{ count($selectedOrders) }} selected</span>
                            <button wire:click="clearSelection"
                                    class="text-xs text-red-600 hover:text-red-800 underline">
                                Clear
                            </button>
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-2">
                    <button wire:click="exportPDF"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200 disabled:opacity-50"
                        {{ count($selectedOrders) === 0 ? 'disabled' : '' }}>
                        <x-phosphor-file-pdf class="w-4 h-4" />
                        Export PDF
                    </button>
                </div>
            </div>

        </div>
    @endif

    <!-- Flash Messages -->
    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-red-800 text-sm">{{ session('error') }}</p>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-green-800 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Orders Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-6 items-start">
        @forelse($orders as $order)
            <div class="group flex flex-col bg-white border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 rounded-xl overflow-hidden hover:-translate-y-1">
                <!-- Order Header -->
                <div class="relative p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                    <div class="absolute top-4 right-4">
                        <input type="checkbox"
                               value="{{ $order->id }}"
                               wire:model.live="selectedOrders"
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    </div>
                    <!-- Accent line -->
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                    <div class="flex items-center gap-3 pr-8">
                        <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <x-phosphor-book class="w-5 h-5 text-blue-600" />
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">Order #{{ $order->id }}</p>
                            <p class="text-gray-600">{{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="flex-1 divide-y divide-gray-100">
                    @foreach($order->orderlines as $orderline)
                        <div class="p-4 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex gap-4">
                                <!-- Product Image -->
                                <div class="relative flex-shrink-0 w-24 h-24 bg-gray-100 rounded-lg overflow-hidden group">
                                    <img src="{{ $orderline->product && $orderline->product->image ? asset('storage/'.$orderline->product->image) : asset('images/placeholder.svg') }}"
                                         alt="{{ $orderline->product_name }}"
                                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                         loading="lazy">
                                    <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1 min-w-0 space-y-2">
                                    <h4 class="font-semibold text-gray-900 truncate leading-tight">{{ $orderline->product_name }}</h4>
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <x-phosphor-tag class="w-4 h-4 text-gray-400" />
                                            <span>Qty: <span class="font-medium">{{ $orderline->quantity }}</span></span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm">
                                            <span class="font-semibold text-green-600">$ {{ number_format($orderline->line_total, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Total -->
                <div class="p-4 bg-gradient-to-r from-gray-50 to-slate-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-semibold text-gray-800">Total</span>
                        </div>
                        <span class="text-2xl font-bold text-green-600">$ {{ number_format($order->total_price, 2) }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="lg:col-span-2 2xl:col-span-3">
                <div class="relative overflow-hidden rounded-xl border border-blue-200 bg-gradient-to-br from-blue-50 to-indigo-50 p-8 text-center">
                    <div class="relative z-10">
                        <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-blue-100">
                            <x-phosphor-shopping-bag class="h-10 w-10 text-blue-600" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">No Orders Found</h3>
                        <p class="text-gray-600 text-lg max-w-md mx-auto leading-relaxed">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                        <div class="mt-6">
                            <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <x-phosphor-shopping-bag class="w-5 h-5" />
                                Start Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
