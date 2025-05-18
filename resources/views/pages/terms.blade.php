<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Terms of Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 max-w-none text-gray-900 md:p-8 dark:text-gray-100 prose dark:prose-invert">
                    {{-- Replace this with your actual Terms of Service content --}}
                    <h1>Terms of Service</h1>
                    <p>Last updated: {{ \Carbon\Carbon::now()->format('F j, Y') }}</p>

                    <p>Please read these Terms of Service ("Terms", "Terms of Service") carefully before using the
                        {{ config('app.name', 'Our Application') }} website (the "Service") operated by us.</p>

                    <h2>1. Agreement to Terms</h2>
                    <p>By accessing or using our Service, you agree to be bound by these Terms. If you disagree with any
                        part of the terms, then you may not access the Service.</p>

                    <h2>2. Donations</h2>
                    <p>If you wish to donate to any campaign available on our Service ("Donation"), you may be asked to
                        supply certain information relevant to your Donation including, without limitation, your credit
                        card number, the expiration date of your credit card, your billing address, and your shipping
                        information (if applicable).</p>
                    <p>You represent and warrant that: (i) you have the legal right to use any credit card(s) or other
                        payment method(s) in connection with any Donation; and that (ii) the information you supply to
                        us is true, correct and complete.</p>
                    <p>We reserve the right to refuse or cancel your donation at any time for certain reasons including
                        but not limited to: campaign availability, errors in the description or price of the campaign,
                        error in your donation, or other reasons.</p>

                    <h2>3. Accounts</h2>
                    <p>When you create an account with us, you must provide us information that is accurate, complete,
                        and current at all times. Failure to do so constitutes a breach of the Terms, which may result
                        in immediate termination of your account on our Service.</p>
                    {{-- Add more sections as needed: Content, Intellectual Property, Links To Other Web Sites, Termination, Governing Law, Changes, Contact Us --}}

                    <h2>Contact Us</h2>
                    <p>If you have any questions about these Terms, please contact us.</p>
                    {{-- End of placeholder content --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
