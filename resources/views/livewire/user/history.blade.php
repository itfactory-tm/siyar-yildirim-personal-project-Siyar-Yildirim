<div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-6 items-start">
    @forelse($orders as $order)
        <div class="group flex flex-col bg-white border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 rounded-xl overflow-hidden hover:-translate-y-1">
            <!-- Order Header -->
            <div class="relative p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                <!-- Accent line -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Order Date</p>
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
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
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
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
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
                        <svg class="h-10 w-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">No Orders Found</h3>
                    <p class="text-gray-600 text-lg max-w-md mx-auto leading-relaxed">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                    <div class="mt-6">
                        <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Start Shopping
                        </a>
                    </div>
                </div>
                <!-- Decorative background elements -->
                <div class="absolute top-0 left-0 w-32 h-32 bg-blue-200 rounded-full opacity-20 -translate-x-16 -translate-y-16"></div>
                <div class="absolute bottom-0 right-0 w-24 h-24 bg-indigo-200 rounded-full opacity-20 translate-x-12 translate-y-12"></div>
                <div class="absolute top-1/2 left-1/2 w-16 h-16 bg-purple-200 rounded-full opacity-10 -translate-x-8 -translate-y-8"></div>
            </div>
        </div>
    @endforelse
</div>
