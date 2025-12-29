<!DOCTYPE html>
<html class="dark" lang="en"><head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Orders - Key Lanka Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#121212",
                    },
                    fontFamily: {
                        "display": ["Space Grotesk", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: 24px;
        }

        .glass-card {
            background-color: rgba(30, 30, 30, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(45, 45, 45, 0.5);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-white">
<div class="relative flex min-h-screen w-full flex-col">
    <div class="flex h-full grow flex-row">
        <x-AdminNavbar/>
        <main class="flex-1 p-8 h-screen overflow-y-auto">
            <div class="flex flex-col max-w-7xl mx-auto">
                <div class="flex flex-wrap gap-2 mb-4">
                    <a class="text-[#92a4c9] text-sm font-medium leading-normal hover:text-white" href="{{ route('dashboard') }}">Dashboard</a>
                    <span class="text-[#92a4c9] text-sm font-medium leading-normal">/</span>
                    <span class="text-white text-sm font-medium leading-normal">Orders</span>
                </div>
                <div class="flex flex-wrap justify-between gap-3 mb-8">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em]">Manage Orders</h1>
                </div>
                <div class="w-full glass-card rounded-xl border border-[#324467]/30 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b border-[#324467]/30">
                            <tr>
                                <th class="px-6 py-4 text-sm font-semibold text-[#92a4c9]">Order ID</th>
                                <th class="px-6 py-4 text-sm font-semibold text-[#92a4c9]">Customer</th>
                                <th class="px-6 py-4 text-sm font-semibold text-[#92a4c9]">Date</th>
                                <th class="px-6 py-4 text-sm font-semibold text-[#92a4c9]">Total</th>
                                <th class="px-6 py-4 text-sm font-semibold text-[#92a4c9]">Status</th>
                                <th class="px-6 py-4 text-sm font-semibold text-[#92a4c9]">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($ordersRaw ?? [] as $orderIndex => $order)
                                @php
                                    // Normalize customer data
                                    $firstName = $order->first_name ?? $order->First_Name ?? '';
                                    $lastName = $order->last_name ?? $order->Last_Name ?? '';
                                    $fullName = trim($firstName . ' ' . $lastName);
                                    $email = $order->email ?? $order->Email ?? '';
                                    $phone = $order->phone ?? $order->Phone ?? '';
                                    $address = $order->address ?? $order->Address ?? '';
                                    $city = $order->city ?? $order->City ?? '';
                                    $state = $order->state ?? $order->State ?? '';
                                    $zipCode = $order->zip_code ?? $order->Zip_Code ?? '';

                                    $orderId = $order->order_id ?? 'N/A';
                                    $amount = $order->amount ?? $order->paid_amount ?? 0;
                                    $currency = $order->currency ?? 'LKR';
                                    $progressStatus = $order->progress_status ?? 'pending';
                                    $createdAt = $order->created_at ?? now();
                                    $paymentId = $order->payment_id ?? 'N/A';
                                    $cardNo = $order->card_no ?? 'N/A';

                                    // Decode items
                                    $items = is_string($order->items ?? null) ? json_decode($order->items, true) : ($order->items ?? []);

                                    // Status configuration
                                    $statusConfig = [
                                        'pending' => ['color' => 'yellow', 'label' => 'Pending'],
                                        'prepping' => ['color' => 'yellow', 'label' => 'Prepping'],
                                        'accepted' => ['color' => 'blue', 'label' => 'Accepted'],
                                        'out_for_delivery' => ['color' => 'cyan', 'label' => 'Out for Delivery'],
                                        'completed' => ['color' => 'green', 'label' => 'Completed'],
                                        'cancelled' => ['color' => 'red', 'label' => 'Cancelled'],
                                    ];
                                    $status = $statusConfig[$progressStatus] ?? ['color' => 'gray', 'label' => ucfirst($progressStatus)];
                                @endphp

                                    <!-- Main Order Row -->
                                <tr class="border-b border-[#324467]/30 hover:bg-primary/10" id="order-row-{{ $orderId }}">
                                    <td class="px-6 py-4 font-mono text-sm text-primary">{{ $orderId }}</td>
                                    <td class="px-6 py-4 text-sm text-white">
                                        {{ $fullName ?: 'Guest' }}
                                        @if($email)
                                            <div class="text-xs text-[#92a4c9]">{{ $email }}</div>
                                        @endif
                                        @if($phone)
                                            <div class="text-xs text-[#92a4c9]">{{ $phone }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-[#92a4c9]">{{ \Carbon\Carbon::parse($createdAt)->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 text-sm text-white font-medium">{{ $currency }} {{ number_format($amount, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                              style="background-color: rgb({{ $status['color'] === 'yellow' ? '234 179 8' : ($status['color'] === 'blue' ? '59 130 246' : ($status['color'] === 'cyan' ? '34 211 238' : ($status['color'] === 'green' ? '34 197 94' : ($status['color'] === 'red' ? '239 68 68' : '156 163 175')))) }} / 0.2); color: rgb({{ $status['color'] === 'yellow' ? '250 204 21' : ($status['color'] === 'blue' ? '96 165 250' : ($status['color'] === 'cyan' ? '103 232 249' : ($status['color'] === 'green' ? '74 222 128' : ($status['color'] === 'red' ? '248 113 113' : '209 213 219')))) }})">
                                            <span class="w-2 h-2 mr-2 rounded-full"
                                                  style="background-color: rgb({{ $status['color'] === 'yellow' ? '250 204 21' : ($status['color'] === 'blue' ? '96 165 250' : ($status['color'] === 'cyan' ? '103 232 249' : ($status['color'] === 'green' ? '74 222 128' : ($status['color'] === 'red' ? '248 113 113' : '209 213 219')))) }})"></span>
                                            {{ $status['label'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button onclick="toggleDetails('{{ $orderId }}')" class="details-toggle text-primary hover:text-white transition-colors text-sm font-medium">View Details</button>
                                    </td>
                                </tr>

                                <!-- Details Row -->
                                <tr class="details-row hidden bg-primary/10" id="details-{{ $orderId }}">
                                    <td class="py-4 px-6" colspan="6">
                                        <div class="glass-card rounded-lg p-4 border border-[#324467]/50">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                                <div>
                                                    <h3 class="text-lg font-bold mb-3 text-white">Customer Information</h3>
                                                    <div class="space-y-2 text-sm">
                                                        <p class="text-[#92a4c9]">Name: <span class="text-white">{{ $fullName ?: 'Guest' }}</span></p>
                                                        <p class="text-[#92a4c9]">Email: <span class="text-white">{{ $email }}</span></p>
                                                        <p class="text-[#92a4c9]">Phone: <span class="text-white">{{ $phone }}</span></p>
                                                        <p class="text-[#92a4c9]">Address: <span class="text-white">{{ $address }}, {{ $city }}, {{ $state }} {{ $zipCode }}</span></p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h3 class="text-lg font-bold mb-3 text-white">Payment Information</h3>
                                                    <div class="space-y-2 text-sm">
                                                        <p class="text-[#92a4c9]">Payment ID: <span class="text-white">{{ $paymentId }}</span></p>
                                                        <p class="text-[#92a4c9]">Card: <span class="text-white">{{ $cardNo }}</span></p>
                                                        <p class="text-[#92a4c9]">Amount Paid: <span class="text-white">{{ $currency }} {{ number_format($amount, 2) }}</span></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <h3 class="text-lg font-bold mb-4 text-white">Order Items</h3>
                                            <div class="space-y-4 mb-6">
                                                @if(is_array($items) && count($items) > 0)
                                                    @foreach($items as $item)
                                                        <div class="flex justify-between items-center">
                                                            <div class="flex items-center gap-4">
                                                                @if(isset($item['image']))
                                                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] ?? 'Product' }}" class="w-12 h-12 object-cover rounded">
                                                                @endif
                                                                <div>
                                                                    <p class="font-medium text-white">{{ $item['title'] ?? 'Product' }}</p>
                                                                    <p class="text-sm text-[#92a4c9]">Qty: {{ $item['quantity'] ?? 1 }}</p>
                                                                </div>
                                                            </div>
                                                            <p class="text-white">{{ $currency }} {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}</p>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-[#92a4c9] text-sm">No items found</p>
                                                @endif
                                            </div>

                                            {{-- Status Timeline (unchanged) --}}
                                            @php
                                                $timeline = isset($order->progress_timeline)
                                                    ? (is_string($order->progress_timeline) ? json_decode($order->progress_timeline, true) : $order->progress_timeline)
                                                    : [];
                                            @endphp

                                            @if(is_array($timeline) && count($timeline) > 0)
                                                <div class="mt-6 border-t border-[#324467]/50 pt-4">
                                                    <h3 class="text-lg font-bold mb-4 text-white">Status History</h3>
                                                    <div class="relative">
                                                        <div class="absolute left-[6px] top-2 bottom-2 w-0.5 bg-[#324467]"></div>
                                                        <div class="space-y-4">
                                                            @foreach($timeline as $tlIndex => $entry)
                                                                @php
                                                                    $entryStatus = $entry['status'] ?? 'unknown';
                                                                    $statusColors = [
                                                                        'pending' => ['bg' => '#eab308', 'text' => '#fbbf24', 'ring' => 'rgba(234, 179, 8, 0.2)'],
                                                                        'prepping' => ['bg' => '#eab308', 'text' => '#fbbf24', 'ring' => 'rgba(234, 179, 8, 0.2)'],
                                                                        'accepted' => ['bg' => '#3b82f6', 'text' => '#60a5fa', 'ring' => 'rgba(59, 130, 246, 0.2)'],
                                                                        'out_for_delivery' => ['bg' => '#22d3ee', 'text' => '#67e8f9', 'ring' => 'rgba(34, 211, 238, 0.2)'],
                                                                        'completed' => ['bg' => '#22c55e', 'text' => '#4ade80', 'ring' => 'rgba(34, 197, 94, 0.2)'],
                                                                        'cancelled' => ['bg' => '#ef4444', 'text' => '#f87171', 'ring' => 'rgba(239, 68, 68, 0.2)'],
                                                                    ];
                                                                    $colors = $statusColors[$entryStatus] ?? ['bg' => '#9ca3af', 'text' => '#d1d5db', 'ring' => 'rgba(156, 163, 175, 0.2)'];
                                                                @endphp
                                                                <div class="flex items-start gap-4 relative">
                                                                    <div class="relative z-10 flex-shrink-0">
                                                                        <div class="w-3 h-3 rounded-full" style="background-color: {{ $colors['bg'] }}; box-shadow: 0 0 0 4px {{ $colors['ring'] }}"></div>
                                                                    </div>
                                                                    <div class="flex-1 pb-4">
                                                                        <div class="flex items-start justify-between gap-4">
                                                                            <div>
                                                                                <div class="flex items-center gap-2 mb-1">
                                                        <span class="font-semibold capitalize text-sm" style="color: {{ $colors['text'] }}">
                                                            {{ str_replace('_', ' ', $entryStatus) }}
                                                        </span>
                                                                                    @if($tlIndex === count($timeline) - 1)
                                                                                        <span class="px-2 py-0.5 text-xs rounded-full" style="background-color: rgba(19, 91, 236, 0.2); color: #135bec">Current</span>
                                                                                    @endif
                                                                                </div>
                                                                                <p class="text-xs text-[#92a4c9]">
                                                                                    {{ \Carbon\Carbon::parse($entry['date'] ?? $entry['timestamp'])->format('M d, Y · h:i A') }}
                                                                                </p>
                                                                                @if(isset($entry['updated_by']))
                                                                                    <p class="text-xs text-[#92a4c9] mt-1">
                                                                                        <span class="text-white/60">by</span> {{ $entry['updated_by'] }}
                                                                                    </p>
                                                                                @endif
                                                                                @if(isset($entry['note']))
                                                                                    <p class="text-xs text-white/80 mt-1 italic">{{ $entry['note'] }}</p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Update Status Section (unchanged) -->
                                            <div class="mt-6 border-t border-[#324467]/50 pt-4 flex flex-col sm:flex-row gap-4 items-center justify-between">
                                                <div class="flex items-center gap-2">
                                                    <p class="text-sm font-medium text-white">Update Status:</p>
                                                    <select id="status-select-{{ $orderId }}" class="form-select w-full sm:w-auto appearance-none rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary border border-[#324467] bg-[#192233] h-10 px-3 text-sm font-normal leading-normal transition-all">
                                                        <option value="pending" {{ $progressStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="prepping" {{ $progressStatus == 'prepping' ? 'selected' : '' }}>Prepping</option>
                                                        <option value="accepted" {{ $progressStatus == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                                        <option value="out_for_delivery" {{ $progressStatus == 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                                        <option value="completed" {{ $progressStatus == 'completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="cancelled" {{ $progressStatus == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                    </select>
                                                </div>
                                                <button onclick="updateOrderStatus('{{ $orderId }}')" class="w-full sm:w-auto px-4 py-2 rounded-lg text-white text-sm font-medium bg-primary hover:bg-primary/90 transition-colors">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-[#92a4c9]">No orders found</td>
                                </tr>
                            @endforelse
                            </tbody>

                        </table>
                    </div>
                    <div class="flex items-center justify-between p-4 border-t border-[#324467]/30">
                        <span class="text-sm text-[#92a4c9]">
                            @if(isset($ordersRaw) && method_exists($ordersRaw, 'total'))
                                Showing {{ $ordersRaw->firstItem() ?? 0 }} to {{ $ordersRaw->lastItem() ?? 0 }} of {{ $ordersRaw->total() }} orders
                            @else
                                Showing orders
                            @endif
                        </span>
                        <div class="flex items-center gap-2">
                            @if(isset($ordersRaw) && method_exists($ordersRaw, 'links'))
                                {{ $ordersRaw->links('pagination::tailwind') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function toggleDetails(orderId) {
        const detailsRow = document.getElementById('details-' + orderId);
        const button = event.target;

        if (detailsRow.classList.contains('hidden')) {
            detailsRow.classList.remove('hidden');
            button.textContent = 'Hide Details';
        } else {
            detailsRow.classList.add('hidden');
            button.textContent = 'View Details';
        }
    }

    function updateOrderStatus(orderId) {
        const status = document.getElementById('status-select-' + orderId).value;

        fetch('/orders/' + orderId + '/status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ progress_status: status })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Order status updated successfully!');
                    location.reload();
                } else {
                    alert('Error updating order status: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating order status');
            });
    }
</script>
</body></html>
