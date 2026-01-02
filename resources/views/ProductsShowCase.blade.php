<!DOCTYPE html>
<html class="light" lang="en"><head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Key Lanka - Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --checkbox-tick-svg: url('data:image/svg+xml,%3csvg viewBox=%270 0 16 16%27 fill=%27rgb(255,255,255)%27 xmlns=%27http://www.w3.org/2000/svg%27%3e%3cpath d=%27M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z%27/%3e%3c/svg%3e');
            }
        }
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .product-card {
            opacity: 0;
            animation: slide-up 0.4s ease-out forwards;
            will-change: transform, opacity;
        }
        .product-card:nth-child(1) { animation-delay: 0.05s; }
        .product-card:nth-child(2) { animation-delay: 0.1s; }
        .product-card:nth-child(3) { animation-delay: 0.15s; }
        .product-card:nth-child(4) { animation-delay: 0.2s; }
        .product-card:nth-child(5) { animation-delay: 0.25s; }
        .product-card:nth-child(6) { animation-delay: 0.3s; }
        .product-card:nth-child(7) { animation-delay: 0.35s; }
        .product-card:nth-child(8) { animation-delay: 0.4s; }
        .product-card:nth-child(9) { animation-delay: 0.45s; }
        .product-card:nth-child(10) { animation-delay: 0.5s; }
        .product-card:nth-child(11) { animation-delay: 0.55s; }
        .product-card:nth-child(12) { animation-delay: 0.6s; }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#DC2626",
                        "background-light": "#ffffff",
                        "background-dark": "#111827",
                        "surface-dark": "#1F2937",
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
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-[#1A1A1A] dark:text-gray-200">
<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-col">
        <div class="w-full">
            <x-navbar/>
        </div>
        <main class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex-1">
                <div class="flex flex-col sm:flex-row flex-wrap justify-between items-baseline gap-4 mb-6">
                    <p class="text-[#1A1A1A] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em] min-w-72">{{$brandname}}</p>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-[#6c757d]">Sort by:</span>
                        <select id="sortSelect" class="form-select rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-surface-dark text-sm focus:border-primary focus:ring-primary">
                            <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Customer Rating</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($items as $item)
                        <div class="product-card group relative flex flex-col overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-surface-dark transition-all duration-300 hover:shadow-lg hover:-translate-y-1"
                             data-product-id="{{ $item->id }}"
                             data-product-title="{{ $item->title }}"
                             data-product-price="{{ $item->price }}"
                             data-product-image="{{ asset($item->image) }}">
                            <div class="aspect-square overflow-hidden bg-gray-100 dark:bg-gray-900/50">
                                @if(empty($item->stock))
                                    <div class="absolute top-2 right-2 bg-red-500/30 px-2 rounded-2xl z-50">
                                        <p class="text-red-500">Out Of Stock</p>
                                    </div>
                                @endif
                                <img class="h-full w-full object-contain object-center transition-transform duration-300 group-hover:scale-105 p-2"
                                     src="{{ asset($item->image) }}"
                                     alt="{{ $item->title }}">
                            </div>
                            <div class="flex flex-1 flex-col p-4">
                                <h3 class="text-base font-bold text-[#1A1A1A] dark:text-white">{{ $item->title }}</h3>
                                @if(!empty($item->brand))
                                    <p class="mt-1 text-sm font-regular text-[#6c757d]">Brand:{{$item->brand}}</p>
                                @endif
                                <p class="mt-1 text-lg font-semibold text-primary">LKR {{ number_format($item->price, 2) }}</p>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 translate-y-full transform bg-white dark:bg-surface-dark p-4 transition-transform duration-300 group-hover:translate-y-0">
                                @if(empty($item->stock))
                                    <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-white text-red-700 text-sm font-bold leading-normal tracking-[0.015em]">
                                        Out Of Stock
                                    </button>
                                @else
                                    <button class="add-to-cart-btn flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-red-700 dark:hover:bg-red-500">
                                        Add to Cart
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <nav aria-label="Pagination" class="mt-12 flex items-center justify-center">
                    <ul class="flex items-center -space-x-px h-10 text-base">
                        @if($items->onFirstPage())
                            <li>
                                <span class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-300 bg-white border border-gray-300 rounded-s-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600 cursor-not-allowed">
                                    <span class="sr-only">Previous</span>
                                    <span class="material-symbols-outlined">chevron_left</span>
                                </span>
                            </li>
                        @else
                            <li>
                                <a class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                   href="{{ $items->appends(request()->query())->previousPageUrl() }}">
                                    <span class="sr-only">Previous</span>
                                    <span class="material-symbols-outlined">chevron_left</span>
                                </a>
                            </li>
                        @endif

                        @foreach($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                            <li>
                                @if($page == $items->currentPage())
                                    <span class="flex items-center justify-center px-4 h-10 text-white bg-primary border border-primary dark:border-primary">{{ $page }}</span>
                                @else
                                    <a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                       href="{{ $items->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                @endif
                            </li>
                        @endforeach

                        @if($items->hasMorePages())
                            <li>
                                <a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                   href="{{ $items->appends(request()->query())->nextPageUrl() }}">
                                    <span class="sr-only">Next</span>
                                    <span class="material-symbols-outlined">chevron_right</span>
                                </a>
                            </li>
                        @else
                            <li>
                                <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-300 bg-white border border-gray-300 rounded-e-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600 cursor-not-allowed">
                                    <span class="sr-only">Next</span>
                                    <span class="material-symbols-outlined">chevron_right</span>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </main>
    </div>
</div>

<x-SideBarCart/>

<script src="../js/Cart.js"></script>
<script src="../js/Navbar.js"></script>
<script>
    // Sort functionality
    document.getElementById('sortSelect').addEventListener('change', function() {
        const sortValue = this.value;
        const url = new URL(window.location.href);
        url.searchParams.set('sort', sortValue);
        url.searchParams.set('page', '1'); // Reset to first page when sorting
        window.location.href = url.toString();
    });
</script>
</body>
</html>
