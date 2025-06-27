<x-earthify-layout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-emerald-50 to-green-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-emerald-800 mb-6">
                    Welcome to <span class="text-emerald-600">Earthify</span>
                </h1>
                <p class="text-xl text-emerald-700 mb-8 max-w-3xl mx-auto">
                    Discover our collection of sustainable products that are good for you and the planet.
                    Together, we're making a difference for a greener future.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('shop') }}"
                       class="inline-flex items-center px-8 py-3 border border-transparent text-lg font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Shop Now
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center px-8 py-3 border-2 border-emerald-600 text-lg font-medium rounded-md text-emerald-600 bg-white hover:bg-emerald-50 transition-colors">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose Earthify?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    We believe in products that make a positive impact on our world
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="text-center p-6 rounded-lg bg-emerald-50">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9V3" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Sustainable & Ethical</h3>
                    <p class="text-gray-600">
                        All our products are carefully selected based on sustainability and ethical production practices
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center p-6 rounded-lg bg-emerald-50">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Quality Guaranteed</h3>
                    <p class="text-gray-600">
                        High-quality products that last long and are worth your investment
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center p-6 rounded-lg bg-emerald-50">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Fair Pricing</h3>
                    <p class="text-gray-600">
                        Transparent pricing with no hidden costs. Sustainability doesn't have to be expensive
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-earthify-layout>
