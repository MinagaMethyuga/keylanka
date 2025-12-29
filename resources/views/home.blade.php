<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Key Lanka - The Future of Access</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#e53e3e",
                        "background-light": "#ffffff",
                        "background-dark": "#000000",
                        "text-light-primary": "#0d121b",
                        "text-dark-primary": "#f0f2f5",
                        "card-light": "#f6f6f8",
                        "card-dark": "#1a1a1a", // Darker card color
                        "border-light": "#e7ebf3",
                        "border-dark": "#333333", // Adjusted dark border
                        "secondary-light": "#4c669a",
                        "secondary-dark": "#94a3b8",
                    },
                    fontFamily: {
                        "display": ["Space Grotesk", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-text-light-primary dark:text-text-dark-primary">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
    <x-navbar/>
    <main class="flex-grow flex justify-center">
        <div class="container mx-auto flex max-w-6xl flex-col gap-12 px-4 py-8 md:gap-16 md:py-16">
            <section class="@container">
                <div class="relative flex min-h-[480px] w-full flex-col items-center justify-center gap-6 overflow-hidden rounded-xl bg-cover bg-center bg-no-repeat p-4 text-center md:gap-8" data-alt="Abstract image of a futuristic, glowing digital key against a dark, tech-inspired background" style='background-image: linear-gradient(rgba(10, 10, 10, 0.5) 0%, rgba(0, 0, 0, 0.8) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuB2KKxfo0pCLaR2Q9UtohIRxmDwiJQj9RzCdlXewqgC0zQR0NJVBgL7OqdF1qf7O5axIFHB8LsMBxUXE_ngg42xG8MGyRkM4PAZIOAukU41DBrpcA9Rl3CDQrGnF3JckH-OaGwywrO_LVf4h9eZEOW3yBX3_eQux36gRLDWYGfl6WO5xjSWBzY-qTVJCYOynQJ2G24J5S2iW0gM6LWTQTC465DJkj4ux78DUGTCALdSQ96xsGqfsfXqKzQyCdsdXwyRhYGKiON79w");'>
                    <div class="flex flex-col gap-4">
                        <h1 class="text-4xl font-black leading-tight tracking-tighter text-white md:text-6xl">The Future of Access</h1>
                        <h2 class="max-w-xl text-base font-normal leading-normal text-slate-200 md:text-lg">Discover our collection of high-security digital and physical keys for modern living.</h2>
                    </div>
                    <button class="flex h-12 min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg bg-primary px-5 text-base font-bold leading-normal tracking-wide text-white transition-transform hover:scale-105">
                        <span class="truncate">Explore Collection</span>
                    </button>
                </div>
            </section>
            {{--Shop By Category Section--}}
            <section>
                <h2 class="px-4 pb-4 pt-5 text-2xl font-bold leading-tight tracking-tight">Shop by Category</h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="flex flex-col gap-3 rounded-lg border border-border-light bg-card-light p-6 transition-transform hover:-translate-y-1 dark:border-border-dark dark:bg-card-dark">
                        <span class="material-symbols-outlined text-3xl text-primary">key</span>
                        <div class="flex flex-col gap-1">
                            <h3 class="text-lg font-bold leading-tight">House Keys</h3>
                            <p class="text-sm font-normal leading-normal text-secondary-light dark:text-secondary-dark">Secure your home</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 rounded-lg border border-border-light bg-card-light p-6 transition-transform hover:-translate-y-1 dark:border-border-dark dark:bg-card-dark">
                        <span class="material-symbols-outlined text-3xl text-primary">directions_car</span>
                        <div class="flex flex-col gap-1">
                            <h3 class="text-lg font-bold leading-tight">Vehicle Keys</h3>
                            <p class="text-sm font-normal leading-normal text-secondary-light dark:text-secondary-dark">Keys for every ride</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 rounded-lg border border-border-light bg-card-light p-6 transition-transform hover:-translate-y-1 dark:border-border-dark dark:bg-card-dark">
                        <span class="material-symbols-outlined text-3xl text-primary">phonelink_lock</span>
                        <div class="flex flex-col gap-1">
                            <h3 class="text-lg font-bold leading-tight">Digital Keys</h3>
                            <p class="text-sm font-normal leading-normal text-secondary-light dark:text-secondary-dark">Unlock with a tap</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 rounded-lg border border-border-light bg-card-light p-6 transition-transform hover:-translate-y-1 dark:border-border-dark dark:bg-card-dark">
                        <span class="material-symbols-outlined text-3xl text-primary">widgets</span>
                        <div class="flex flex-col gap-1">
                            <h3 class="text-lg font-bold leading-tight">Accessories</h3>
                            <p class="text-sm font-normal leading-normal text-secondary-light dark:text-secondary-dark">Keychains & more</p>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <h2 class="px-4 pb-4 pt-5 text-2xl font-bold leading-tight tracking-tight">New Arrivals</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="group relative flex flex-col overflow-hidden rounded-lg border border-border-light bg-card-light shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg dark:border-border-dark dark:bg-card-dark">
                        <img class="h-48 w-full object-cover" data-alt="A modern, sleek silver house key with a black fob." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1566oJ0-nZsuEC71lsLsDSyXQfL1gpvNzT9luR8dcWFyAWVgvMdHx3ow-e3gjVPM-VnmHA9Wfq_gbWV7NAQnTES_u4VgGOClpGRBhGvMeQgkGFgS4IO5mCvHGZwnHfW78Jte1A9rUb2gld-jBIcMtvSbuWFdBH4ujXQyP3o3XiMTbpujWS3-l7qee7vkFtonKFPYb1qCJ8_HEIEVevfQCLRcRNunEkUV_ajLI_VDkcpgIAj1C5GwxnrIHdAghZuGqp9uIqZY0HA" alt="Product Image"/>
                        <div class="flex flex-1 flex-col p-4">
                            <h3 class="flex-grow font-bold">Titan-Lock Pro</h3>
                            <p class="text-lg font-semibold text-text-light-primary dark:text-text-dark-primary">$39.99</p>
                        </div>
                        <button class="absolute bottom-4 right-4 flex h-10 w-10 translate-y-3 items-center justify-center rounded-full bg-primary text-white opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                        </button>
                    </div>
                    <div class="group relative flex flex-col overflow-hidden rounded-lg border border-border-light bg-card-light shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg dark:border-border-dark dark:bg-card-dark">
                        <img class="h-48 w-full object-cover" data-alt="A black car key fob with silver accents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBShsXNgQFA7Ye8TbXYKbmXDrW9CrEBecJTM-0N-4j26KPYmWr0H-TCAEB2EnUP8L68XDj5LYnwqEqKWrNLBB_RvVMncm4h7cg98fSe1ELnfgHMX9PKXdZciZhCk8oayx_5_WXUr6ycXa7g7Xs80rBd14xYsXJwZbdUmC3z5CPwVicMas4IAYPFogV5hpODcCfK0bMc-N3wT2ZMNvYGflARV1iiZZyc4xywv7hqw3YoJHkxypX_iEhYC1WwM3d3a40EaTqrMoL3Ww" alt="Product Image"/>
                        <div class="flex flex-1 flex-col p-4">
                            <h3 class="flex-grow font-bold">Auto-Key Gen 5</h3>
                            <p class="text-lg font-semibold text-text-light-primary dark:text-text-dark-primary">$129.50</p>
                        </div>
                        <button class="absolute bottom-4 right-4 flex h-10 w-10 translate-y-3 items-center justify-center rounded-full bg-primary text-white opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                        </button>
                    </div>
                    <div class="group relative flex flex-col overflow-hidden rounded-lg border border-border-light bg-card-light shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg dark:border-border-dark dark:bg-card-dark">
                        <img class="h-48 w-full object-cover" data-alt="A smartphone screen displaying a digital key interface." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBMi-muvPKdzWp0Y4c53-Fswvp0QBTq8MM5hnsb1D912eRgSpGWe-iI5zwxkDEKpZQszEJlHYHZLeIJFEj6etMTFppK8uSpD7vxgNsysyfK6_ohnoa5Wz1U8xFb18rJYPNhX9xXEoR4GR1FmOFQkQnBG_WZecSnHTIDIxrQcbf4Z1q1t40JvBgO8jjseNmmOqsRobJneuV1uApHorKKy7mCRYaKUA_2gLORaj45ZJBNYIan79LLtklYdsfE3W3VrMmCVYVjcgm41Q" alt="Product Image"/>
                        <div class="flex flex-1 flex-col p-4">
                            <h3 class="flex-grow font-bold">NFC Digi-Pass</h3>
                            <p class="text-lg font-semibold text-text-light-primary dark:text-text-dark-primary">$99.00</p>
                        </div>
                        <button class="absolute bottom-4 right-4 flex h-10 w-10 translate-y-3 items-center justify-center rounded-full bg-primary text-white opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                        </button>
                    </div>
                    <div class="group relative flex flex-col overflow-hidden rounded-lg border border-border-light bg-card-light shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg dark:border-border-dark dark:bg-card-dark">
                        <img class="h-48 w-full object-cover" data-alt="A stylish leather keychain with a silver clasp." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCo4Fpr8XcvccfnUaIoj-t-sirulZ--aYdkGtFZaW7qdA1eW6-E1XB4smO5S75EMnQ0YJaO-RVprmEFTf-QhfmSzwF23dVpfTS45Keio_87LmdxCL_wBwBmCCP7E_9HRCrcHJm4eCYDsA_FCf5OZokMF8bj3R_FAKy-fbDKGjatfC1UpaYllpSHBnKUl6ANKtFKHR6FbNnU339M7wBTXlMId9NlKAqMcSst_C8E1xjf3uKtvPleTC9YRJ02_irQATaTYCvuN_lbbw" alt="Product Image"/>
                        <div class="flex flex-1 flex-col p-4">
                            <h3 class="flex-grow font-bold">Leather Key Keeper</h3>
                            <p class="text-lg font-semibold text-text-light-primary dark:text-text-dark-primary">$24.99</p>
                        </div>
                        <button class="absolute bottom-4 right-4 flex h-10 w-10 translate-y-3 items-center justify-center rounded-full bg-primary text-white opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </section>
            <section class="flex flex-col items-center justify-between gap-6 rounded-lg bg-red-500/10 p-8 text-center dark:bg-primary/20 md:flex-row md:text-left">
                <div class="flex flex-col gap-2">
                    <h2 class="text-2xl font-bold leading-tight tracking-tight text-text-light-primary dark:text-text-dark-primary">Limited Time Offer</h2>
                    <p class="text-lg text-text-light-primary dark:text-text-dark-primary">Get <span class="font-bold text-primary">20% Off</span> All Digital Keys this week.</p>
                </div>
                <button class="flex h-12 w-full max-w-xs cursor-pointer items-center justify-center overflow-hidden rounded-lg bg-primary px-6 text-base font-bold text-white transition-transform hover:scale-105 md:w-auto">
                    Shop the Sale
                </button>
            </section>
            <section class="py-8 md:py-16">
                <div class="text-center">
                    <h2 class="text-3xl font-bold tracking-tight">What Our Customers Say</h2>
                    <p class="mt-2 text-lg text-secondary-light dark:text-secondary-dark">Real stories from satisfied Key Lanka users.</p>
                </div>
                <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <div class="rounded-lg border border-border-light bg-card-light p-6 shadow-sm dark:border-border-dark dark:bg-card-dark">
                        <div class="flex items-center gap-4">
                            <img alt="Customer avatar" class="h-12 w-12 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCycP8O3wSnpRocDkhEFGBhokUylcnKti0lKOt6M5zHSQmr2slxbhahSfTkG1hVZV6DG4_aRcpbkAzpGpd_Lubw-PGhNnEaIQTA-R42fSW4TPYlMQMvYIu4v2TvBhl2UyP7J_TFKdCYCn6zwxa6uKhw8N_3k9FjHdocwP_6Yx1eg7LnIRLbjywF9tiPZ2XinpNyQmLtijv2k6e5foZj_gTiEo1pEcEoCh6zL4GOszqveWs-EXXjp9YFO0qETJYr0rxcblhrHVPAew"/>
                            <div>
                                <p class="font-bold">Alex Johnson</p>
                                <p class="text-sm text-secondary-light dark:text-secondary-dark">Verified Buyer</p>
                            </div>
                        </div>
                        <p class="mt-4 italic text-text-light-primary dark:text-text-dark-primary">"The Titan-Lock Pro is a game-changer. Installation was a breeze and I feel so much more secure at home. Highly recommended!"</p>
                    </div>
                    <div class="rounded-lg border border-border-light bg-card-light p-6 shadow-sm dark:border-border-dark dark:bg-card-dark">
                        <div class="flex items-center gap-4">
                            <img alt="Customer avatar" class="h-12 w-12 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvXpskbX0jr_sUnUcNjHEI1rxcrL8c9I80H-satI5TxMBy2hG-kaJjAURhXh7fiWzjp2kG5-Tlih2fLK0kZc9GaqC4j7Fy3ZbfLkoS119fNPQO6panrjnlfM3oRKrQQrAJ8wOEyGQSp6i3MNcWqF_LFbu2v81l0H13-3uUwdGMZ5ae-qgT6zCFKjINmyebA_EDXBBIrziAUsKwDZSiNt-t3m6dnjKnafkq6KaAZ4Q_vWe0hd0jhEzNzvELWnlQ-RxnTq3fyYOjiA"/>
                            <div>
                                <p class="font-bold">Samantha Lee</p>
                                <p class="text-sm text-secondary-light dark:text-secondary-dark">Verified Buyer</p>
                            </div>
                        </div>
                        <p class="mt-4 italic text-text-light-primary dark:text-text-dark-primary">"I lost my car keys and Key Lanka had a replacement ready for me in no time. The Auto-Key Gen 5 works perfectly. Lifesavers!"</p>
                    </div>
                    <div class="rounded-lg border border-border-light bg-card-light p-6 shadow-sm dark:border-border-dark dark:bg-card-dark">
                        <div class="flex items-center gap-4">
                            <img alt="Customer avatar" class="h-12 w-12 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCmWWgNqNdCNeoPbC1MTKAkfJ31mPz8oMQP84tfAcMHT6rJehGKn_MBulSfCdOo2ALVexeGyJ4RwlGUsF7-Lx4MzmCyo0cmQ8i1ivzc1WOt3qwwR2ofn6IcO5MgroyDgWuq9UVSbGdZJVYIhGlsZIiOaz8Rwvsnc7JXnyHliR_IkS4hs9Fbw3HykulQrQ3nhPNSAJv15dKu6fQe3nOCNujUj9kppHA5WezRYeBKbLyNqTLtthNMj0AjtiByLcLhKjjtvNAT7KL8KQ"/>
                            <div>
                                <p class="font-bold">David Chen</p>
                                <p class="text-sm text-secondary-light dark:text-secondary-dark">Verified Buyer</p>
                            </div>
                        </div>
                        <p class="mt-4 italic text-text-light-primary dark:text-text-dark-primary">"Finally ditched my physical keys for the NFC Digi-Pass. It's so convenient to just use my phone. Welcome to the future!"</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer class="w-full border-t border-border-light bg-card-light dark:border-border-dark dark:bg-card-dark">
        <div class="container mx-auto grid max-w-6xl grid-cols-1 gap-8 px-4 py-12 md:grid-cols-4">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-2">
                    <svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path d="M44 4H30.6666V17.3334H17.3334V30.6666H4V44H44V4Z" fill="currentColor"></path>
                    </svg>
                    <h2 class="text-xl font-bold">Key Lanka</h2>
                </div>
                <p class="text-sm text-secondary-light dark:text-secondary-dark">Your access, secured and simplified.</p>
            </div>
            <div class="flex flex-col gap-2">
                <h4 class="font-bold">Quick Links</h4>
                <a class="text-sm text-secondary-light hover:text-primary dark:text-secondary-dark" href="#">About Us</a>
                <a class="text-sm text-secondary-light hover:text-primary dark:text-secondary-dark" href="#">Contact</a>
                <a class="text-sm text-secondary-light hover:text-primary dark:text-secondary-dark" href="#">FAQ</a>
            </div>
            <div class="flex flex-col gap-2">
                <h4 class="font-bold">Support</h4>
                <a class="text-sm text-secondary-light hover:text-primary dark:text-secondary-dark" href="#">Shipping & Returns</a>
                <a class="text-sm text-secondary-light hover:text-primary dark:text-secondary-dark" href="#">Terms & Conditions</a>
                <a class="text-sm text-secondary-light hover:text-primary dark:text-secondary-dark" href="#">Privacy Policy</a>
            </div>
            <div class="flex flex-col gap-4">
                <h4 class="font-bold">Join Our Newsletter</h4>
                <p class="text-sm text-secondary-light dark:text-secondary-dark">Get updates on new arrivals and special offers.</p>
                <div class="flex">
                    <input class="form-input w-full rounded-l-md border border-border-light bg-background-light focus:border-primary focus:ring-primary dark:border-border-dark dark:bg-background-dark" placeholder="Enter your email" type="email"/>
                    <button class="rounded-r-md bg-primary px-4 text-white hover:bg-opacity-90">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="border-t border-border-light py-4 text-center dark:border-border-dark">
            <p class="text-xs text-secondary-light dark:text-secondary-dark">© 2024 Key Lanka. All Rights Reserved.</p>
        </div>
    </footer>
</div>

<x-SideBarCart/>

<script src="js/Navbar.js"></script>
</body>
</html>
