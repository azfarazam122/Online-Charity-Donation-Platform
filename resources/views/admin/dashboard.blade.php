<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    {{-- Stats Cards --}}
    {{-- ... (your existing stats cards code) ... --}}
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Campaigns Card -->
        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="flex items-center">
                <div class="p-3 bg-blue-500 bg-opacity-75 rounded-full">
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 uppercase dark:text-gray-400">Total Campaigns</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalCampaigns }}</p>
                </div>
            </div>
        </div>

        <!-- Total Donations Card -->
        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="flex items-center">
                <div class="p-3 bg-green-500 bg-opacity-75 rounded-full">
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 14l6-6m-5.5 6.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm10.036-6.464A9.96 9.96 0 0112 21a9.96 9.96 0 01-7.536-3.964m15.072 0a9.96 9.96 0 00-7.536-10.072A9.96 9.96 0 0012 3a9.96 9.96 0 00-7.536 3.964m15.072 0L12 15.964" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 uppercase dark:text-gray-400">Total Donations</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalDonationsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Total Amount Raised Card -->
        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-500 bg-opacity-75 rounded-full">
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 uppercase dark:text-gray-400">Total Raised</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                        ${{ number_format($totalAmountRaised, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Average Donation Amount Card -->
        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="flex items-center">
                <div class="p-3 bg-indigo-500 bg-opacity-75 rounded-full">
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 uppercase dark:text-gray-400">Avg. Donation</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                        ${{ number_format($averageDonationAmount, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Donations Over Time Chart --}}
    <div class="p-6 mb-8 bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-100">Donations Over Last 10 Days ($)</h3>
        <div style="height: 300px;"> {{-- Set a height for the canvas container --}}
            <canvas id="donationsOverTimeChart"></canvas>
        </div>
    </div>


    {{-- Quick Links & Recent Donations --}}
    {{-- ... (your existing quick links and recent donations table code) ... --}}
    <div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-3">
        <div class="p-6 bg-white shadow-sm lg:col-span-1 dark:bg-gray-800 sm:rounded-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-100">Quick Links</h3>
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('admin.campaigns.create') }}"
                        class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                        <svg class="mr-2 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                clip-rule="evenodd" />
                        </svg>
                        Create New Campaign
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.campaigns.index') }}"
                        class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                        <svg class="mr-2 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Manage Campaigns
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.donations.index') }}"
                        class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                        <svg class="mr-2 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        View All Donations
                    </a>
                </li>
            </ul>
        </div>

        <div class="p-6 bg-white shadow-sm lg:col-span-2 dark:bg-gray-800 sm:rounded-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Donations</h3>
            @if ($recentDonations->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No donations found yet.</p>
            @else
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Campaign</th>
                                <th
                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Donor</th>
                                <th
                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Amount</th>
                                <th
                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach ($recentDonations as $donation)
                                @if ($donation->campaign)
                                    <tr>
                                        <td
                                            class="px-4 py-2 text-sm text-gray-600 whitespace-nowrap dark:text-gray-300">
                                            <a href="{{ route('admin.campaigns.show', $donation->campaign) }}"
                                                class="text-blue-600 hover:underline dark:text-blue-400">
                                                {{ $donation->campaign->title ?? 'N/A' }}
                                            </a>
                                        </td>
                                        <td
                                            class="px-4 py-2 text-sm text-gray-600 whitespace-nowrap dark:text-gray-300">
                                            {{ $donation->user->name ?? ($donation->donor_name ?? 'Guest') }}</td>
                                        <td
                                            class="px-4 py-2 text-sm font-semibold text-gray-600 whitespace-nowrap dark:text-gray-300">
                                            ${{ number_format($donation->amount, 2) }}</td>
                                        <td
                                            class="px-4 py-2 text-sm text-gray-600 whitespace-nowrap dark:text-gray-300">
                                            {{ $donation->created_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctxDonationsOverTime = document.getElementById('donationsOverTimeChart');
                if (ctxDonationsOverTime) {
                    new Chart(ctxDonationsOverTime, {
                        type: 'line',
                        data: {
                            labels: @json($chartLabels),
                            {{-- Use new variable name --}}
                            datasets: [{
                                label: 'Donation Amount ($)',
                                data: @json($chartData),
                                {{-- Use new variable name --}}
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)', // A common teal color
                                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Optional fill color
                                pointBackgroundColor: 'rgb(75, 192, 192)',
                                pointBorderColor: '#fff',
                                pointHoverBackgroundColor: '#fff',
                                pointHoverBorderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value, index, values) {
                                            return '$' + parseFloat(value).toFixed(2); // Ensure formatting
                                        }
                                    }
                                },
                                x: {
                                    ticks: {
                                        maxRotation: 45, // Rotate labels if they overlap
                                        minRotation: 45
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.dataset.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.parsed.y !== null) {
                                                label += new Intl.NumberFormat('en-US', {
                                                    style: 'currency',
                                                    currency: 'USD'
                                                }).format(context.parsed.y);
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            });
        </script>
    @endpush
</x-admin-layout>
