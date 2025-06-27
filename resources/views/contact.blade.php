<x-earthify-layout>
    <x-slot name="title">Earthify Shop: contact info</x-slot>
    <x-slot name="subtitle">Contact info</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-green-600 via-emerald-500 to-teal-600 bg-clip-text text-transparent mb-4">
                Get in Touch
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Ready to start your sustainable journey? We'd love to hear from you.
            </p>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 lg:gap-12">
            <!-- Contact Form Section -->
            <div class="xl:col-span-8 xl:order-2">
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-gray-100 p-8 lg:p-10 hover:shadow-3xl transition-all duration-500">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Send us a message</h2>
                        <p class="text-gray-600">Fill out the form below and we'll get back to you within 24 hours.</p>
                    </div>
                    {{-- embed the Livewire ContactForm component --}}
                    @livewire('contact-form')
                </div>
            </div>

            <!-- Contact Info Section -->
            <div class="xl:col-span-4 xl:order-1">
                <div class="sticky top-8">
                    <!-- Company Info Card -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl p-8 shadow-xl border border-green-100 mb-8 hover:shadow-2xl transition-all duration-500">
                        <div class="flex items-center mb-6">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-3 rounded-2xl shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-900">Earthify Shop</h3>
                                <p class="text-sm text-green-600 font-medium">Sustainable Living Store</p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="space-y-4">
                            <div class="flex items-start group">
                                <div class="bg-white p-2 rounded-xl shadow-sm group-hover:shadow-md transition-shadow duration-300">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-900">Visit our store</p>
                                    <p class="text-gray-600">Kleinhoefstraat 4</p>
                                    <p class="text-gray-600">2440 Geel - Belgium</p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-center group cursor-pointer hover:bg-white/50 p-3 rounded-xl transition-colors duration-300">
                                <div class="bg-white p-2 rounded-xl shadow-sm group-hover:shadow-md transition-shadow duration-300">
                                    <x-phosphor-phone-call class="w-5 h-5 text-green-500"/>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Call us</p>
                                    <a href="tel:+3214562310" class="text-green-600 hover:text-green-700 font-semibold transition-colors duration-200">
                                        +32(0)14/56.23.10
                                    </a>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-center group cursor-pointer hover:bg-white/50 p-3 rounded-xl transition-colors duration-300">
                                <div class="bg-white p-2 rounded-xl shadow-sm group-hover:shadow-md transition-shadow duration-300">
                                    <x-heroicon-o-envelope-open class="w-5 h-5 text-green-500"/>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Email us</p>
                                    <a href="mailto:info@earthify.com" class="text-green-600 hover:text-green-700 font-semibold transition-colors duration-200">
                                        info@earthify.com
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Hours Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-6 shadow-xl border border-blue-100 hover:shadow-2xl transition-all duration-500">
                        <div class="flex items-center mb-4">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 p-2 rounded-xl shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="ml-3 text-lg font-bold text-gray-900">Business Hours</h4>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Mon - Fri:</span>
                                <span class="font-semibold text-gray-900">9:00 - 18:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Saturday:</span>
                                <span class="font-semibold text-gray-900">10:00 - 16:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Sunday:</span>
                                <span class="font-semibold text-gray-900">Closed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-earthify-layout>
