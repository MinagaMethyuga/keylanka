<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - Key Lanka</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <style>
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
<body class="font-display bg-background-light dark:bg-background-dark text-[#1A1A1A] dark:text-gray-200">
<div class="relative flex min-h-screen w-full flex-col items-center justify-center overflow-x-hidden p-4 sm:p-6">
    <div class="absolute inset-0 z-0 opacity-5 dark:opacity-10">
        <svg height="100%" width="100%" xmlns="http://www.w3.org/2000/svg"><defs><pattern height="20" id="dotted-pattern" patternunits="userSpaceOnUse" width="20" x="0" y="0"><circle cx="2" cy="2" fill="#1A1A1A" r="1"></circle></pattern></defs><rect fill="url(#dotted-pattern)" height="100%" width="100%" x="0" y="0"></rect></svg>
    </div>
    <main class="relative z-10 flex w-full max-w-md flex-col items-center">
        <header class="mb-8 flex flex-col items-center gap-4 text-center">
            <div class="flex items-center gap-3 text-[#1A1A1A] dark:text-gray-100">
                <div class="w-12 h-12">
                    <img src="{{asset('Assets/logo.jpg')}}" alt="Key Lanka Logo" class="w-full h-full object-contain rounded-xl"/>
                </div>
                <h1 class="text-3xl font-bold leading-tight tracking-tighter">Key Lanka</h1>
            </div>
        </header>
        <div class="w-full rounded-xl border border-gray-200/50 bg-background-light/80 p-6 shadow-lg backdrop-blur-sm dark:border-gray-700/50 dark:bg-background-dark/80 sm:p-8">
            <div class="mb-6">
                <p class="text-2xl font-bold leading-tight tracking-tight text-[#1A1A1A] dark:text-gray-100 sm:text-3xl">Log In to Your Account</p>
            </div>
            <form class="flex flex-col gap-6" method="POST" action="{{ route('login.store') }}">
                @csrf
                <label class="flex flex-col">
                    <p class="pb-2 text-sm font-medium leading-normal text-[#1A1A1A] dark:text-gray-300">Email</p>
                    <input class="form-input h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-gray-300 bg-background-light p-3 text-base font-normal leading-normal text-[#1A1A1A] placeholder:text-gray-500/80 focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/30 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder:text-gray-400/80"
                           placeholder="Enter your email"
                           type="email"
                           name="email"
                           value=""
                           id="email"
                    />
                </label>
                <label class="flex flex-col">
                    <div class="flex items-baseline justify-between">
                        <p class="pb-2 text-sm font-medium leading-normal text-[#1A1A1A] dark:text-gray-300">Password</p>
                        <a class="text-sm font-normal leading-normal text-primary hover:underline" href="#">Forgot Password?</a>
                    </div>
                    <div class="flex w-full flex-1 items-stretch">
                        <input class="form-input h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-l-lg border border-r-0 border-gray-300 bg-background-light p-3 text-base font-normal leading-normal text-[#1A1A1A] placeholder:text-gray-500/80 focus:z-10 focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/30 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder:text-gray-400/80"
                               placeholder="Enter your password"
                               type="password"
                               name="password"
                               value=""
                               id="password"
                        />
                        <button class="flex items-center justify-center rounded-r-lg border border-l-0 border-gray-300 bg-background-light px-3 text-gray-500/80 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400/80"
                                type="button"
                                onclick="togglePassword('password', this)">
                            <span class="material-symbols-outlined" data-icon="Eye" data-size="24px" data-weight="regular">visibility</span>
                        </button>
                    </div>
                </label>
                <button class="flex h-12 w-full items-center justify-center rounded-lg bg-primary px-6 py-3 text-base font-bold text-white shadow-md transition-all hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 focus:ring-offset-background-light dark:focus:ring-offset-background-dark">Login</button>
            </form>
{{--            <div class="mt-8 text-center">--}}
{{--                <p class="text-sm text-gray-600 dark:text-gray-400">--}}
{{--                    Need an account?--}}
{{--                    <a class="font-bold text-primary hover:underline" href="{{route('register')}}">Sign Up</a>--}}
{{--                </p>--}}
{{--            </div>--}}
        </div>
    </main>
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
