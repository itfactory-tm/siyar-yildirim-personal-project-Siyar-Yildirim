<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand Section -->
            <div class="md:col-span-1">
                <div class="flex items-center gap-1 text-2xl font-semibold text-emerald-700 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c1.38 0 2.5-1.12 2.5-2.5S13.38 3 12 3 9.5 4.12 9.5 5.5 10.62 8 12 8zM12 8v13M5 21h14" />
                    </svg>
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
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M20 10C20 4.477 15.523 0 10 0S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-emerald-600 transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zm-2 15V7h4v8h-4zM8 5a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-emerald-600 transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"/>
                        </svg>
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
