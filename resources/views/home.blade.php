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
                        <x-phosphor-shopping-bag class="h-5 w-5 mr-2" />
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
                        <x-phosphor-globe class="h-8 w-8 text-emerald-600" />
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Sustainable & Ethical</h3>
                    <p class="text-gray-600">
                        All our products are carefully selected based on sustainability and ethical production practices
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center p-6 rounded-lg bg-emerald-50">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-full mb-6">
                        <x-phosphor-check-circle class="h-8 w-8 text-emerald-600" />
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Quality Guaranteed</h3>
                    <p class="text-gray-600">
                        High-quality products that last long and are worth your investment
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center p-6 rounded-lg bg-emerald-50">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-full mb-6">
                        <x-phosphor-currency-circle-dollar class="h-8 w-8 text-emerald-600" />
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Fair Pricing</h3>
                    <p class="text-gray-600">
                        Transparent pricing with no hidden costs. Sustainability doesn't have to be expensive
                    </p>
                </div>
            </div>
        </div>
    </section>

    @livewire('featured-products', [ 'limit' => 3, 'title' => 'Featured Sustainable Products' ])
</x-earthify-layout>
