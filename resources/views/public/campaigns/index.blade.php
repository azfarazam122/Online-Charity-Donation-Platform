<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap gap-y-4 justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Active Campaigns') }}
            </h2>

            {{-- Sort Options Form --}}
            <form method="GET" action="{{ route('public.campaigns.index') }}" class="flex gap-2 items-center">
                <label for="sortBy" class="text-sm font-medium text-gray-700 dark:text-gray-300">Sort by:</label>
                <select name="sortBy" id="sortBy" onchange="this.form.submit()"
                    class="text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    <option value="newest" {{ ($currentSortBy ?? 'newest') == 'newest' ? 'selected' : '' }}>Newest
                    </option>
                    <option value="oldest" {{ ($currentSortBy ?? '') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                    <option value="goal_high" {{ ($currentSortBy ?? '') == 'goal_high' ? 'selected' : '' }}>Goal: High
                        to Low</option>
                    <option value="goal_low" {{ ($currentSortBy ?? '') == 'goal_low' ? 'selected' : '' }}>Goal: Low to
                        High</option>
                    <option value="most_funded" {{ ($currentSortBy ?? '') == 'most_funded' ? 'selected' : '' }}>Most
                        Funded</option>
                    <option value="closest_to_goal" {{ ($currentSortBy ?? '') == 'closest_to_goal' ? 'selected' : '' }}>
                        Closest to Goal</option>
                </select>
                {{-- A submit button is not strictly necessary due to onchange, but good for accessibility/fallback --}}
                {{-- <button type="submit" class="p-2 ml-2 text-sm text-white bg-blue-500 rounded">Sort</button> --}}
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if ($campaigns->isEmpty())
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6 text-center text-gray-900 dark:text-gray-100">
                        {{ __('There are currently no active campaigns matching your criteria. Please check back later!') }}
                    </div>
                </div>
            @else
                {{-- ... (existing campaign grid code) ... --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($campaigns as $campaign)
                        <div class="flex overflow-hidden flex-col bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                            @if ($campaign->image_path)
                                <a href="{{ route('public.campaigns.show', $campaign) }}">
                                    <img src="{{ asset('storage/' . $campaign->image_path) }}"
                                        alt="{{ $campaign->title }}" class="object-cover w-full h-48">
                                </a>
                            @else
                                <a href="{{ route('public.campaigns.show', $campaign) }}">
                                    <div
                                        class="flex justify-center items-center w-full h-48 bg-gray-200 dark:bg-gray-700">
                                        <span
                                            class="text-gray-500 dark:text-gray-400">{{ __('No Image Available') }}</span>
                                    </div>
                                </a>
                            @endif
                            <div class="flex flex-col flex-grow p-6">
                                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    <a href="{{ route('public.campaigns.show', $campaign) }}" class="hover:underline">
                                        {{ $campaign->title }}
                                    </a>
                                </h3>
                                <p class="flex-grow mb-3 text-sm text-gray-600 dark:text-gray-400">
                                    {{ Str::limit($campaign->description, 100) }}
                                </p>
                                <div class="mb-3">
                                    <div class="w-full h-2.5 bg-gray-200 rounded-full dark:bg-gray-700">
                                        @php
                                            $progress =
                                                $campaign->goal_amount > 0
                                                    ? ($campaign->current_amount / $campaign->goal_amount) * 100
                                                    : 0;
                                            $progress = min($progress, 100); // Cap at 100%
                                        @endphp
                                        <div class="h-2.5 bg-blue-600 rounded-full"
                                            style="width: {{ $progress }}%"></div>
                                    </div>
                                    <div class="flex justify-between mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        <span>Raised: ${{ number_format($campaign->current_amount, 2) }}</span>
                                        <span>Goal: ${{ number_format($campaign->goal_amount, 2) }}</span>
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('public.campaigns.show', $campaign) }}"
                                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-blue-600 rounded-md border border-transparent transition duration-150 ease-in-out hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">
                                        {{ __('View & Donate') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $campaigns->links() }} {{-- Pagination links --}}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
