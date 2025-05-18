<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Campaign') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <form method="POST" action="{{ route('admin.campaigns.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div>
                <label for="title"
                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Title') }}</label>
                <input id="title"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                    type="text" name="title" value="{{ old('title') }}" required autofocus />
                @error('title')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mt-4">
                <label for="description"
                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                <textarea id="description" name="description" rows="5"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Goal Amount -->
            <div class="mt-4">
                <label for="goal_amount"
                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Goal Amount ($)') }}</label>
                <input id="goal_amount"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                    type="number" name="goal_amount" value="{{ old('goal_amount') }}" required step="0.01"
                    min="0" />
                @error('goal_amount')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campaign Image -->
            <div class="mt-4">
                <label for="image"
                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Campaign Image (Optional)') }}</label>

                <!-- Image Preview -->
                <div
                    class="mt-2 w-full h-40 rounded-md border border-gray-300 dark:border-gray-600 flex items-center justify-center bg-gray-100 dark:bg-gray-800 overflow-hidden">
                    <img id="image-preview" src="#" alt="Image Preview"
                        class="max-h-full max-w-full object-contain hidden" />
                    <span id="no-image-text" class="text-gray-500 dark:text-gray-400 text-sm">No image selected</span>
                </div>

                <!-- File Input -->
                <input id="image" class="hidden" type="file" name="image" accept="image/*"
                    onchange="previewImage(event)">

                <!-- Custom Styled Button -->
                <label for="image"
                    class="mt-2 inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none cursor-pointer">
                    {{ __('Choose Image') }}
                </label>

                @error('image')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <!-- Status (Default to active, could be a select if more options initially needed) -->
            <input type="hidden" name="status" value="active">

            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.campaigns.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-200/80 active:bg-gray-200/80 focus:outline-none focus:bg-gray-800 focus:ring focus:ring-gray-200 disabled:opacity-25 transition dark:bg-gray-500 dark:hover:bg-gray-200/80 mr-3">
                    {{ __('Cancel') }}
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition dark:bg-blue-500 dark:hover:bg-blue-400">
                    {{ __('Create Campaign') }}
                </button>
            </div>
        </form>
    </div>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            const noImageText = document.getElementById('no-image-text');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    noImageText.classList.add('hidden');
                }

                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
                noImageText.classList.remove('hidden');
            }
        }
    </script>
</x-admin-layout>
