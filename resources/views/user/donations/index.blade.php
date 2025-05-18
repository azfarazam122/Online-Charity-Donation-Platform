<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('My Donation History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($donations->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400">
                            You have not made any donations yet.
                        </p>
                        <div class="mt-4 text-center">
                            <a href="{{ route('public.campaigns.index') }}"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-blue-600 rounded-md border border-transparent transition hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">
                                {{ __('View Campaigns to Donate') }}
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                            Campaign
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                            Amount
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                            Date
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                            Status
                                        </th>
                                        {{-- Maybe link to receipt or Stripe session in future --}}
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @foreach ($donations as $donation)
                                        <tr>
                                            <td
                                                class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <a href="{{ route('public.campaigns.show', $donation->campaign) }}"
                                                    class="text-blue-600 hover:underline dark:text-blue-400">
                                                    {{ $donation->campaign->title ?? 'N/A' }}
                                                </a>
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm font-semibold text-gray-500 whitespace-nowrap dark:text-gray-300">
                                                ${{ number_format($donation->amount, 2) }}
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                                {{ $donation->created_at->format('M d, Y H:i A') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $donation->status === 'succeeded' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                                    {{ $donation->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                                    {{ $donation->status === 'failed' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}">
                                                    {{ ucfirst($donation->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            {{ $donations->links() }} {{-- Pagination links --}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
