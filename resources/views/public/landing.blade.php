<x-app-layout>
    {{-- Optional: You might want a different, simpler navigation for the pure landing page,
         or no <x-slot name="header"> at all if the hero section serves that purpose.
         For now, we assume the standard app layout is used. --}}

    {{-- 1. Hero Section --}}
    <section
        class="text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-700 dark:from-blue-800 dark:via-indigo-800 dark:to-purple-900">
        <div class="px-4 py-24 mx-auto max-w-7xl text-center sm:px-6 lg:px-8 md:py-32 lg:py-40">
            <h1 class="mb-6 text-4xl font-extrabold tracking-tight sm:text-5xl md:text-6xl lg:text-7xl">
                Amplify Your <span class="text-yellow-300">Impact</span>.
            </h1>
            <p class="mx-auto mb-10 max-w-3xl text-lg text-blue-100 sm:text-xl md:text-2xl dark:text-blue-200">
                Discover transparent and vital campaigns. Your secure donation empowers communities and creates lasting
                change. Join us in making a difference.
            </p>
            <div class="flex flex-col gap-4 justify-center sm:flex-row">
                <a href="{{ route('public.campaigns.index') }}"
                    class="inline-block px-10 py-4 text-lg font-semibold text-gray-900 bg-yellow-400 rounded-lg shadow-lg transition duration-150 ease-in-out transform hover:bg-yellow-300 hover:scale-105">
                    Explore Campaigns
                </a>
                <a href="#how-it-works" {{-- Link to an internal section --}}
                    class="inline-block px-10 py-4 text-lg font-semibold text-white rounded-lg shadow-lg backdrop-blur-sm transition duration-150 ease-in-out bg-white/20 hover:bg-white/30">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    {{-- 2. Problem Statement / Why We Exist Section --}}
    <section class="py-16 bg-white md:py-24 dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8"> {{-- Changed max-w to 7xl for a bit more width if needed for columns --}}
            <div class="items-center lg:grid lg:grid-cols-2 lg:gap-12 xl:gap-16"> {{-- Grid for two columns on large screens --}}
                {{-- Column 1: Text Content --}}
                <div class="mb-10 lg:mb-0">
                    <p class="mb-2 text-base font-semibold tracking-wide text-blue-600 uppercase dark:text-blue-400">The
                        Challenge</p>
                    <h2
                        class="mb-6 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl md:text-4xl dark:text-gray-100">
                        Bridging the Gap in Charitable Giving
                    </h2>
                    <p class="text-lg leading-relaxed text-gray-700 md:text-xl dark:text-gray-300">
                        {{-- YOUR TEXT: Briefly explain the problems traditional charity faces (transparency, efficiency) that your platform solves. --}}
                        Traditional giving can sometimes feel opaque, leaving donors wondering about their true impact.
                        We're here to change that by providing a direct, transparent, and secure way to support the
                        causes
                        you care about, ensuring your generosity reaches those who need it most, efficiently and
                        effectively.
                    </p>
                    <p class="mt-4 text-lg leading-relaxed text-gray-700 md:text-xl dark:text-gray-300">
                        {{-- OPTIONAL: Add another paragraph of text if needed for balance --}}
                        Our platform empowers you with clear insights and direct connections, fostering a new era of
                        trust and engagement in philanthropy.
                    </p>
                </div>

                {{-- Column 2: Image --}}
                <div class="flex justify-center items-center">

                    <img src="https://images.pexels.com/photos/6646918/pexels-photo-6646918.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                        {{-- Adjust path and filename --}} alt="People collaborating for a cause"
                        class="object-cover w-full h-auto rounded-lg shadow-xl max-h-[400px] md:max-h-[500px]">
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Our Mission & Values Section (Combined or separate from "About Us") --}}
    <section class="py-16 bg-gray-50 md:py-24 dark:bg-gray-800/50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">Our
                    Commitment</h2>
                <p
                    class="mt-2 text-3xl font-extrabold tracking-tight leading-8 text-gray-900 sm:text-4xl dark:text-gray-100">
                    Driven by Transparency, Impact, and Community
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-400 lg:mx-auto">
                    {{-- YOUR TEXT: Elaborate on your platform's core values. --}}
                    Our platform is built on the pillars of trust and effectiveness. We champion transparency in every
                    transaction, empower donors to see the real-world impact of their contributions, and foster a
                    supportive community dedicated to positive change.
                </p>
            </div>

            <div class="mt-12 lg:mt-16">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div
                        class="relative p-6 bg-white rounded-lg shadow-lg transition-all duration-300 dark:bg-gray-700 hover:shadow-xl">
                        <dt>
                            <div
                                class="flex absolute justify-center items-center w-12 h-12 text-white bg-indigo-500 rounded-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <p class="ml-16 text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Direct
                                Impact</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500 dark:text-gray-400">
                            {{-- YOUR TEXT --}}
                            Connect directly with campaigns and ensure your funds go where they're needed most,
                            minimizing overhead.
                        </dd>
                    </div>

                    <div
                        class="relative p-6 bg-white rounded-lg shadow-lg transition-all duration-300 dark:bg-gray-700 hover:shadow-xl">
                        <dt>
                            <div
                                class="flex absolute justify-center items-center w-12 h-12 text-white bg-indigo-500 rounded-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m0 6H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="ml-16 text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Verified
                                Campaigns</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500 dark:text-gray-400">
                            {{-- YOUR TEXT (Explain how campaigns are vetted, if applicable) --}}
                            Campaigns on our platform are initiated by our dedicated team, focusing on clear objectives
                            and needs.
                        </dd>
                    </div>

                    <div
                        class="relative p-6 bg-white rounded-lg shadow-lg transition-all duration-300 dark:bg-gray-700 hover:shadow-xl">
                        <dt>
                            <div
                                class="flex absolute justify-center items-center w-12 h-12 text-white bg-indigo-500 rounded-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="ml-16 text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Regular
                                Updates</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500 dark:text-gray-400">
                            {{-- YOUR TEXT --}}
                            Stay informed with progress reports and updates directly from the campaigns you support.
                        </dd>
                    </div>

                    <div
                        class="relative p-6 bg-white rounded-lg shadow-lg transition-all duration-300 dark:bg-gray-700 hover:shadow-xl">
                        <dt>
                            <div
                                class="flex absolute justify-center items-center w-12 h-12 text-white bg-indigo-500 rounded-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                    </path>
                                </svg>
                            </div>
                            <p class="ml-16 text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Secure
                                Payments</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500 dark:text-gray-400">
                            {{-- YOUR TEXT --}}
                            Your donations are processed securely through Stripe, a leading global payment processor.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>

    {{-- 4. Featured Campaigns Section --}}
    @if ($featuredCampaigns->isNotEmpty())
        <section class="py-16 bg-gray-100 md:py-24 dark:bg-gray-700">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <h2
                    class="mb-12 text-3xl font-bold tracking-tight text-center text-gray-900 md:text-4xl dark:text-gray-100">
                    Support a Cause
                </h2>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    {{-- Your existing @foreach ($featuredCampaigns as $campaign) loop and card structure --}}
                    @foreach ($featuredCampaigns as $campaign)
                        <div
                            class="flex overflow-hidden flex-col bg-white rounded-lg shadow-lg transition duration-300 transform dark:bg-gray-800 hover:scale-105">
                            @if ($campaign->image_path)
                                <a href="{{ route('public.campaigns.show', $campaign) }}">
                                    <img src="{{ asset('storage/' . $campaign->image_path) }}"
                                        alt="{{ $campaign->title }}" class="object-cover w-full h-56">
                                </a>
                            @else
                                <a href="{{ route('public.campaigns.show', $campaign) }}">
                                    <div
                                        class="flex justify-center items-center w-full h-56 bg-gray-200 dark:bg-gray-600">
                                        <span class="text-gray-500 dark:text-gray-400">{{ __('No Image') }}</span>
                                    </div>
                                </a>
                            @endif
                            <div class="flex flex-col flex-grow p-6">
                                <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-gray-100">
                                    <a href="{{ route('public.campaigns.show', $campaign) }}" class="hover:underline">
                                        {{ Str::limit($campaign->title, 50) }}
                                    </a>
                                </h3>
                                <p class="flex-grow mb-3 text-sm text-gray-600 dark:text-gray-400">
                                    {{ Str::limit($campaign->description, 120) }}
                                </p>
                                <div class="mb-3">
                                    @php
                                        $progress =
                                            $campaign->goal_amount > 0
                                                ? ($campaign->current_amount / $campaign->goal_amount) * 100
                                                : 0;
                                        $progress = min($progress, 100);
                                    @endphp
                                    <div class="w-full h-2.5 bg-gray-200 rounded-full dark:bg-gray-600">
                                        <div class="h-2.5 bg-blue-600 rounded-full" style="width: {{ $progress }}%">
                                        </div>
                                    </div>
                                    <div class="flex justify-between mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        <span>Raised: ${{ number_format($campaign->current_amount, 0) }}</span>
                                        <span>Goal: ${{ number_format($campaign->goal_amount, 0) }}</span>
                                    </div>
                                </div>
                                <div class="pt-3 mt-auto">
                                    <a href="{{ route('public.campaigns.show', $campaign) }}"
                                        class="block px-4 py-2 w-full text-xs font-semibold tracking-widest text-center text-white uppercase bg-indigo-600 rounded-md border border-transparent ring-indigo-300 transition duration-150 ease-in-out hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring disabled:opacity-25">
                                        View & Donate
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-16 text-center">
                    <a href="{{ route('public.campaigns.index') }}"
                        class="inline-block px-10 py-4 text-lg font-semibold text-white bg-green-500 rounded-lg shadow-md transition duration-150 ease-in-out hover:bg-green-600">
                        View All Campaigns
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- 5. How It Works Section (id for internal link) --}}
    <section id="how-it-works" class="py-16 bg-white md:py-24 dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-5xl sm:px-6 lg:px-8">
            <h2
                class="mb-12 text-3xl font-bold tracking-tight text-center text-gray-900 md:text-4xl dark:text-gray-100">
                How It Works</h2>
            <div class="grid gap-8 text-center md:grid-cols-3">
                {{-- Your existing "How It Works" items --}}
                <div class="p-4">
                    <div
                        class="flex justify-center items-center mx-auto mb-4 w-16 h-16 text-blue-600 bg-blue-100 rounded-full dark:text-blue-300 dark:bg-blue-900">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-gray-100">1. Discover Causes</h3>
                    <p class="text-gray-700 dark:text-gray-300">Explore a variety of campaigns supporting important
                        causes.</p>
                </div>
                <div class="p-4">
                    <div
                        class="flex justify-center items-center mx-auto mb-4 w-16 h-16 text-green-600 bg-green-100 rounded-full dark:text-green-300 dark:bg-green-900">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-gray-100">2. Donate Securely</h3>
                    <p class="text-gray-700 dark:text-gray-300">Make a secure donation through our trusted payment
                        gateway.</p>
                </div>
                <div class="p-4">
                    <div
                        class="flex justify-center items-center mx-auto mb-4 w-16 h-16 text-indigo-600 bg-indigo-100 rounded-full dark:text-indigo-300 dark:bg-indigo-900">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m0 6H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-gray-100">3. See Your Impact</h3>
                    <p class="text-gray-700 dark:text-gray-300">Follow campaign updates and see how your contribution
                        helps.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. Testimonials / Social Proof Section (Optional) --}}
    <section class="py-16 bg-gray-100 md:py-24 dark:bg-gray-700">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2
                class="mb-12 text-3xl font-bold tracking-tight text-center text-gray-900 md:text-4xl dark:text-gray-100">
                Voices of Our Community</h2>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{-- Example Testimonial Card - Repeat 2-3 times with different content --}}
                <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <p class="italic text-gray-600 dark:text-gray-300">"This platform made it so easy to support a
                        cause I believe in. Seeing the updates on how my donation helped was incredibly rewarding!"</p>
                    <p class="mt-4 font-semibold text-right text-gray-700 dark:text-gray-200">- Jane D., Donor</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <p class="italic text-gray-600 dark:text-gray-300">"The transparency and directness of this
                        donation process are fantastic. I feel confident my contribution is making a real difference."
                    </p>
                    <p class="mt-4 font-semibold text-right text-gray-700 dark:text-gray-200">- John S., Supporter</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <p class="italic text-gray-600 dark:text-gray-300">"A wonderful way to connect with meaningful
                        projects and contribute to positive change globally. Highly recommend!"</p>
                    <p class="mt-4 font-semibold text-right text-gray-700 dark:text-gray-200">- Alex P., Philanthropist
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- 7. FAQ Section (Optional) --}}
    <section class="py-16 bg-white md:py-24 dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h2
                class="mb-12 text-3xl font-bold tracking-tight text-center text-gray-900 md:text-4xl dark:text-gray-100">
                Frequently Asked Questions</h2>
            <div class="space-y-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Is my donation secure?</h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-300">Yes, all donations are processed through Stripe, a
                        PCI Level 1 compliant payment processor, ensuring your financial information is handled with the
                        highest security standards.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">How much of my donation goes to
                        the campaign?</h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-300">{{-- YOUR TEXT: Be transparent about any platform fees or processing fees --}} Our platform aims to
                        maximize the impact of your donation. A small percentage (e.g., X%) covers payment processing
                        fees, and the rest goes directly to the campaign. We are committed to transparency regarding any
                        operational costs.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Can I get a receipt for my
                        donation?</h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-300">Yes, upon successful donation, you will receive an
                        email confirmation which can serve as a receipt. For registered users, donation history is also
                        available in your dashboard. (Note: Adjust this based on actual receipt functionality)</p>
                </div>
                {{-- Add more FAQs as needed --}}
            </div>
        </div>
    </section>

    {{-- 8. Final Call to Action (Slightly different from the one in featured campaigns) --}}
    <section class="py-20 text-white bg-indigo-700 md:py-28 dark:bg-indigo-900">
        <div class="px-4 mx-auto max-w-7xl text-center sm:px-6 lg:px-8">
            <h2 class="mb-6 text-3xl font-extrabold tracking-tight md:text-4xl">
                Join Us in Creating a Better Tomorrow
            </h2>
            <p class="mx-auto mb-10 max-w-2xl text-lg text-indigo-100 md:text-xl dark:text-indigo-200">
                Every act of kindness, no matter how small, contributes to a larger wave of positive change.
            </p>
            <a href="{{ route('public.campaigns.index') }}"
                class="inline-block px-10 py-4 text-lg font-semibold text-indigo-700 bg-white rounded-lg shadow-lg transition duration-150 ease-in-out transform hover:bg-gray-100 hover:scale-105 dark:text-indigo-900">
                Support a Campaign Now
            </a>
        </div>
    </section>

</x-app-layout>
