@php
    $productImages = $product->images->isEmpty()
        ? (isset($product->image) && $product->image ? collect([(object)['path' => $product->image]]) : collect())
        : $product->images->sortByDesc('is_primary')->values();
    $mainImage = $productImages->first();
@endphp
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $product->title }} - Key Lanka</title>
    <meta name="description" content="{{ Str::limit(strip_tags($product->description), 160) }}"/>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
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
                    fontFamily: { "display": ["Space Grotesk", "sans-serif"] },
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-[#1A1A1A] dark:text-gray-200">
    <div class="min-h-screen flex flex-col">
        <header class="w-full">
            <x-navbar/>
        </header>

        <main class="flex-1 mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
            {{-- Breadcrumbs --}}
            <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
                <span class="material-symbols-outlined text-base">chevron_right</span>
                <a href="{{ $categoryRoute }}" class="hover:text-primary transition-colors">{{ $categoryName }}</a>
                <span class="material-symbols-outlined text-base">chevron_right</span>
                <span class="text-[#1A1A1A] dark:text-white font-medium truncate max-w-[200px] sm:max-w-none">{{ $product->title }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">
                {{-- Left: Image gallery --}}
                <div class="lg:col-span-5">
                    <div class="sticky top-4">
                        <div class="aspect-square w-full max-w-lg mx-auto bg-gray-100 dark:bg-gray-800 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 flex items-center justify-center">
                            @if($mainImage)
                                <img id="mainProductImage" src="{{ asset($mainImage->path ?? $mainImage) }}" alt="{{ $product->title }}" class="w-full h-full object-contain p-4"/>
                            @else
                                <div class="text-gray-400 dark:text-gray-500 flex flex-col items-center gap-2">
                                    <span class="material-symbols-outlined text-5xl">image_not_supported</span>
                                    <span>No image</span>
                                </div>
                            @endif
                        </div>
                        @if($productImages->count() > 1)
                            <div class="mt-4 flex items-center gap-2">
                                <button type="button" id="thumbPrev" class="shrink-0 w-10 h-10 rounded-lg border border-gray-300 dark:border-gray-600 flex items-center justify-center hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Previous image">
                                    <span class="material-symbols-outlined text-xl">chevron_left</span>
                                </button>
                                <div id="thumbStrip" class="flex-1 flex gap-2 overflow-x-auto pb-1 scroll-smooth scrollbar-thin" style="scrollbar-width: thin;">
                                    @foreach($productImages as $index => $img)
                                        @php $path = is_object($img) ? $img->path : $img; @endphp
                                        <button type="button" class="thumb-btn shrink-0 w-16 h-16 rounded-lg border-2 overflow-hidden transition-all {{ $index === 0 ? 'border-primary ring-2 ring-primary/30' : 'border-gray-200 dark:border-gray-600 hover:border-gray-300' }}" data-src="{{ asset($path) }}" data-index="{{ $index }}">
                                            <img src="{{ asset($path) }}" alt="" class="w-full h-full object-cover"/>
                                        </button>
                                    @endforeach
                                </div>
                                <button type="button" id="thumbNext" class="shrink-0 w-10 h-10 rounded-lg border border-gray-300 dark:border-gray-600 flex items-center justify-center hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Next image">
                                    <span class="material-symbols-outlined text-xl">chevron_right</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Center: Product info --}}
                <div class="lg:col-span-4" id="product-detail-card" data-product-id="{{ $product->id }}" data-product-title="{{ $product->title }}" data-product-price="{{ $product->price }}" data-product-image="{{ asset($product->display_image ?? $product->image) }}" data-quantity="1">
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#1A1A1A] dark:text-white leading-tight mb-2">{{ $product->title }}</h1>
                    @if($product->brand)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                            Brand: <span class="font-medium text-[#1A1A1A] dark:text-white">{{ $product->brand }}</span>
                        </p>
                    @endif

                    <div class="flex items-baseline gap-3 mb-6">
                        <span class="text-2xl sm:text-3xl font-bold text-primary">LKR {{ number_format($product->price, 2) }}</span>
                    </div>

                    @if($product->stock <= 0)
                        <div class="inline-flex items-center px-3 py-1.5 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-sm font-medium mb-6">
                            Out of stock
                        </div>
                    @else
                        <div class="flex flex-wrap items-center gap-4 mb-6">
                            <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                <button type="button" id="qtyMinus" class="w-10 h-10 flex items-center justify-center bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors" aria-label="Decrease quantity">
                                    <span class="material-symbols-outlined text-xl">remove</span>
                                </button>
                                <input type="number" id="quantity" name="quantity" min="1" max="{{ max(1, (int) $product->stock) }}" value="1" class="w-14 h-10 text-center border-0 border-x border-gray-300 dark:border-gray-600 bg-transparent text-[#1A1A1A] dark:text-white font-medium focus:ring-0 focus:outline-none"/>
                                <button type="button" id="qtyPlus" class="w-10 h-10 flex items-center justify-center bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors" aria-label="Increase quantity">
                                    <span class="material-symbols-outlined text-xl">add</span>
                                </button>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $product->stock }} available</p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <button type="button" class="add-to-cart-btn inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-primary text-white font-semibold hover:bg-red-700 dark:hover:bg-red-600 transition-colors">
                                <span class="material-symbols-outlined text-xl">shopping_cart</span>
                                Add to Cart
                            </button>
                            <button type="button" id="buy-now-btn" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg border-2 border-primary text-primary font-semibold hover:bg-primary hover:text-white transition-colors">
                                Buy Now
                            </button>
                        </div>
                    @endif

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-bold text-[#1A1A1A] dark:text-white mb-3">Description</h2>
                        <div class="prose prose-sm dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 whitespace-pre-wrap">{{ $product->description }}</div>
                    </div>
                </div>

                {{-- Right: Delivery & info sidebar --}}
                <div class="lg:col-span-3">
                    <div class="lg:sticky lg:top-4 space-y-4">
                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-surface-dark p-5">
                            <h3 class="font-semibold text-[#1A1A1A] dark:text-white mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-xl">local_shipping</span>
                                Delivery
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Standard delivery available island-wide.</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Cash on Delivery available.</p>
                        </div>
                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-surface-dark p-5">
                            <h3 class="font-semibold text-[#1A1A1A] dark:text-white mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-xl">verified_user</span>
                                Return & Warranty
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Easy return policy. Contact us for warranty details.</p>
                        </div>
                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-surface-dark p-5">
                            <h3 class="font-semibold text-[#1A1A1A] dark:text-white mb-2">Sold by</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Key Lanka</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        (function() {
            const mainImg = document.getElementById('mainProductImage');
            const thumbStrip = document.getElementById('thumbStrip');
            const thumbBtns = document.querySelectorAll('.thumb-btn');
            const thumbPrev = document.getElementById('thumbPrev');
            const thumbNext = document.getElementById('thumbNext');
            const quantityInput = document.getElementById('quantity');
            const qtyMinus = document.getElementById('qtyMinus');
            const qtyPlus = document.getElementById('qtyPlus');

            if (thumbBtns.length) {
                thumbBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const src = this.dataset.src;
                        if (mainImg && src) mainImg.src = src;
                        thumbBtns.forEach(b => {
                            b.classList.remove('border-primary', 'ring-2', 'ring-primary/30');
                            b.classList.add('border-gray-200', 'dark:border-gray-600');
                        });
                        this.classList.add('border-primary', 'ring-2', 'ring-primary/30');
                        this.classList.remove('border-gray-200', 'dark:border-gray-600');
                    });
                });
                if (thumbPrev) thumbPrev.addEventListener('click', () => thumbStrip && thumbStrip.scrollBy({ left: -80, behavior: 'smooth' }));
                if (thumbNext) thumbNext.addEventListener('click', () => thumbStrip && thumbStrip.scrollBy({ left: 80, behavior: 'smooth' }));
            }

            if (quantityInput) {
                const max = parseInt(quantityInput.getAttribute('max'), 10) || 999;
                const detailCard = document.getElementById('product-detail-card');
                function syncQuantity() {
                    const v = parseInt(quantityInput.value, 10) || 1;
                    quantityInput.value = Math.min(max, Math.max(1, v));
                    if (detailCard) detailCard.dataset.quantity = quantityInput.value;
                }
                qtyMinus && qtyMinus.addEventListener('click', () => { quantityInput.value = Math.max(1, parseInt(quantityInput.value, 10) - 1); syncQuantity(); });
                qtyPlus && qtyPlus.addEventListener('click', () => { quantityInput.value = Math.min(max, parseInt(quantityInput.value, 10) + 1); syncQuantity(); });
                quantityInput.addEventListener('change', syncQuantity);
            }

            document.getElementById('buy-now-btn')?.addEventListener('click', function() {
                const card = document.getElementById('product-detail-card');
                const qty = parseInt(card?.dataset.quantity, 10) || 1;
                const product = { id: card.dataset.productId, title: card.dataset.productTitle, price: parseFloat(card.dataset.productPrice), image: card.dataset.productImage, quantity: qty };
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                const existing = cart.find(function(item) { return item.id === product.id; });
                if (existing) existing.quantity += product.quantity; else cart.push(product);
                localStorage.setItem('cart', JSON.stringify(cart));
                const total = cart.reduce(function(sum, item) { return sum + item.price * item.quantity; }, 0);
                localStorage.setItem('finalAmount', 'LKR ' + total.toFixed(2));
                window.location.href = '{{ route("checkout") }}';
            });
        })();
    </script>
    <x-SideBarCart/>
    <script src="{{ asset('js/Cart.js') }}"></script>
</body>
</html>
