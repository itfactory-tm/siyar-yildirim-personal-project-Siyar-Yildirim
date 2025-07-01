<div class="space-y-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-6 items-start">
        @forelse($orders as $order)
            <div class="group flex flex-col bg-white border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 rounded-xl overflow-hidden transform hover:-translate-y-1">
                <!-- Order Header -->
                <div class="relative p-4 bg-gradient-to-r from-slate-50 to-blue-50 border-b border-gray-200">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                    <div class="flex justify-between items-start">
                        <div class="space-y-1">
                            <p class="text-sm font-semibold text-gray-800">Order Date</p>
                            <p class="text-gray-600">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-800">Order #</p>
                            <p class="text-blue-600 font-mono text-sm">{{ $order->id }}</p>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="p-4 bg-gradient-to-r from-amber-50 to-orange-50 border-b border-gray-200">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                            <x-phosphor-user class="w-4 h-4 text-amber-600" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ $order->user->name }}</p>
                            <p class="text-sm text-gray-600 truncate">{{ $order->user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="flex-1 divide-y divide-gray-100">
                    @foreach($order->orderlines as $orderline)
                        <div class="p-4 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex gap-4">
                                <!-- Product Image with loading state -->
                                <div class="relative flex-shrink-0 w-20 h-20 bg-gray-100 rounded-lg overflow-hidden group">
                                    <img src="{{ $orderline->product && $orderline->product->image ? asset('storage/'.$orderline->product->image) : asset('images/placeholder.svg') }}"
                                         alt="{{ $orderline->product_name }}"
                                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                         loading="lazy">
                                    <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1 min-w-0 space-y-1">
                                    <h4 class="font-medium text-gray-900 truncate">{{ $orderline->product_name }}</h4>
                                    <div class="flex items-center gap-4 text-sm text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <x-phosphor-tag class="w-4 h-4" />
                                            Qty: {{ $orderline->quantity }}
                                        </span>
                                        <span class="font-semibold text-green-600">€ {{ number_format($orderline->line_total, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Total -->
                <div class="p-4 bg-gradient-to-r from-gray-50 to-slate-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-gray-800">Total</span>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-green-600">€ {{ number_format($order->total_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="lg:col-span-2 2xl:col-span-3">
                <div class="relative overflow-hidden rounded-xl border border-blue-200 bg-gradient-to-br from-blue-50 to-indigo-50 p-8 text-center">
                    <div class="relative z-10">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                            <x-phosphor-shopping-bag class="h-8 w-8 text-blue-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Orders Found</h3>
                        <p class="text-gray-600 max-w-md mx-auto">There are no orders to display at the moment. New orders will appear here once they're placed.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="mt-8">
        {{ $orders->links() }}
    </div>
</div>
