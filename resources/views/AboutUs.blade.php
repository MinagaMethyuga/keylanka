<!DOCTYPE html>

<html class="light" lang="en"><head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>About Us - Key Lanka</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec1313",
                        "background-light": "#f8f6f6",
                        "background-dark": "#221010",
                    },
                    fontFamily: {
                        "display": ["Space Grotesk", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-[#1A1A1A] dark:text-gray-200">
<div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-10 lg:px-20 xl:px-40 flex flex-1 justify-center py-5">
            <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
                <!-- TopNavBar -->
                <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-700 px-4 sm:px-10 py-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-md overflow-hidden">
                            <img src="../Assets/Logo.jpg" class="bg-center bg-cover h-full w-full object-contain" alt="Key Lanka Logo"/>
                        </div>
                        <h2 class="text-xl font-bold leading-tight tracking-[-0.015em] text-gray-900 dark:text-white">Key Lanka</h2>
                    </div>
                    <nav class="hidden sm:flex flex-1 justify-end gap-8">
                        <div class="flex items-center gap-9">
                            <a class="text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary transition-colors" href="{{route('home')}}">Home</a>
                            <a class="text-sm font-medium leading-normal text-primary dark:text-primary" href="#">About Us</a>
                        </div>
                    </nav>
                </header>
                <main class="mt-8">
                    <!-- PageHeading -->
                    <div class="flex flex-wrap justify-between gap-3 p-4">
                        <h1 class="text-gray-900 dark:text-white text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em]">Our Story</h1>
                    </div>
                    <!-- BodyText -->
                    <p class="text-gray-700 dark:text-gray-300 text-base font-normal leading-relaxed pb-3 pt-1 px-4">
                        Born from a passion for security and innovation, Key Lanka was founded to revolutionize how we access our world. We started with a simple idea: to create keys that are not just functional, but also beautifully designed and technologically advanced. From classic physical keys crafted with precision to cutting-edge digital access solutions, our commitment is to provide unmatched quality, reliability, and peace of mind to every customer.
                    </p>
                    <!-- SectionHeader -->
                    <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-10">Our Headquarters</h2>
                    <!-- Map -->
                    <div class="flex px-4 py-3">
                        <div class="w-full bg-center bg-no-repeat aspect-[16/7] bg-cover rounded-xl object-cover shadow-lg" data-alt="Stylized map showing the location of Key Lanka headquarters in a modern city." data-location="Colombo, Sri Lanka" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCurhjLLEIn-eQDBglfnxfsn1CUCDhSsQrDSBW18zE7YE55VlgA4ruS6qYplp6ajkMs2TVrN6B7rlIrWMp_A7Ux5e44rhl6_ZIPZzSIhTceEy3t9gq7Wul376D_m-bjdg6foE1MDCbVXdvC9L6dXpoE06htTsJrsAuf32VEakALMY44lOa_rNvdH-gVmz6ERaIV7WrzuusS1_8aSNKcPQjYuXEFzpTEJh2GB4614ngqpVQvhRvZNiU3h_bgg_0eNGCUXYZtJvX1QQ");'></div>
                    </div>
                    <!-- Contact Details Section -->
                    <div class="mt-8 px-4 py-3">
                        <h3 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-5">Get in Touch</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="flex items-start gap-4 p-4 bg-white dark:bg-background-dark rounded-lg border border-gray-200 dark:border-gray-700/50">
                                <div class="flex-shrink-0">
                                    <span class="material-symbols-outlined text-primary text-2xl">call</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">Phone</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">+94 11 234 5678</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-4 bg-white dark:bg-background-dark rounded-lg border border-gray-200 dark:border-gray-700/50">
                                <div class="flex-shrink-0">
                                    <span class="material-symbols-outlined text-primary text-2xl">mail</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">Email</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">hello@keylanka.com</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-4 bg-white dark:bg-background-dark rounded-lg border border-gray-200 dark:border-gray-700/50">
                                <div class="flex-shrink-0">
                                    <span class="material-symbols-outlined text-primary text-2xl">location_on</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">Address</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">123 Galle Road, Colombo 03, Sri Lanka</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- Footer -->
                <footer class="mt-16 border-t border-gray-200 dark:border-gray-700 pt-8 pb-8 px-4">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">© 2024 Key Lanka. All rights reserved.</p>
                        <div class="flex items-center gap-4">
                            <a class="text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition-colors" href="#">
                                <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewbox="0 0 24 24">
                                    <path clip-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" fill-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a class="text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition-colors" href="#">
                                <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewbox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                </svg>
                            </a>
                            <a class="text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition-colors" href="#">
                                <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewbox="0 0 24 24">
                                    <path clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.887 12.034c.33.19.33.653 0 .842l-5.11 2.95a.485.485 0 01-.728-.421V8.59a.485.485 0 01.727-.42l5.11 2.95z" fill-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</div>
</body></html>
