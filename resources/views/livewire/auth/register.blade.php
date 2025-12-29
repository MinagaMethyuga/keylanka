<!DOCTYPE html>

<html class="light" lang="en"><head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Key Lanka - Register</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style type="text/tailwindcss">
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
</head>
<body class="font-display">
<div class="relative flex min-h-screen w-full flex-col items-center bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden text-[#1A1A1A] dark:text-gray-200">
    <div class="w-full max-w-7xl px-4 md:px-8">
        <header class="flex items-center justify-between whitespace-nowrap py-6">
            <div class="w-12 h-12">
                <img src="{{asset('Assets/logo.jpg')}}" alt="Key Lanka Logo" class="w-full h-full object-contain rounded-xl"/>
            </div>
            <div class="flex items-center gap-2">
                <span class="hidden sm:inline text-sm text-gray-600 dark:text-gray-400 select-none">Already have an account?</span>
                <a class="flex max-w-xs cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary/20 dark:bg-primary/30 text-primary gap-2 text-sm font-bold leading-normal tracking-wide min-w-0 px-4" href="{{route('login')}}">
                    <span>Log in</span>
                </a>
            </div>
        </header>
    </div>
    <main class="flex flex-1 items-center justify-center w-full px-4 py-12 md:py-20">
        <div class="w-full max-w-md mx-auto">
            <div class="flex flex-col gap-8 rounded-xl bg-white dark:bg-background-dark/50 shadow-sm border border-gray-200 dark:border-gray-700 p-8 md:p-10">
                <div class="flex flex-col gap-2 text-center">
                    <h1 class="text-[#1A1A1A] dark:text-white text-3xl font-bold tracking-tight">Create Your Key Lanka Account</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-base font-normal leading-normal">Join us to manage your digital and physical keys seamlessly.</p>
                </div>
                <form class="flex flex-col gap-6" method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="flex flex-col">
                        <label class="text-[#1A1A1A] dark:text-gray-200 text-sm font-medium leading-normal pb-2" for="full-name">Full Name</label>
                        <input
                                class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1A1A1A] dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 px-4 text-base font-normal leading-normal"
                               id="name"
                               name="name"
                               placeholder="Enter your full name"
                               type="text"
                        />
                    </div>
                    <div class="flex flex-col">
                        <label class="text-[#1A1A1A] dark:text-gray-200 text-sm font-medium leading-normal pb-2" for="email">Email Address</label>
                        <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1A1A1A] dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 px-4 text-base font-normal leading-normal"
                               id="email"
                               name="email"
                               placeholder="you@example.com"
                               type="email"
                        />
                    </div>
                    <div class="flex flex-col">
                        <label class="text-[#1A1A1A] dark:text-gray-200 text-sm font-medium leading-normal pb-2" for="password">Password</label>
                        <div class="relative flex w-full flex-1 items-stretch">
                            <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg rounded-r-none border-r-0 text-[#1A1A1A] dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 focus:z-10 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 px-4 text-base font-normal leading-normal"
                                   id="password"
                                   name="password"
                                   placeholder="Create a secure password"
                                   type="password"/>

                            <button class="flex items-center justify-center px-4 rounded-r-lg border border-l-0 border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary"
                                    type="button"
                                    onclick="togglePassword('password', this)">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[#1A1A1A] dark:text-gray-200 text-sm font-medium leading-normal pb-2" for="password_confirmation">Confirm Password</label>
                        <div class="relative flex w-full flex-1 items-stretch">
                            <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg rounded-r-none border-r-0 text-[#1A1A1A] dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 focus:z-10 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 px-4 text-base font-normal leading-normal"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Confirm your password"
                                   type="password"/>

                            <button class="flex items-center justify-center px-4 rounded-r-lg border border-l-0 border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary"
                                    type="button"
                                    onclick="togglePassword('password_confirmation', this)">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </div>
                    </div>
                    <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-primary text-white gap-2 text-base font-bold leading-normal tracking-wide hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50 focus:ring-offset-background-light dark:focus:ring-offset-background-dark" type="submit">
                        Register
                    </button>
                </form>
                <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                    Already have an account? <a class="font-semibold text-primary hover:underline" href="{{route('login')}}">Log in</a>
                </p>
            </div>
        </div>
    </main>
    <footer class="w-full max-w-7xl px-4 md:px-8 py-6 mt-auto">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-gray-200 dark:border-gray-700 pt-6">
            <p class="text-sm text-gray-500 dark:text-gray-400">© 2024 Key Lanka. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a class="text-sm text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary" href="#">Terms of Service</a>
                <a class="text-sm text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary" href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>
</div>

<script>
    /**
     * Toggles the visibility of a password input field and updates the button icon.
     * @param {string} inputId - The ID of the password input field.
     * @param {HTMLElement} button - The button element that was clicked.
     */
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('.material-symbols-outlined');

        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>

</body>
</html>
