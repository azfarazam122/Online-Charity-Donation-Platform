<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('All Donations') }}
        </h2>
    </x-slot>

    {{-- Search Form --}}
    <div class="p-4 mb-6 bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <form method="GET" action="{{ route('admin.donations.index') }}">
            <div class="grid grid-cols-1 gap-4 items-end md:grid-cols-3 lg:grid-cols-4">
                <div>
                    <label for="search_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Search by
                        Donor Email:</label>
                    <input type="text" name="search_email" id="search_email" value="{{ $search_email ?? '' }}"
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <div>
                    <label for="search_campaign"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Search by Campaign
                        Title:</label>
                    <input type="text" name="search_campaign" id="search_campaign"
                        value="{{ $search_campaign ?? '' }}"
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <div>
                    <label for="search_stripe_id"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Search by Stripe ID:</label>
                    <input type="text" name="search_stripe_id" id="search_stripe_id"
                        value="{{ $search_stripe_id ?? '' }}"
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <div class="flex space-x-2">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-blue-600 rounded-md border border-transparent transition hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">
                        Search
                    </button>
                    <a href="{{ route('admin.donations.index') }}"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase bg-gray-300 rounded-md border border-transparent transition dark:bg-gray-600 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-500 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-200 dark:focus:ring-gray-500 disabled:opacity-25">
                        Clear
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Donations Table (remains the same) --}}
    <div class="overflow-x-auto bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        {{-- ... your existing table code ... --}}
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            {{-- ... thead ... --}}
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        ID
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        Campaign
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        Donor
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        Email
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
                        Stripe Session ID
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        Status
                    </th>
                </tr>
            </thead>
            {{-- ... tbody with @forelse ... --}}
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @forelse ($donations as $donation)
                    @if ($donation->campaign)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $donation->id }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                <a href="{{ route('admin.campaigns.show', $donation->campaign) }}"
                                    class="text-blue-600 hover:underline dark:text-blue-400">
                                    {{ $donation->campaign->title ?? 'N/A' }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                {{ $donation->user->name ?? ($donation->donor_name ?? 'Guest') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                {{ $donation->user->email ?? ($donation->donor_email ?? 'N/A') }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm font-semibold text-gray-500 whitespace-nowrap dark:text-gray-300">
                                ${{ number_format($donation->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                {{ $donation->created_at->format('M d, Y H:i A') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                {{ $donation->stripe_checkout_session_id }}
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
                    @endif
                @empty
                    <tr>
                        <td colspan="8"
                            class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap dark:text-gray-300">
                            No donations found matching your criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $donations->links() }} {{-- Pagination links --}}
    </div>
</x-admin-layout>
