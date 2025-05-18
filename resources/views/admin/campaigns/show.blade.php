<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Campaign Details') }}
            </h2>
            <a href="{{ route('admin.campaigns.index') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-500 rounded-md border border-transparent transition hover:bg-gray-400 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:ring focus:ring-gray-200 disabled:opacity-25 dark:bg-gray-600 dark:hover:bg-gray-500">
                {{ __('Back to Campaigns') }}
            </a>
        </div>
    </x-slot>

    <!-- Unified Max Width Container -->
    <div class="mx-auto mt-6">
        <div class="overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
                    {{ $campaign->title }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                    Campaign overview and details.
                </p>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700">
                <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Campaign Image -->
                    @if ($campaign->image_path)
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Campaign Image
                            </dt>
                            <dd class="flex justify-center mt-1 sm:mt-0 sm:col-span-2">
                                <img src="{{ asset('storage/' . $campaign->image_path) }}" alt="{{ $campaign->title }}"
                                    class="object-contain max-w-full max-h-64 rounded-lg border border-gray-200 shadow-sm dark:border-gray-700">
                            </dd>
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Description
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                            {{ $campaign->description }}
                        </dd>
                    </div>

                    <!-- Goal Amount -->
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Goal Amount
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                            ${{ number_format($campaign->goal_amount, 2) }}
                        </dd>
                    </div>

                    <!-- Status -->
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Status
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $campaign->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                {{ $campaign->status === 'completed' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : '' }}
                                {{ $campaign->status === 'closed' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}">
                                {{ ucfirst($campaign->status) }}
                            </span>
                        </dd>
                    </div>

                    <!-- Created By -->
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Created By
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                            {{ $campaign->user->name }} ({{ $campaign->user->email }})
                        </dd>
                    </div>

                    <!-- Dates -->
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Created At
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                            {{ $campaign->created_at->format('F j, Y, g:i a') }}
                        </dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Last Updated
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                            {{ $campaign->updated_at->format('F j, Y, g:i a') }}
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Footer Actions -->
            <div
                class="px-4 py-3 space-x-2 text-right bg-gray-50 border-t dark:bg-gray-800 sm:px-6 dark:border-gray-700">
                <a href="{{ route('admin.campaigns.edit', $campaign) }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-yellow-500 rounded-md border border-transparent transition hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:border-yellow-600 focus:ring focus:ring-yellow-200 disabled:opacity-25 dark:bg-yellow-600 dark:hover:bg-yellow-500">
                    {{ __('Edit Campaign') }}
                </a>
                <a href="{{ route('admin.campaigns.updates.create', $campaign) }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-teal-500 rounded-md border border-transparent transition hover:bg-teal-400 active:bg-teal-600 focus:outline-none focus:border-teal-600 focus:ring focus:ring-teal-200 disabled:opacity-25 dark:bg-teal-600 dark:hover:bg-teal-500">
                    {{ __('Post New Update') }}
                </a>
                {{-- Delete Form --}}
                <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" class="inline-block"
                    onsubmit="return confirm('Are you sure you want to delete this campaign? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-red-600 rounded-md border border-transparent transition hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 disabled:opacity-25 dark:bg-red-700 dark:hover:bg-red-600">
                        {{ __('Delete Campaign') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
