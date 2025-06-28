<div>
    @if(!empty($backorder))
        <x-tmk.alert type="info" dismissible="false" class="mt-6 rounded-xl shadow-lg border-l-4 border-blue-500 bg-gradient-to-r from-blue-50 to-white">
            <div class="flex items-start space-x-3">
                <x-phosphor-info class="w-6 h-6 text-blue-500 mt-1 flex-shrink-0" />
                <div class="flex-1">
                    <p class="font-bold text-blue-900 text-lg">Backorder Notice</p>
                    <p class="text-blue-800 mt-1">The following records are currently out of stock and will be shipped as soon as they are available.</p>
                    <p class="text-blue-700 text-sm mt-2">If these records cannot be delivered within 30 days, you will receive a full refund.</p>
                    <x-tmk.list type="ul" class="mt-3 text-sm font-medium text-blue-800 space-y-1">
                        @foreach($backorder as $item)
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-blue-400 rounded-full mr-2"></span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </x-tmk.list>
                </div>
            </div>
        </x-tmk.alert>
    @endif

    {{-- Cart is not empty --}}
    @guest
        <x-tmk.alert type="warning" class="w-full rounded-xl shadow-md bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200" dismissible="false">
            <div class="flex items-center space-x-3">
                <x-phosphor-warning class="w-6 h-6 text-amber-600 flex-shrink-0" />
                <span class="text-amber-800">
                    You're not logged in. Please
                    <a href="{{ route('login') }}" class="font-semibold underline hover:text-amber-900 transition-colors">login</a> or
                    <a href="{{ route('register') }}" class="font-semibold underline hover:text-amber-900 transition-colors">register</a>
                    to complete your purchase.
                </span>
            </div>
        </x-tmk.alert>
    @endguest

    <x-tmk.section class="mt-6">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <x-phosphor-shopping-cart class="w-6 h-6 mr-2 text-blue-600" />
                    Your Shopping Cart
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                    <tr class="text-gray-700 text-sm uppercase tracking-wider">
                        <th class="px-6 py-4 font-medium text-center">Qty</th>
                        <th class="px-6 py-4 font-medium text-center">Price</th>
                        <th class="px-4 py-4"></th>
                        <th class="px-6 py-4 font-medium text-left">Record</th>
                        <th class="px-6 py-4 font-medium text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach($products as $product)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 font-semibold text-blue-700">
                                        {{ $product['qty'] }}
                                    </span>
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-gray-900">
                                ${{ $product['price'] }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="w-20 h-20 rounded-lg overflow-hidden shadow-md bg-gray-100">
                                    <img src="{{ asset('storage/' . ($product['image'] ?? 'defaults/no-image.png')) }}"
                                         alt="{{ $product['name'] }}"
                                         class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-lg font-semibold text-gray-900">{{ $product['name'] }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-1">
                                    <button wire:click="decreaseQty({{ $product['id'] }})"
                                            class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-red-100 text-gray-700 hover:text-red-600 transition-all duration-200 flex items-center justify-center group shadow-sm hover:shadow">
                                        <x-phosphor-minus class="w-5 h-5" />
                                    </button>
                                    <button wire:click="increaseQty({{ $product['id'] }})"
                                            class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-green-100 text-gray-700 hover:text-green-600 transition-all duration-200 flex items-center justify-center group shadow-sm hover:shadow">
                                        <x-phosphor-plus class="w-5 h-5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                    <x-tmk.form.button wire:click="emptyBasket()"
                                       class="bg-red-500 hover:bg-red-50 text-red-600 border-2 border-red-200 hover:border-red-300 font-medium px-6 py-2.5 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                        <x-phosphor-trash class="w-5 h-5 mr-2 inline-block" />
                        Empty Cart
                    </x-tmk.form.button>

                    <div class="flex items-center space-x-6">
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Total Amount</p>
                            <p class="text-3xl font-bold text-gray-900">${{ $totalPrice }}</p>
                        </div>

                        @auth
                            <x-tmk.form.button wire:click="checkoutForm()"
                                               class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium px-8 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                Proceed to Checkout
                            </x-tmk.form.button>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </x-tmk.section>

    <x-dialog-modal id="checkoutModal" wire:model.live="showModal">
        <x-slot name="title">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                <x-phosphor-map-pin class="w-6 h-6 mr-2 text-blue-600" />
                Complete Your Order
            </h2>
        </x-slot>
        <x-slot name="content">
            <div class="space-y-6">
                <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <x-phosphor-house class="w-5 h-5 mr-2 text-blue-600" />
                        Shipping Address
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <x-label for="address" value="Street Address" class="text-sm font-medium text-gray-700"/>
                            <x-input id="address" type="text"
                                     class="mt-1 block w-full rounded-lg border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                     wire:model.blur="form.address"
                                     placeholder="123 Main Street"/>
                            <x-input-error for="form.address" class="mt-1"/>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-label for="city" value="City" class="text-sm font-medium text-gray-700"/>
                                <x-input id="city" type="text"
                                         class="mt-1 block w-full rounded-lg border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                         wire:model.blur="form.city"
                                         placeholder="New York"/>
                                <x-input-error for="form.city" class="mt-1"/>
                            </div>
                            <div>
                                <x-label for="zip" value="ZIP Code" class="text-sm font-medium text-gray-700"/>
                                <x-input id="zip" type="text"
                                         class="mt-1 block w-full rounded-lg border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                         wire:model.blur="form.zip"
                                         placeholder="10001"/>
                                <x-input-error for="form.zip" class="mt-1"/>
                            </div>
                        </div>

                        <div>
                            <x-label for="country" value="Country" class="text-sm font-medium text-gray-700"/>
                            <x-input id="country" type="text"
                                     class="mt-1 block w-full rounded-lg border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                     wire:model.blur="form.country"
                                     placeholder="United States"/>
                            <x-input-error for="form.country" class="mt-1"/>
                        </div>

                        <div>
                            <x-label for="notes" value="Order Notes (Optional)" class="text-sm font-medium text-gray-700"/>
                            <x-tmk.form.textarea id="notes" name="notes" rows="3"
                                                 wire:model.blur="form.notes"
                                                 class="mt-1 w-full rounded-lg border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                 placeholder="Any special instructions for delivery..."/>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end space-x-3">
                <x-secondary-button @click="$wire.showModal = false"
                                    class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </x-secondary-button>
                <x-tmk.form.button wire:click="checkout()"
                                   class="px-6 py-2.5 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                    Place Order
                </x-tmk.form.button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
