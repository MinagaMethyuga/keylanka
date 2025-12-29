<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Key Lanka Order Confirmation Page</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
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
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-200">
<div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-col">
        <main class="flex flex-1 justify-center py-10 sm:py-16 px-4 sm:px-6 lg:px-8">
            <div class="layout-content-container flex flex-col w-full max-w-4xl flex-1 gap-8">
                <div class="flex flex-col items-center gap-6 bg-white dark:bg-slate-900/50 p-8 sm:p-12 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800">
                    <div class="text-primary">
                        <span class="material-symbols-outlined text-6xl">check_circle</span>
                    </div>
                    <h1 class="text-slate-900 dark:text-white tracking-tight text-3xl sm:text-4xl font-bold leading-tight text-center">Thank You for Your Order!</h1>
                    <p class="text-slate-600 dark:text-slate-400 text-base font-normal leading-normal text-center max-w-md">You will receive an email confirmation shortly with your order details and tracking information.</p>
                    <div class="mt-2 flex items-center gap-3 rounded-lg bg-background-light dark:bg-background-dark p-3 border border-slate-200 dark:border-slate-800">
                        <p class="text-slate-700 dark:text-slate-300 text-base font-normal leading-normal">Your Order Number is: <strong class="font-bold text-slate-900 dark:text-white">{{ $order->order_id }}</strong></p>
                        <button onclick="copyOrderId()" class="text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary">
                            <span class="material-symbols-outlined text-lg">content_copy</span>
                        </button>
                    </div>
                </div>

                <div class="flex flex-col gap-6 bg-white dark:bg-slate-900/50 p-8 sm:p-10 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800">
                    <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">Order Summary</h3>
                    <div class="flow-root">
                        <ul id="orderItemsList" class="-my-6 divide-y divide-slate-200 dark:divide-slate-800" role="list">
                            @php
                                $items = json_decode($order->items ?? '[]', true);
                                if (!is_array($items)) {
                                    $items = [];
                                }
                            @endphp

                            @forelse($items as $item)
                                <li class="flex py-6">
                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-slate-200 dark:border-slate-800">
                                        <img class="h-full w-full object-contain object-center"
                                             src="{{ $item['image'] ?? 'https://via.placeholder.com/150' }}"
                                             alt="{{ $item['title'] ?? 'Product' }}"/>
                                    </div>
                                    <div class="ml-4 flex flex-1 flex-col">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-slate-900 dark:text-white">
                                                <h3><a href="#">{{ $item['title'] ?? 'Product' }}</a></h3>
                                                <p class="ml-4">{{ $order->currency }} {{ number_format($item['price'] ?? 0, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-1 items-end justify-between text-sm">
                                            <p class="text-slate-500 dark:text-slate-400">Qty {{ $item['quantity'] ?? 1 }}</p>
                                            <p class="text-slate-600 dark:text-slate-400 font-medium">{{ $order->currency }} {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}</p>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="py-6 text-center text-slate-500 dark:text-slate-400">
                                    No items found
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="border-t border-slate-200 dark:border-slate-800 pt-6 space-y-4">
                        <div class="flex justify-between text-base text-slate-600 dark:text-slate-400">
                            <p>Subtotal</p>
                            <p id="subtotalAmount">{{ $order->currency }} {{ number_format($order->amount ?? 0, 2) }}</p>
                        </div>
                        <div class="flex justify-between text-base font-bold text-slate-900 dark:text-white">
                            <p>Total</p>
                            <p id="totalAmount">{{ $order->currency }} {{ number_format($order->paid_amount ?? $order->amount ?? 0, 2) }}</p>
                        </div>
                    </div>

                    <div class="border-t border-slate-200 dark:border-slate-800 pt-6 grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white mb-2">Shipping Address</h4>
                            <address class="not-italic text-slate-600 dark:text-slate-400 leading-relaxed">
                                {{ $order->First_Name }} {{ $order->Last_Name }}<br/>
                                {{ $order->Address }}<br/>
                                {{ $order->City }}, {{ $order->State }} {{ $order->Zip_Code }}
                            </address>
                            @if($order->Delivery_Instructions)
                                <p class="mt-2 text-xs text-slate-500 dark:text-slate-500">
                                    <strong>Delivery Instructions:</strong> {{ $order->Delivery_Instructions }}
                                </p>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white mb-2">Contact Information</h4>
                            <div class="text-slate-600 dark:text-slate-400 leading-relaxed">
                                <p>{{ $order->Email }}</p>
                                <p>{{ $order->Phone }}</p>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white mb-2">Payment Method</h4>
                            <p class="text-slate-600 dark:text-slate-400">
                                @if($order->card_holder_name)
                                    {{ $order->card_holder_name }}<br/>
                                @endif
                                @if($order->card_no)
                                    Card ending in {{ substr($order->card_no, -4) }}<br/>
                                @endif
                                @if($order->payment_id)
                                    <span class="text-xs">Payment ID: {{ $order->payment_id }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-4">
                    <a class="w-full sm:w-auto flex items-center justify-center rounded-lg bg-primary px-8 py-3 text-base font-semibold text-white shadow-sm hover:bg-primary/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
                       href="{{ route('home') }}">Continue Shopping</a>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function copyOrderId() {
        const orderId = "{{ $order->order_id }}";
        navigator.clipboard.writeText(orderId).then(() => {
            alert('Order ID copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy:', err);
        });
    }

    // Clear cart and finalAmount from localStorage after page loads
    function clearCart() {
        localStorage.removeItem('cart');
        localStorage.removeItem('finalAmount');
        console.log('Cart cleared successfully');
    }

    // Clear cart when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            clearCart();
        }, 1000);
    });

    // Also clear on page load (backup)
    window.addEventListener('load', function() {
        setTimeout(() => {
            clearCart();
        }, 1500);
    });
</script>
</body>
</html>
