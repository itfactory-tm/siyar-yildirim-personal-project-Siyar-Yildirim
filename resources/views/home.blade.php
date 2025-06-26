<x-earthify-layout>
    <x-slot name="title">Earthify Save Earth Together</x-slot>
    <x-slot name="description">Join the global movement for a sustainable future. Plant trees, reduce waste, and clean our oceans with Earthify.</x-slot>

    <section class="min-h-screen -mt-20 pt-20 bg-white flex items-center">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                Save Earth Together
            </h1>

            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Join the global movement for a sustainable future. Plant trees, reduce waste, and clean our oceans.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('shop') }}"
                   class="px-8 py-4 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
                    Get Started
                </a>
                <a href="#features"
                   class="px-8 py-4 border-2 border-green-600 text-green-600 font-semibold rounded-lg hover:bg-green-50">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="features" class="py-20 bg-gradient-to-b from-gray-100 to-green-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-4 text-gray-800">
                Our Mission
            </h2>
            <p class="text-xl text-center text-gray-600 mb-16 max-w-3xl mx-auto">
                Together, we can make a real difference in protecting our planet for future generations.
            </p>

            <div class="grid md:grid-cols-3 gap-8" x-data="{ hoveredCard: null }">
                {{-- Plant Trees Card --}}
                <div @mouseenter="hoveredCard = 'trees'"
                     @mouseleave="hoveredCard = null"
                     class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer border-2 border-transparent hover:border-green-400">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center text-4xl group-hover:animate-pulse">
                        🌱
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Plant Trees</h3>
                    <p class="text-gray-600">Join our global reforestation initiative and help plant millions of trees worldwide</p>
                    <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('shop') }}" class="text-green-500 font-semibold hover:text-green-600">
                            Learn more →
                        </a>
                    </div>
                </div>

                {{-- Reduce Waste Card --}}
                <div @mouseenter="hoveredCard = 'waste'"
                     @mouseleave="hoveredCard = null"
                     class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer border-2 border-transparent hover:border-emerald-400">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center text-4xl group-hover:animate-pulse">
                        ♻️
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Reduce Waste</h3>
                    <p class="text-gray-600">Learn effective ways to minimize your environmental footprint and live sustainably</p>
                    <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('shop') }}" class="text-emerald-500 font-semibold hover:text-emerald-600">
                            Learn more →
                        </a>
                    </div>
                </div>

                {{-- Clean Oceans Card --}}
                <div @mouseenter="hoveredCard = 'oceans'"
                     @mouseleave="hoveredCard = null"
                     class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer border-2 border-transparent hover:border-blue-400">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-4xl group-hover:animate-pulse">
                        🌊
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Clean Oceans</h3>
                    <p class="text-gray-600">Support ocean cleanup projects and protect marine life for future generations</p>
                    <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('shop') }}" class="text-blue-500 font-semibold hover:text-blue-600">
                            Learn more →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-b from-green-50 to-gray-100">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800">
                Ready to Make a Difference?
            </h2>
            <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto">
                Start your journey towards a more sustainable lifestyle today. Every action counts.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('shop') }}"
                   class="px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-bold rounded-full hover:shadow-lg hover:shadow-green-500/50 transform hover:-translate-y-1 transition-all duration-300">
                    Shop Eco-Friendly Products
                </a>
                <a href="{{ route('contact') }}"
                   class="px-8 py-4 border-2 border-gray-800 text-gray-800 font-bold rounded-full hover:bg-gray-800 hover:text-white transform hover:-translate-y-1 transition-all duration-300">
                    Get In Touch
                </a>
            </div>
        </div>
    </section>
</x-earthify-layout>
