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
                    <p class="text-[#1A1A1A] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em] min-w-72">All Products</p>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-[#6c757d]">Sort by:</span>
                        <select class="form-select rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-surface-dark text-sm focus:border-primary focus:ring-primary">
                            <option>Featured</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Customer Rating</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <div class="group relative flex flex-col overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-surface-dark transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="aspect-square overflow-hidden bg-gray-100 dark:bg-gray-900/50">
                            <img class="h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105" data-alt="A sleek black and silver smart lock installed on a wooden door." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD7vyhV5fDdk1NszblNUbB5axumHSfINK8b6BkYfksO1tguhPwrCb2k0E1YOR8T5PhZPN6Dgh7x1t8Nbgwe42KhxkKLF1zcKV1393-FqfDmuV_ETSRLAhjVJHys10dCSf6cELGlHv3V8yNpAWCHDY44wlEeHGhwU2oBjQQqXqKZ1LXqJoD9nD9SWgUUItTTboB1ZEJHV5YzEGdIgRrrF8LvU6RmRCiVkySTEarXZeYciePya5kp_bHqPQFq4T2V_VcOPzyPAbSdGg"/>
                        </div>
                        <div class="flex flex-1 flex-col p-4">
                            <h3 class="text-base font-bold text-[#1A1A1A] dark:text-white">YL-Smart Lock Pro</h3>
                            <p class="mt-1 text-lg font-semibold text-primary">$249.99</p>
                            <div class="mt-2 flex items-center gap-1">
                                <span class="material-symbols-outlined text-yellow-500 !text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-yellow-500 !text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-yellow-500 !text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-yellow-500 !text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-yellow-500 !text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="ml-1 text-xs text-[#6c757d]">(88)</span>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 translate-y-full transform bg-white dark:bg-surface-dark p-4 transition-transform duration-300 group-hover:translate-y-0">
                            <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-red-700 dark:hover:bg-red-500">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <nav aria-label="Pagination" class="mt-12 flex items-center justify-center">
                    <ul class="flex items-center -space-x-px h-10 text-base">
                        <li>
                            <a class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#">
                                <span class="sr-only">Previous</span>
                                <span class="material-symbols-outlined">chevron_left</span>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center justify-center px-4 h-10 text-white bg-primary border border-primary dark:border-primary" href="#">1</a>
                        </li>
                        <li>
                            <a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#">2</a>
                        </li>
                        <li>
                            <a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#">3</a>
                        </li>
                        <li>
                            <a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#">
                                <span class="sr-only">Next</span>
                                <span class="material-symbols-outlined">chevron_right</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </main>
    </div>
</div>

<script src="js/Navbar.js"></script>
</body>
</html>
