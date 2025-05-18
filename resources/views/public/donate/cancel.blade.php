<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Donation Cancelled') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <h3 class="text-2xl font-semibold text-yellow-600 dark:text-yellow-400 mb-4">Donation Cancelled</h3>
                    <p class="mb-6">Your donation process was cancelled. You have not been charged.</p>
                    <p class="mb-6">If you'd like to try again or choose a different amount, please return to the
                        campaign page.</p>
                    <a href="{{ route('public.campaigns.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                        {{ __('Back to Campaigns') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
