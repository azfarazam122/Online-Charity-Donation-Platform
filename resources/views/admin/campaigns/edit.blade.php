<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Campaign: ') . $campaign->title }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <form method="POST" action="{{ route('admin.campaigns.update', $campaign) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- or @method('PATCH') --}}

            <!-- Title -->
            <div>
                <label for="title"
                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Title') }}</label>
                <input id="title"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                    type="text" name="title" value="{{ old('title', $campaign->title) }}" required autofocus />
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
                    required>{{ old('description', $campaign->description) }}</textarea>
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
                    type="number" name="goal_amount" value="{{ old('goal_amount', $campaign->goal_amount) }}" required
                    step="0.01" min="0" />
                @error('goal_amount')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campaign Image -->
            <div class="mt-4">
                <label
                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Campaign Image') }}</label>
                <!-- Current Image Preview -->
                @if ($campaign->image_path)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Current Image:</p>
                        <img src="{{ asset('storage/' . $campaign->image_path) }}" alt="Current Image"
                            class="max-h-40 rounded-md border border-gray-300 dark:border-gray-600">
                    </div>
                @endif

                <!-- New Image Upload and Preview (using your existing JS) -->
                <label for="image"
                    class="block font-medium text-sm text-gray-700 dark:text-gray-300 mt-3">{{ __('Upload New Image (Optional - replaces current)') }}</label>
                <div
                    class="mt-2 w-full h-40 rounded-md border border-gray-300 dark:border-gray-600 flex items-center justify-center bg-gray-100 dark:bg-gray-800 overflow-hidden">
                    <img id="image-preview" src="#" alt="New Image Preview"
                        class="max-h-full max-w-full object-contain hidden" />
                    <span id="no-image-text" class="text-gray-500 dark:text-gray-400 text-sm">No new image
                        selected</span>
                </div>
                <input id="image" class="hidden" type="file" name="image" accept="image/*"
                    onchange="previewImage(event)">
                <label for="image"
                    class="mt-2 inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none cursor-pointer">
                    {{ __('Choose New Image') }}
                </label>
                @error('image')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mt-4">
                <label for="status"
                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Status') }}</label>
                <select id="status" name="status"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                    required>
                    <option value="active" {{ old('status', $campaign->status) == 'active' ? 'selected' : '' }}>Active
                    </option>
                    <option value="completed" {{ old('status', $campaign->status) == 'completed' ? 'selected' : '' }}>
                        Completed</option>
                    <option value="closed" {{ old('status', $campaign->status) == 'closed' ? 'selected' : '' }}>Closed
                    </option>
                </select>
                @error('status')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.campaigns.show', $campaign) }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-200/80 active:bg-gray-200/80 focus:outline-none focus:bg-gray-800 focus:ring focus:ring-gray-200 disabled:opacity-25 transition dark:bg-gray-500 dark:hover:bg-gray-200/80 mr-3">
                    {{ __('Cancel') }}
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition dark:bg-blue-500 dark:hover:bg-blue-400">
                    {{ __('Update Campaign') }}
                </button>
            </div>
        </form>
    </div>

    {{-- Include the same image preview script as in create.blade.php --}}
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
