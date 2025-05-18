<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Donation Successful') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-2xl font-semibold text-green-600 dark:text-green-400 mb-3">Thank You for Your
                            Generous Donation!</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">We greatly appreciate your support for the
                            campaign: <strong class="font-semibold">{{ $campaign->title }}</strong>.</p>
                    </div>

                    @if (isset($donation))
                        <div class="mt-6 border-t dark:border-gray-700 pt-6">
                            <h4 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-3">Donation Summary:</h4>
                            <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Campaign:</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                        {{ $campaign->title }}</dd>
                                </div>
                                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Amount Donated:
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm font-medium text-green-600 dark:text-green-400 sm:mt-0 sm:col-span-2">
                                        ${{ number_format($donation->amount, 2) }}</dd>
                                </div>
                                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date:</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                        {{ $donation->created_at->format('F j, Y, g:i a') }}</dd>
                                </div>
                                @if ($donation->donor_email)
                                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email (for
                                            receipt):</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                            {{ $donation->donor_email }}</dd>
                                    </div>
                                @endif
                                {{-- You can add more details if needed, like a transaction ID from Stripe (though not strictly necessary to show user) --}}
                            </dl>
                        </div>
                    @endif

                    <div class="mt-8 text-center">
                        <a href="{{ route('public.campaigns.show', $campaign) }}"
                            class="text-blue-600 dark:text-blue-400 hover:underline mr-4">
                            {{ __('View Campaign Again') }}
                        </a>
                        <a href="{{ route('public.campaigns.index') }}"
                            class="text-blue-600 dark:text-blue-400 hover:underline">
                            {{ __('Back to All Campaigns') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
