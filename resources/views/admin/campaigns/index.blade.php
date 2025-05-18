<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Campaign Management') }}
            </h2>
            <a href="{{ route('admin.campaigns.create') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-blue-600 rounded-md border border-transparent transition hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 dark:bg-blue-500 dark:hover:bg-blue-400">
                Create New Campaign
            </a>
        </div>
    </x-slot>

    {{-- Search and Filter Form --}}
    <div class="p-4 mb-6 bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <form method="GET" action="{{ route('admin.campaigns.index') }}">
            <div class="grid grid-cols-1 gap-4 items-end md:grid-cols-3">
                <div>
                    <label for="search_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Search
                        by Title:</label>
                    <input type="text" name="search_title" id="search_title" value="{{ $search_title ?? '' }}"
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <div>
                    <label for="filter_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter
                        by Status:</label>
                    <select name="filter_status" id="filter_status"
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <option value="">All Statuses</option>
                        <option value="active" {{ ($filter_status ?? '') == 'active' ? 'selected' : '' }}>Active
                        </option>
                        <option value="completed" {{ ($filter_status ?? '') == 'completed' ? 'selected' : '' }}>
                            Completed</option>
                        <option value="closed" {{ ($filter_status ?? '') == 'closed' ? 'selected' : '' }}>Closed
                        </option>
                    </select>
                </div>
                <div class="flex space-x-2">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-blue-600 rounded-md border border-transparent transition hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25">
                        Filter/Search
                    </button>
                    <a href="{{ route('admin.campaigns.index') }}"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase bg-gray-300 rounded-md border border-transparent transition dark:bg-gray-600 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-500 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-200 dark:focus:ring-gray-500 disabled:opacity-25">
                        Clear
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Campaigns Table (rest of the view) --}}
    <div class="overflow-x-auto bg-white shadow-sm dark:bg-gray-700 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
            <thead class="bg-gray-50 dark:bg-gray-600">
                <tr>
                    @php
                        // Helper function to generate sort links
                        // This could also be a Blade component or a helper class for more complex scenarios
                        function sortable_header($column, $displayName, $currentSortBy, $currentSortDirection, $request)
                        {
                            $direction = $currentSortBy == $column && $currentSortDirection == 'asc' ? 'desc' : 'asc';
                            $arrow = '';
                            if ($currentSortBy == $column) {
                                $arrow = $currentSortDirection == 'asc' ? '↑' : '↓'; // Up or down arrow
                            }
                            // Preserve existing query parameters (search, filter)
                            $queryParams = array_merge($request->query(), [
                                'sortBy' => $column,
                                'sortDirection' => $direction,
                            ]);
                            $url = route('admin.campaigns.index', $queryParams);
                            return '<a href="' .
                                $url .
                                '" class="flex items-center group">' .
                                $displayName .
                                '<span class="ml-1 opacity-50 group-hover:opacity-100">' .
                                $arrow .
                                '</span></a>';
                        }
                    @endphp

                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        {!! sortable_header('title', 'Title', $sortBy, $sortDirection, request()) !!}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        {!! sortable_header('goal_amount', 'Goal', $sortBy, $sortDirection, request()) !!}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        {!! sortable_header('current_amount', 'Raised', $sortBy, $sortDirection, request()) !!}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        {!! sortable_header('status', 'Status', $sortBy, $sortDirection, request()) !!}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        Actions
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        {!! sortable_header('created_at', 'Created', $sortBy, $sortDirection, request()) !!}
                    </th>
                </tr>
            </thead>
            {{-- ... tbody ... --}}
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-700 dark:divide-gray-600">
                @forelse ($campaigns as $campaign)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                            {{ $campaign->title }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap dark:text-gray-300">
                            ${{ number_format($campaign->goal_amount, 2) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap dark:text-gray-300">
                            ${{ number_format($campaign->current_amount, 2) }}
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $campaign->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                {{ $campaign->status === 'completed' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : '' }}
                                {{ $campaign->status === 'closed' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}">
                                {{ ucfirst($campaign->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                            <a href="{{ route('admin.campaigns.show', $campaign) }}"
                                class="mr-3 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">View</a>
                            <a href="{{ route('admin.campaigns.edit', $campaign) }}"
                                class="mr-3 text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-300">Edit</a>
                            <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this campaign? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                    Delete
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap dark:text-gray-300">
                            {{ $campaign->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        {{-- Adjusted colspan to 6 since we added a "Created" column --}}
                        <td colspan="6"
                            class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap dark:text-gray-300">
                            No campaigns found matching your criteria. Click "Create New Campaign" to add one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $campaigns->links() }}
    </div>
</x-admin-layout>
