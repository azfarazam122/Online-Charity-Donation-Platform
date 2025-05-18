<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Post New Update for Campaign: ') }} <span class="italic">{{ $campaign->title }}</span>
        </h2>
    </x-slot>

    <div class="mx-auto max-w-2xl">
        <form method="POST" action="{{ route('admin.campaigns.updates.store', $campaign) }}">
            @csrf

            <!-- Update Title (Optional) -->
            <div>
                <label for="title"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Update Title (Optional)') }}</label>
                <input id="title"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                    type="text" name="title" value="{{ old('title') }}" autofocus />
                @error('title')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Update Content -->
            <div class="mt-4">
                <label for="content"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Update Content') }}</label>
                <textarea id="content" name="content" rows="8"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                    required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end items-center mt-6">
                <a href="{{ route('admin.campaigns.show', $campaign) }}"
                    class="mr-4 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                    {{ __('Cancel') }}
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-green-600 rounded-md border border-transparent transition hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 dark:bg-green-500 dark:hover:bg-green-400">
                    {{ __('Post Update') }}
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
