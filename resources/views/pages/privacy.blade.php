<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Privacy Policy') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 max-w-none text-gray-900 md:p-8 dark:text-gray-100 prose dark:prose-invert">
                    {{-- Replace this with your actual Privacy Policy content --}}
                    <h1>Privacy Policy</h1>
                    <p>Last updated: {{ \Carbon\Carbon::now()->format('F j, Y') }}</p>

                    <p>We operate the {{ config('app.name', 'Our Application') }} website (the "Service"). This page
                        informs you of our policies regarding the collection, use, and disclosure of personal data when
                        you use our Service and the choices you have associated with that data.</p>

                    <h2>1. Information Collection and Use</h2>
                    <p>We collect several different types of information for various purposes to provide and improve our
                        Service to you.</p>
                    <h3>Types of Data Collected</h3>
                    <h4>Personal Data</h4>
                    <p>While using our Service, we may ask you to provide us with certain personally identifiable
                        information that can be used to contact or identify you ("Personal Data"). Personally
                        identifiable information may include, but is not limited to:</p>
                    <ul>
                        <li>Email address</li>
                        <li>First name and last name</li>
                        <li>Cookies and Usage Data</li>
                    </ul>
                    <h4>Usage Data</h4>
                    <p>We may also collect information on how the Service is accessed and used ("Usage Data")...</p>

                    {{-- Add more sections as needed: Use of Data, Transfer Of Data, Disclosure Of Data, Security Of Data, Service Providers, Links To Other Sites, Children's Privacy, Changes To This Privacy Policy, Contact Us --}}

                    <h2>Contact Us</h2>
                    <p>If you have any questions about this Privacy Policy, please contact us.</p>
                    {{-- End of placeholder content --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
