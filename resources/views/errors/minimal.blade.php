<x-earthify-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-emerald-100 dark:from-gray-900 dark:to-emerald-900">
        <div class="text-center px-6 py-12 max-w-2xl mx-auto">
            <!-- Error Code -->
            <h1 class="text-9xl font-bold text-emerald-600 dark:text-emerald-400 mb-4 animate-pulse">
                @yield('code')
            </h1>

            <!-- Error Message -->
            <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                @yield('message')
            </h2>

            <!-- Description -->
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
                Sorry, something went wrong. The page you're looking for might have been removed, had its name changed, or is temporarily unavailable.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/" class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition duration-200 transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Go Home
                </a>

                <button onclick="history.back()" class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium rounded-lg transition duration-200 transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Go Back
                </button>
            </div>
        </div>
    </div>
</x-earthify-layout>
