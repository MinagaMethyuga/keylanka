<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Key Lanka Order Tracking Page</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f42525",
                        "background-light": "#f8f5f5",
                        "background-dark": "#221010",
                    },
                    fontFamily: { "display": ["Manrope", "sans-serif"] },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-[#1c0d0d] dark:text-gray-200">

@php
    // Decode items safely
    $items = $order->items ?? [];
    if (is_string($items)) $items = json_decode($items, true);
    if (!is_array($items)) $items = [];

    // Decode timeline safely
    $timeline = $order->progress_timeline ?? [];
    if (is_string($timeline)) $timeline = json_decode($timeline, true);
    if (!is_array($timeline)) $timeline = [];

    // Status definitions
    $statusOptions = [
        'pending' => 'Pending',
        'prepping' => 'Prepping',
        'accepted' => 'Accepted',
        'out_for_delivery' => 'Out for Delivery',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];

    $currentStatus = $order->progress_status ?? 'pending';

    // Map icon and label for current status
    $statusIcons = [
        'pending' => 'pending',
        'prepping' => 'schedule',
        'accepted' => 'assignment_turned_in',
        'out_for_delivery' => 'local_shipping',
        'completed' => 'check_circle',
        'cancelled' => 'cancel',
    ];
    $statusIcon = $statusIcons[$currentStatus] ?? 'pending';
    $statusLabel = $statusOptions[$currentStatus] ?? 'Pending';

    // Progress mapping
    $progressMapping = [
        'pending' => 20,
        'prepping' => 40,
        'accepted' => 60,
        'out_for_delivery' => 80,
        'completed' => 100,
        'cancelled' => 0,
    ];
    $progress = $progressMapping[$currentStatus] ?? 20;

    // Shipping info
    $fullName = ($order->First_Name ?? '') . ' ' . ($order->Last_Name ?? '');
    $address = $order->Address ?? '';
    $city = $order->City ?? '';
    $state = $order->State ?? '';
    $zipCode = $order->Zip_Code ?? '';
    $phone = $order->Phone ?? '';
    $email = $order->Email ?? '';
@endphp

<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-col">
        <main class="px-4 sm:px-10 md:px-20 lg:px-40 flex flex-1 justify-center py-10">
            <div class="layout-content-container flex flex-col max-w-4xl flex-1 gap-8">
                <!-- Status Display -->
                <div class="flex flex-col items-center gap-6 p-6 rounded-xl bg-white dark:bg-[#2a1616] shadow-md">
                    <span class="material-symbols-outlined text-6xl text-primary">{{ $statusIcon }}</span>
                    <div class="flex flex-col gap-3 text-center">
                        <p class="text-[#1c0d0d] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Track Your Order</p>
                        <p class="text-[#9c4949] dark:text-gray-400 text-base font-normal leading-normal">Order #{{ $order->order_id }}</p>
                    </div>
                    <div class="w-full">
                        <div class="flex flex-col gap-3">
                            <div class="flex justify-between items-center">
                                <p class="text-[#1c0d0d] dark:text-gray-100 text-base font-medium leading-normal">{{ $statusLabel }}</p>
                            </div>
                            <div class="rounded-full bg-[#e8cece] dark:bg-[#3f2525] h-2">
                                <div class="h-2 rounded-full bg-primary" style="width: {{ $progress }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order & Customer Info -->
                <div class="grid md:grid-cols-2 gap-8">

                    <!-- Order & Items -->
                    <div class="flex flex-col gap-6 p-6 rounded-xl bg-white dark:bg-[#2a1616] shadow-md">
                        <h3 class="text-xl font-bold text-[#1c0d0d] dark:text-white">Order Details</h3>

                        @forelse($items as $item)
                            <div class="flex items-center gap-4">
                                <div class="w-24 h-24 bg-center bg-no-repeat bg-contain rounded-lg flex-shrink-0"
                                     style='background-image: url("{{ $item['image'] ?? 'https://via.placeholder.com/100' }}");'>
                                </div>
                                <div class="flex flex-col">
                                    <p class="font-semibold text-[#1c0d0d] dark:text-gray-200">{{ $item['title'] ?? 'Product' }}</p>
                                    <p class="text-sm text-[#9c4949] dark:text-gray-400">Qty: {{ $item['quantity'] ?? 1 }}</p>
                                    <p class="font-bold text-[#1c0d0d] dark:text-white mt-1">{{ $order->currency }} {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">No items found</p>
                        @endforelse

                        <div class="border-t border-[#f4e7e7] dark:border-[#3f2525] pt-4 flex flex-col gap-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-[#9c4949] dark:text-gray-400">Subtotal</span>
                                <span class="font-medium text-[#1c0d0d] dark:text-gray-200">{{ $order->currency }} {{ number_format($order->amount ?? 0, 2) }}</span>
                            </div>
                            <div class="flex justify-between font-bold">
                                <span class="text-[#1c0d0d] dark:text-white">Total</span>
                                <span class="text-[#1c0d0d] dark:text-white">{{ $order->currency }} {{ number_format($order->paid_amount ?? $order->amount ?? 0, 2) }}</span>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="border-t border-[#f4e7e7] dark:border-[#3f2525] pt-4">
                            <h4 class="font-bold text-[#1c0d0d] dark:text-white mb-2">Shipping Address</h4>
                            <p class="text-sm text-[#9c4949] dark:text-gray-400">
                                {{ $fullName }}<br>
                                {{ $address }}<br>
                                {{ $city }}, {{ $state }} {{ $zipCode }}<br>
                                Phone: {{ $phone }}<br>
                                Email: {{ $email }}
                            </p>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="flex flex-col gap-6 p-6 rounded-xl bg-white dark:bg-[#2a1616] shadow-md">
                        <h3 class="text-xl font-bold text-[#1c0d0d] dark:text-white">Tracking History</h3>
                        <div class="space-y-4">
                            @forelse($timeline as $entry)
                                @php
                                    $entryStatus = $entry['status'] ?? 'unknown';
                                    $statusColors = [
                                        'pending' => ['bg' => '#eab308', 'text' => '#fbbf24'],
                                        'prepping' => ['bg' => '#eab308', 'text' => '#fbbf24'],
                                        'accepted' => ['bg' => '#3b82f6', 'text' => '#60a5fa'],
                                        'out_for_delivery' => ['bg' => '#22d3ee', 'text' => '#67e8f9'],
                                        'completed' => ['bg' => '#22c55e', 'text' => '#4ade80'],
                                        'cancelled' => ['bg' => '#ef4444', 'text' => '#f87171'],
                                        'unknown' => ['bg' => '#9ca3af', 'text' => '#d1d5db'],
                                    ];
                                    $colors = $statusColors[$entryStatus] ?? $statusColors['unknown'];
                                @endphp
                                <div class="flex items-start gap-4">
                                    <div class="w-3 h-3 rounded-full mt-1" style="background-color: {{ $colors['bg'] }}"></div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold" style="color: {{ $colors['text'] }}">{{ ucfirst(str_replace('_',' ',$entryStatus)) }}</p>
                                        <p class="text-xs text-[#9c4949] dark:text-gray-400">{{ \Carbon\Carbon::parse($entry['date'] ?? now())->format('M d, Y · h:i A') }}</p>
                                        @if(!empty($entry['note']))
                                            <p class="text-xs text-white/80 italic mt-1">{{ $entry['note'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No tracking history available</p>
                            @endforelse
                        </div>

                        @if($order->payment_id)
                            <div class="border-t border-[#f4e7e7] dark:border-[#3f2525] pt-4">
                                <p class="text-sm text-[#9c4949] dark:text-gray-400">
                                    <strong>Payment ID:</strong> {{ $order->payment_id }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-center mt-4">
                    <a href="mailto:support@keylanka.com?subject=Order Support - {{ $order->order_id }}"
                       class="flex max-w-sm cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-primary text-white gap-2 text-base font-bold leading-normal tracking-[0.015em] min-w-0 px-8 w-full sm:w-auto hover:bg-red-700 dark:hover:bg-red-600 transition-colors">
                        <span>Contact Support</span>
                    </a>
                </div>

            </div>
        </main>

        <footer class="bg-[#f4e7e7] dark:bg-[#2a1616] px-4 sm:px-10 md:px-20 lg:px-40 py-10 mt-10">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 text-[#1c0d0d] dark:text-gray-300">
                <div>
                    <h3 class="font-bold text-lg mb-4 text-[#1c0d0d] dark:text-white">Key Lanka</h3>
                    <p class="text-sm">Your one-stop shop for secure and stylish keys and accessories.</p>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4 text-[#1c0d0d] dark:text-white">Shop</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a class="hover:text-primary" href="#">All Products</a></li>
                        <li><a class="hover:text-primary" href="#">Digital Keys</a></li>
                        <li><a class="hover:text-primary" href="#">Accessories</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4 text-[#1c0d0d] dark:text-white">Support</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a class="hover:text-primary" href="#">Help Center</a></li>
                        <li><a class="hover:text-primary" href="#">Track Order</a></li>
                        <li><a class="hover:text-primary" href="#">Returns</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4 text-[#1c0d0d] dark:text-white">Company</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a class="hover:text-primary" href="#">About Us</a></li>
                        <li><a class="hover:text-primary" href="#">Contact</a></li>
                        <li><a class="hover:text-primary" href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-[#e8cece] dark:border-[#3f2525] mt-8 pt-6 text-center text-sm text-[#9c4949] dark:text-gray-500">
                <p>© 2024 Key Lanka. All rights reserved.</p>
            </div>
        </footer>
    </div>
</div>

<script>
    async function updateStatus(orderId) {
        const status = document.getElementById('status-select').value;
        try {
            const res = await fetch(`/orders/${orderId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status })
            });
            const data = await res.json();
            if(data.success){
                alert('Status updated!');
                location.reload();
            } else {
                alert('Failed to update status.');
            }
        } catch (err) {
            console.error(err);
            alert('Error updating status.');
        }
    }
</script>

</body>
</html>
