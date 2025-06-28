<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand Section -->
            <div class="md:col-span-1">
                <div class="flex items-center gap-1 text-2xl font-semibold text-emerald-700 mb-4">
                    <x-phosphor-plant class="w-6 h-6" />
                    Earthify
                </div>
                <p class="text-gray-600 text-sm">
                    Sustainable products for a greener future. Making eco-friendly choices accessible to everyone.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-semibold text-gray-900 mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm">

                    <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600 transition-colors">Home</a></li>
                    <li><a href="{{ route('shop') }}" class="text-gray-600 hover:text-emerald-600 transition-colors">Shop</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-600 hover:text-emerald-600 transition-colors">Contact</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-emerald-600 transition-colors">About Us</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h3 class="font-semibold text-gray-900 mb-4">Customer Service</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-600 hover:text-emerald-600 transition-colors">FAQ</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-emerald-600 transition-colors">Shipping Info</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-emerald-600 transition-colors">Returns</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-emerald-600 transition-colors">Support</a></li>
                </ul>
            </div>

            <!-- Newsletter & Social -->
            <div>
                <h3 class="font-semibold text-gray-900 mb-4">Stay Connected</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Subscribe to our newsletter for updates and eco-tips.
                </p>
                <form class="mb-4">
                    <div class="flex">
                        <input type="email"
                               placeholder="Email address"
                               class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-l-md focus:ring-emerald-500 focus:border-emerald-500">
                        <button type="submit"
                                class="px-4 py-2 bg-emerald-600 text-white text-sm rounded-r-md hover:bg-emerald-700 transition-colors">
                            Subscribe
                        </button>
                    </div>
                </form>

                <!-- Social Links -->
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-emerald-600 transition-colors">
                        <span class="sr-only">Facebook</span>
                        <x-phosphor-facebook-logo class="h-5 w-5" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-emerald-600 transition-colors">
                        <span class="sr-only">Instagram</span>
                        <x-phosphor-pinterest-logo class="h-5 w-5" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-emerald-600 transition-colors">
                        <span class="sr-only">Twitter</span>
                        <x-phosphor-twitter-logo class="h-5 w-5" />
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="mt-8 pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center">
            <div class="text-sm text-gray-600">
                © {{ date('Y') }} Earthify. All rights reserved.
            </div>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-sm text-gray-600 hover:text-emerald-600 transition-colors">Privacy Policy</a>
                <a href="#" class="text-sm text-gray-600 hover:text-emerald-600 transition-colors">Terms of Service</a>
                <a href="#" class="text-sm text-gray-600 hover:text-emerald-600 transition-colors">Cookie Policy</a>
            </div>
        </div>
    </div>

</footer>
