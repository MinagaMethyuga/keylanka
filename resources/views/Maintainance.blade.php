<!DOCTYPE html>
<html class="light" lang="en"><head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Key Lanka - Maintenance</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec1313",
                        "background-light": "#ffffff",
                        "background-dark": "#0a0a0a",
                        "surface-light": "#fcfcfc",
                        "surface-dark": "#171717",
                    },
                    fontFamily: {
                        "display": ["Space Grotesk", "sans-serif"],
                        "sans": ["Space Grotesk", "sans-serif"],
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display antialiased overflow-x-hidden min-h-screen flex flex-col">
<header class="w-full px-6 py-6 md:px-12 lg:px-24 flex items-center justify-between z-10">
    <div class="flex items-center gap-3">
        <div class="h-8 w-8 bg-primary rounded-lg flex items-center justify-center text-white">
            <span class="material-symbols-outlined text-[20px]">key</span>
        </div>
        <h1 class="text-xl font-bold tracking-tight">Key Lanka</h1>
    </div>
    <div class="flex items-center gap-2">
<span class="relative flex h-3 w-3">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
<span class="relative inline-flex rounded-full h-3 w-3 bg-primary"></span>
</span>
        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">System Maintenance</span>
    </div>
</header>
<main class="flex-grow flex items-center justify-center px-4 py-8 relative">
    <div class="absolute inset-0 overflow-hidden -z-10 opacity-30 dark:opacity-10 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/5 rounded-full blur-3xl mix-blend-multiply filter"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-slate-200 dark:bg-slate-800 rounded-full blur-3xl mix-blend-multiply filter"></div>
    </div>
    <div class="w-full max-w-3xl flex flex-col items-center gap-8 md:gap-12 animate-in fade-in zoom-in duration-500 ease-out">
        <div class="bg-surface-light dark:bg-surface-dark border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none rounded-2xl p-8 md:p-12 w-full text-center relative overflow-hidden group">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-80"></div>
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <div class="absolute inset-0 bg-primary/10 rounded-full blur-xl transform scale-150"></div>
                    <span class="material-symbols-outlined text-primary text-[64px] md:text-[80px] relative z-10 drop-shadow-sm">build_circle</span>
                </div>
            </div>
            <h2 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4 tracking-tight">
                We'll Be Right Back!
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-base md:text-lg max-w-lg mx-auto leading-relaxed mb-8">
                We are currently tuning up our digital storefront to serve you better. We expect to be back online shortly with new keys and accessories.
            </p>
{{--            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">--}}
{{--                <button class="bg-primary hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-[1.02] flex items-center gap-2 shadow-lg shadow-primary/20">--}}
{{--                    <span class="material-symbols-outlined text-[20px]">mail</span>--}}
{{--                    <span>Contact Support</span>--}}
{{--                </button>--}}
{{--            </div>--}}
        </div>
    </div>
</main>
<footer class="w-full py-8 text-center px-4">
    <div class="flex justify-center gap-6 mb-4">
        <a aria-label="Facebook" class="text-slate-400 hover:text-primary transition-colors" href="#">
            <span class="material-symbols-outlined">public</span>
        </a>
        <a aria-label="Twitter" class="text-slate-400 hover:text-primary transition-colors" href="#">
            <span class="material-symbols-outlined">rss_feed</span>
        </a>
        <a aria-label="Instagram" class="text-slate-400 hover:text-primary transition-colors" href="#">
            <span class="material-symbols-outlined">photo_camera</span>
        </a>
    </div>
    <p class="text-slate-400 text-sm">© 2024 Key Lanka. All rights reserved.</p>
</footer>

</body></html>
