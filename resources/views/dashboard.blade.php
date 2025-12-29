<!DOCTYPE html>

<html class="dark" lang="en"><head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Key Lanka - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00A9FF",
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
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #c5c5c5;
            border-radius: 10px;
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Dark mode */
        .dark ::-webkit-scrollbar-thumb {
            background: #444;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Firefox Scrollbar */
        * {
            scrollbar-width: thin;
            scrollbar-color: #c5c5c5 transparent;
        }

        .dark * {
            scrollbar-color: #444 transparent;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-card {
            background-color: rgba(30, 30, 30, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(45, 45, 45, 0.5);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
        .dark .glass-card {
            background-color: rgba(30, 30, 30, 0.6);
            border: 1px solid rgba(45, 45, 45, 0.5);
        }
        .light .glass-card {
            background-color: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(230, 230, 230, 0.5);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
        }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-[#EAEAEA]">
<div class="flex h-screen w-full">
    <!-- SideNavBar -->
    <x-AdminNavbar/>
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        <!-- TopNavBar -->
        <header class="sticky top-0 z-10 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#2D2D2D] bg-[#121212]/80 px-10 py-4 backdrop-blur-md">
            <div class="flex items-center gap-8">
                <h2 class="text-[#EAEAEA] text-lg font-bold leading-tight tracking-[-0.015em]">Dashboard</h2>
                <label class="flex flex-col min-w-40 !h-10 w-80">
                    <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                        <div class="text-[#A0A0A0] flex border border-r-0 border-[#2D2D2D] bg-[#1E1E1E] items-center justify-center pl-4 rounded-l-lg">
                            <span class="material-symbols-outlined text-xl">search</span>
                        </div>
                        <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#EAEAEA] focus:outline-0 focus:ring-2 focus:ring-primary border border-l-0 border-[#2D2D2D] bg-[#1E1E1E] h-full placeholder:text-[#A0A0A0] px-4 rounded-l-none pl-2 text-base font-normal leading-normal" placeholder="Search anything..." value=""/>
                    </div>
                </label>
            </div>
            <div class="flex flex-1 justify-end items-center gap-4">
                <button class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 w-10 bg-[#1E1E1E] text-[#A0A0A0] border border-[#2D2D2D] hover:text-primary transition-colors duration-200">
                    <span class="material-symbols-outlined text-xl">notifications</span>
                </button>
            </div>
        </header>
        <div class="p-8">
            <!-- Stats -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="flex flex-col gap-2 rounded-xl p-6 glass-card transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex justify-between items-center">
                        <p class="text-[#A0A0A0] text-base font-medium leading-normal">Total Products</p>
                        <span class="material-symbols-outlined text-primary">inventory_2</span>
                    </div>
                    <p class="text-white tracking-light text-3xl font-bold leading-tight">{{$ProductCount}}</p>
                </div>
                <div class="flex flex-col gap-2 rounded-xl p-6 glass-card transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex justify-between items-center">
                        <p class="text-[#A0A0A0] text-base font-medium leading-normal">Total Orders</p>
                        <span class="material-symbols-outlined text-primary">receipt_long</span>
                    </div>
                    <p class="text-white tracking-light text-3xl font-bold leading-tight">{{$OrderCount}}</p>
                </div>
                <div class="flex flex-col gap-2 rounded-xl p-6 glass-card transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex justify-between items-center">
                        <p class="text-[#A0A0A0] text-base font-medium leading-normal">Total Earnings</p>
                        <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                    </div>
                    <p class="text-white tracking-light text-3xl font-bold leading-tight">{{$TotalEarning}}</p>
                </div>
                <div class="flex flex-col gap-2 rounded-xl p-6 glass-card transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex justify-between items-center">
                        <p class="text-[#A0A0A0] text-base font-medium leading-normal">Verified Users</p>
                        <span class="material-symbols-outlined text-primary">person</span>
                    </div>
                    <p class="text-white tracking-light text-3xl font-bold leading-tight">{{$VerifiedUsers}}</p>
                </div>
            </div>
            <!-- Charts -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-5 gap-6">
                <div class="lg:col-span-3 flex flex-col gap-3 p-5 rounded-xl bg-[#1E1E1E] border border-[#2D2D2D]">
                    <p class="text-white text-base font-medium leading-normal">Sales Progress</p>
                    <p class="text-white tracking-light text-2xl font-bold leading-tight truncate" id="salesTotal">LKR{{number_format($last30DaysSales, 2)}}</p>
                    <div class="flex gap-2 items-center">
                        <p class="text-[#A0A0A0] text-sm font-normal leading-normal">Last 30 Days</p>
                        <p class="text-green-400 text-sm font-medium leading-normal" id="salesGrowth">{{$salesGrowth > 0 ? '+' : ''}}{{number_format($salesGrowth, 1)}}%</p>
                    </div>
                    <div class="h-[300px] py-2">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
                <div class="lg:col-span-2 flex flex-col gap-3 p-5 rounded-xl bg-[#1E1E1E] border border-[#2D2D2D]">
                    <p class="text-white text-base font-medium leading-normal">Daily Traffic</p>
                    <p class="text-white tracking-light text-2xl font-bold leading-tight truncate" id="trafficTotal">{{$last7DaysOrders}} orders</p>
                    <div class="flex gap-2 items-center">
                        <p class="text-[#A0A0A0] text-sm font-normal leading-normal">Last 7 Days</p>
                        <p class="text-green-400 text-sm font-medium leading-normal" id="trafficGrowth">{{$trafficGrowth > 0 ? '+' : ''}}{{number_format($trafficGrowth, 1)}}%</p>
                    </div>
                    <div class="h-[140px] py-2">
                        <canvas id="trafficChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Latest Orders Table -->
            <div class="mt-8">
                <h2 class="text-[#EAEAEA] text-xl font-bold leading-tight tracking-[-0.015em] pb-4">Latest Orders</h2>
                <div class="overflow-x-auto rounded-lg border border-[#2D2D2D] bg-[#1E1E1E]">
                    <table class="w-full text-left text-sm text-[#A0A0A0]">
                        <thead class="bg-[#2D2D2D] text-xs uppercase text-white">
                        <tr>
                            <th class="px-6 py-3" scope="col">Order ID</th>
                            <th class="px-6 py-3" scope="col">Customer</th>
                            <th class="px-6 py-3" scope="col">Date</th>
                            <th class="px-6 py-3" scope="col">Status</th>
                            <th class="px-6 py-3 text-right" scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($latestOrders as $order)
                            <tr class="border-b border-b-[#2D2D2D] hover:bg-[#2D2D2D]/50 last:border-b-0">
                                <td class="px-6 py-4 font-medium text-white whitespace-nowrap">#{{$order->order_id}}</td>
                                <td class="px-6 py-4">{{$order->customer_name}}</td>
                                <td class="px-6 py-4">{{$order->created_at->format('Y-m-d')}}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'completed' => 'bg-green-500/20 text-green-400',
                                            'pending' => 'bg-yellow-500/20 text-yellow-400',
                                            'shipped' => 'bg-blue-500/20 text-blue-400',
                                            'cancelled' => 'bg-red-500/20 text-red-400',
                                            'processing' => 'bg-purple-500/20 text-purple-400'
                                        ];
                                        $colorClass = $statusColors[strtolower($order->status)] ?? 'bg-gray-500/20 text-gray-400';
                                    @endphp
                                    <span class="inline-flex items-center rounded-full {{$colorClass}} px-2 py-1 text-xs font-medium">{{ucfirst($order->status)}}</span>
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-white">${{number_format($order->total, 2)}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-[#A0A0A0]">No orders found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    // Sales Progress Chart Data from Backend
    const salesData = @json($salesChartData);

    // Create Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: salesData.labels,
            datasets: [{
                label: 'Sales',
                data: salesData.values,
                borderColor: '#00A9FF',
                backgroundColor: function(context) {
                    const ctx = context.chart.ctx;
                    const gradient = ctx.createLinearGradient(0, 0, 0, 180);
                    gradient.addColorStop(0, 'rgba(0, 169, 255, 0.3)');
                    gradient.addColorStop(1, 'rgba(0, 169, 255, 0)');
                    return gradient;
                },
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 0,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#00A9FF',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(30, 30, 30, 0.9)',
                    titleColor: '#EAEAEA',
                    bodyColor: '#EAEAEA',
                    borderColor: '#2D2D2D',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return '$' + context.parsed.y.toFixed(2);
                        }
                    }
                }
            },
            scales: {
                x: {
                    display: true,
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#A0A0A0',
                        font: {
                            size: 11
                        }
                    }
                },
                y: {
                    display: true,
                    grid: {
                        color: 'rgba(45, 45, 45, 0.5)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#A0A0A0',
                        font: {
                            size: 11
                        },
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            }
        }
    });

    // Daily Traffic Chart Data from Backend
    const trafficData = @json($trafficChartData);

    // Create Traffic Chart
    const trafficCtx = document.getElementById('trafficChart').getContext('2d');
    const trafficChart = new Chart(trafficCtx, {
        type: 'bar',
        data: {
            labels: trafficData.labels,
            datasets: [{
                label: 'Orders',
                data: trafficData.values,
                backgroundColor: 'rgba(0, 169, 255, 0.2)',
                borderColor: 'rgba(0, 169, 255, 0)',
                borderWidth: 0,
                borderRadius: {
                    topLeft: 4,
                    topRight: 4
                },
                hoverBackgroundColor: '#00A9FF'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(30, 30, 30, 0.9)',
                    titleColor: '#EAEAEA',
                    bodyColor: '#EAEAEA',
                    borderColor: '#2D2D2D',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' orders';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#A0A0A0',
                        font: {
                            size: 11,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    display: true,
                    grid: {
                        color: 'rgba(45, 45, 45, 0.5)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#A0A0A0',
                        font: {
                            size: 11
                        },
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
</body>
</html>
