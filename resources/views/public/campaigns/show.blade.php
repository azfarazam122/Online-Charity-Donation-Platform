<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ $campaign->title }}
            </h2>
            <a href="{{ route('public.campaigns.index') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-500 rounded-md border border-transparent transition hover:bg-gray-400 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:ring focus:ring-gray-200 disabled:opacity-25 dark:bg-gray-600 dark:hover:bg-gray-500">
                {{ __('Back to Campaigns') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                @if ($campaign->image_path)
                    <img src="{{ asset('storage/' . $campaign->image_path) }}" alt="{{ $campaign->title }}"
                        class="object-cover w-full h-96">
                @endif

                <div class="p-6 md:p-8">
                    <h1 class="mb-4 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $campaign->title }}</h1>

                    <div class="mb-6">
                        <div class="mb-2 w-full h-4 bg-gray-200 rounded-full dark:bg-gray-700">
                            @php
                                $progress =
                                    $campaign->goal_amount > 0
                                        ? ($campaign->current_amount / $campaign->goal_amount) * 100
                                        : 0;
                                $progress = min($progress, 100);
                            @endphp
                            <div class="p-0.5 h-4 text-xs font-medium leading-none text-center text-blue-100 bg-green-500 rounded-full"
                                style="width: {{ $progress }}%">
                                {{ number_format($progress, 0) }}%
                            </div>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                            <div>
                                <span
                                    class="font-semibold text-gray-700 dark:text-gray-200">${{ number_format($campaign->current_amount, 2) }}</span>
                                raised
                            </div>
                            <div>
                                Goal: <span
                                    class="font-semibold text-gray-700 dark:text-gray-200">${{ number_format($campaign->goal_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8 max-w-none text-gray-700 prose prose-lg dark:prose-invert dark:text-gray-300">
                        {!! nl2br(e($campaign->description)) !!} {{-- Use nl2br to respect line breaks, and e() for escaping --}}
                    </div>

                    @if ($campaign->status === 'active')
                        <div class="pt-6 mt-8 border-t dark:border-gray-700">
                            <h3 class="mb-4 text-xl font-semibold text-gray-800 dark:text-gray-100">Make a Donation</h3>
                            <form action="{{ route('donate.session', $campaign) }}" method="POST">
                                @csrf
                                <div class="flex flex-col gap-4 items-center sm:flex-row">
                                    <div class="flex-grow w-full sm:w-auto">
                                        <label for="amount" class="sr-only">{{ __('Amount (USD)') }}</label>
                                        <div class="relative">
                                            <div
                                                class="flex absolute inset-y-0 items-center text-gray-500 pointer-events-none start-0 ps-3 dark:text-gray-400">
                                                $
                                            </div>
                                            <input type="number" name="amount" id="amount"
                                                class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 ps-7 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Enter amount" required min="1.00" step="0.01"
                                                value="{{ old('amount', '10.00') }}">
                                        </div>
                                        @error('amount')
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit"
                                        class="px-8 py-3 w-full text-lg font-semibold tracking-widest text-white uppercase bg-green-600 rounded-md border border-transparent transition sm:w-auto hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25">
                                        Donate with Card
                                    </button>
                                </div>
                                <div class="mt-4">
                                    <label for="display_publicly"
                                        class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <input type="checkbox" id="display_publicly" name="display_publicly"
                                            value="1"
                                            class="text-indigo-600 rounded border-gray-300 shadow-sm focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                            {{ old('display_publicly', true) ? 'checked' : '' }}> {{-- Default to checked, or false if you prefer opt-in only --}}
                                        <span class="ms-2"><b>Display my name publicly with this donation.</b></span>
                                    </label>
                                    <p class="text-xs text-gray-500 dark:text-gray-500 ms-6">If unchecked, your donation
                                        will be listed as "Anonymous".</p>
                                </div>
                            </form>
                        </div>
                    @elseif($campaign->status === 'completed')
                        <div class="p-4 mt-8 text-center bg-blue-100 rounded-md dark:bg-blue-900">
                            <p class="font-semibold text-blue-700 dark:text-blue-300">This campaign has been
                                successfully completed! Thank you to all donors.</p>
                        </div>
                    @elseif($campaign->status === 'closed')
                        <div class="p-4 mt-8 text-center bg-red-100 rounded-md dark:bg-red-900">
                            <p class="font-semibold text-red-700 dark:text-red-300">This campaign is now closed.</p>
                        </div>
                    @endif

                    {{-- CAMPAIGN UPDATES SECTION --}}
                    <div class="pt-8 mt-10 border-t dark:border-gray-700">
                        <h2 class="mb-6 text-2xl font-semibold text-gray-800 dark:text-gray-100">Campaign Updates</h2>
                        @if ($campaign->updates->isNotEmpty())
                            <div class="space-y-6">
                                @foreach ($campaign->updates as $update)
                                    <article class="p-4 bg-gray-50 rounded-lg shadow dark:bg-gray-700">
                                        @if ($update->title)
                                            <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $update->title }}</h3>
                                        @endif
                                        <p class="mb-2 text-xs text-gray-500 dark:text-gray-400">
                                            Posted on: {{ $update->created_at->format('F j, Y, g:i a') }}
                                        </p>
                                        <div
                                            class="max-w-none text-gray-700 prose prose-sm dark:prose-invert dark:text-gray-300">
                                            {!! nl2br(e($update->content)) !!}
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600 dark:text-gray-400">No updates have been posted for this campaign
                                yet.</p>
                        @endif
                    </div>
                    {{-- END CAMPAIGN UPDATES SECTION --}}


                    {{-- DONOR LIST SECTION --}}
                    <div class="pt-8 mt-10 border-t dark:border-gray-700">
                        <h2 class="mb-6 text-2xl font-semibold text-gray-800 dark:text-gray-100">Recent Donors</h2>
                        @php
                            // Fetch only donations for this campaign that are marked for public display
                            // Limit to a certain number, e.g., 10 most recent public donors
                            $publicDonations = $campaign
                                ->donations()
                                ->where('status', 'succeeded')
                                ->where('display_publicly', true)
                                ->latest()
                                ->take(10) // Show latest 10 public donors
                                ->get();
                        @endphp

                        @if ($publicDonations->isNotEmpty())
                            <ul class="space-y-3">
                                @foreach ($publicDonations as $pDonation)
                                    <li class="p-3 bg-gray-50 rounded-md shadow-sm dark:bg-gray-700">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                                {{ $pDonation->user->name ?? ($pDonation->donor_name !== 'Anonymous Donor' ? $pDonation->donor_name : 'Anonymous Donor') }}
                                                {{-- If user relation exists and name is there, use it.
                                 Else, if donor_name is not 'Anonymous Donor', use donor_name.
                                 Else, fall back to 'Anonymous Donor'.
                             --}}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $pDonation->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        {{-- Optionally show amount if you decide to, but often names are enough for social proof --}}
                                        {{-- <p class="text-xs text-green-600 dark:text-green-400">${{ number_format($pDonation->amount, 2) }}</p> --}}
                                    </li>
                                @endforeach
                            </ul>
                            @if ($campaign->donations()->where('status', 'succeeded')->where('display_publicly', true)->count() > 10)
                                <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">...and more generous donors!
                                </p>
                            @endif
                        @else
                            <p class="text-gray-600 dark:text-gray-400">Be the first to publicly support this campaign!
                            </p>
                        @endif
                    </div>
                    {{-- END DONOR LIST SECTION --}}

                    <div class="flex flex-wrap justify-between mt-4">
                        <div class="mt-8 text-xs text-gray-500 dark:text-gray-400">
                            <p>Campaign created by: {{ $campaign->user->name }}</p>
                            <p>Posted on: {{ $campaign->created_at->format('F j, Y') }}</p>
                        </div>

                        <div class="flex flex-wrap gap-2 items-center my-4">
                            <span class="mr-2 text-sm font-medium text-gray-700 dark:text-gray-300">Share this
                                campaign:</span>
                            @php
                                $shareUrl = urlencode(route('public.campaigns.show', $campaign));
                                $shareTitle = urlencode($campaign->title . ' - Support Now!');
                                $shareDescription = urlencode(Str::limit($campaign->description, 150));
                                $shareImage = $campaign->image_path
                                    ? urlencode(asset('storage/' . $campaign->image_path))
                                    : '';
                            @endphp

                            {{-- Twitter --}}
                            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}"
                                target="_blank" rel="noopener noreferrer"
                                class="inline-flex justify-center items-center w-10 h-10 text-white bg-blue-400 rounded-full transition-colors duration-150 hover:bg-blue-500"
                                title="Share on Twitter">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                    </path>
                                </svg>
                            </a>

                            {{-- Facebook --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex justify-center items-center w-10 h-10 text-white bg-blue-600 rounded-full transition-colors duration-150 hover:bg-blue-700"
                                title="Share on Facebook">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>

                            {{-- LinkedIn --}}
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}&summary={{ $shareDescription }}"
                                target="_blank" rel="noopener noreferrer"
                                class="inline-flex justify-center items-center w-10 h-10 text-white bg-sky-700 rounded-full transition-colors duration-150 hover:bg-sky-800"
                                title="Share on LinkedIn">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>

                            {{-- Email --}}
                            <a href="mailto:?subject={{ $shareTitle }}&body=Check out this campaign: {{ $shareUrl }}"
                                class="inline-flex justify-center items-center w-10 h-10 text-white bg-gray-500 rounded-full transition-colors duration-150 hover:bg-gray-600"
                                title="Share via Email">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                    </path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
