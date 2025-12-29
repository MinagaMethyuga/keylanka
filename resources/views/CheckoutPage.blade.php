<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>

    <!-- CSRF and route meta -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="verify-email-route" content="{{ route('verify.email') }}">
    <meta name="verify-code-route" content="{{ route('verify.code') }}">

    <title>Key Lanka Checkout Page</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1" rel="stylesheet"/>

    <!-- PayHere JS SDK -->
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <!-- Content Security Policy -->
    <meta http-equiv="Content-Security-Policy"
          content="
              script-src 'self' https://www.payhere.lk https://sandbox.payhere.lk https://sandbox.payhere.lk/pay/resources/js/ 'unsafe-inline' 'unsafe-eval' blob:;
              style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.gstatic.com;
              connect-src 'self' https://sandbox.payhere.lk https://www.payhere.lk;
          ">

    <!-- Tailwind configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#f42525",
                        "brand-red": "#f42525",
                        "brand-black": "#111827",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
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

    <!-- Custom styles -->
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        /* Loading overlay styles */
        #loadingOverlay {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* Spinner animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .spinner {
            border: 4px solid rgba(244, 37, 37, 0.2);
            border-top: 4px solid #f42525;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        /* Pulse animation for dots */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .dot-1 { animation: pulse 1.4s infinite 0s; }
        .dot-2 { animation: pulse 1.4s infinite 0.2s; }
        .dot-3 { animation: pulse 1.4s infinite 0.4s; }

        /* Fade in animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        /* Checkmark animation */
        @keyframes checkmark {
            0% {
                stroke-dashoffset: 100;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }

        .checkmark-circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            animation: checkmark 0.6s ease-in-out 0.3s forwards;
        }

        .checkmark-check {
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: checkmark 0.3s ease-in-out 0.9s forwards;
        }
    </style>
</head>

<body class="font-display bg-white text-brand-black">
<!-- Loading Overlay -->
<div id="loadingOverlay" class="hidden fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center fade-in">
    <div class="text-center">
        <!-- Spinner -->
        <div class="flex justify-center mb-6">
            <div class="spinner"></div>
        </div>

        <!-- Success checkmark (hidden initially) -->
        <div id="successCheck" class="hidden mb-6">
            <svg class="w-20 h-20 mx-auto" viewBox="0 0 52 52">
                <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="#f42525" stroke-width="2"/>
                <path class="checkmark-check" fill="none" stroke="#f42525" stroke-width="2" d="M14 27l7.5 7.5L38 18"/>
            </svg>
        </div>

        <!-- Loading text -->
        <h2 id="loadingTitle" class="text-white text-2xl font-bold mb-3">
            Processing Your Payment
        </h2>
        <p id="loadingMessage" class="text-gray-300 text-base mb-4">
            Please wait while we confirm your order
        </p>

        <!-- Animated dots -->
        <div class="flex justify-center gap-2">
            <span class="dot-1 w-2 h-2 bg-brand-red rounded-full inline-block"></span>
            <span class="dot-2 w-2 h-2 bg-brand-red rounded-full inline-block"></span>
            <span class="dot-3 w-2 h-2 bg-brand-red rounded-full inline-block"></span>
        </div>

        <!-- Warning message -->
        <div class="mt-6 flex items-center justify-center gap-2 text-yellow-400 text-sm">
            <span class="material-symbols-outlined text-lg">info</span>
            <p>Please do not close or refresh this page</p>
        </div>
    </div>
</div>

<div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-col">
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8 md:py-12">
            <div class="max-w-7xl mx-auto">
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <h1 class="text-4xl font-black leading-tight tracking-[-0.033em] text-brand-black">Checkout</h1>
                        <p class="cursor-pointer relative text-black after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-[2px] after:bg-red-500 after:transition-all after:duration-300 hover:text-red-500 hover:after:w-full">
                            Cancel Checkout
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2 mt-4">
                        <span class="text-brand-red text-base font-medium leading-normal">Shipping</span>
                        <span class="text-gray-400 text-base font-medium leading-normal">/</span>
                        <a class="text-gray-400 hover:text-brand-red text-base font-medium leading-normal" href="#">Payment</a>
                        <span class="text-gray-400 text-base font-medium leading-normal">/</span>
                        <a class="text-gray-400 hover:text-brand-red text-base font-medium leading-normal" href="#">Confirmation</a>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <div class="lg:col-span-2">
                        <div class="space-y-10">
                            <form id="checkoutForm">
                                @csrf
                                <section>
                                    <h2 class="text-2xl font-bold leading-tight tracking-[-0.015em] pb-4 border-b border-gray-200 text-brand-black">1. Contact Information</h2>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5 pt-6">
                                        <div>
                                            <label class="flex flex-col w-full">
                                                <p class="text-base font-medium leading-normal pb-2 text-brand-black">First Name</p>
                                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-brand-black focus:outline-0 focus:ring-2 focus:ring-brand-red/50 border border-gray-300 bg-white focus:border-brand-red h-12 placeholder:text-gray-400 p-3 text-base font-normal leading-normal" placeholder="Enter your first name" value="" name="first_name"/>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="flex flex-col w-full">
                                                <p class="text-base font-medium leading-normal pb-2 text-brand-black">Last Name</p>
                                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-brand-black focus:outline-0 focus:ring-2 focus:ring-brand-red/50 border border-gray-300 bg-white focus:border-brand-red h-12 placeholder:text-gray-400 p-3 text-base font-normal leading-normal" placeholder="Enter your last name" value="" name="last_name"/>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="flex flex-col w-full">
                                                <p class="text-base font-medium pb-2">Email Address</p>

                                                <div id="emailSection" class="flex gap-2">
                                                    <input
                                                        id="emailInput"
                                                        class="form-input w-full rounded-lg border-gray-300"
                                                        placeholder="you@example.com"
                                                        name="email"
                                                        type="email"
                                                        oninput="checkEmail()"
                                                    />

                                                    <button
                                                        id="verifyBtn"
                                                        type="button"
                                                        onclick="verifyEmail()"
                                                        class="px-4 rounded-lg hover:bg-gray-300 bg-gray-200 text-gray-500 cursor-not-allowed min-w-[90px] flex items-center justify-center"
                                                        disabled
                                                    >
                                                        <span id="verifyBtnText">Verify</span>
                                                        <svg id="verifySpinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                        <svg id="verifyCheck" class="hidden h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div id="codeSection" class="hidden gap-2">
                                                    <input id="codeInput" class="form-input w-full rounded-lg border-gray-300" placeholder="Enter code"/>

                                                    <button type="button" onclick="verifyCode()" class="px-4 bg-primary rounded-lg text-white">
                                                        Submit
                                                    </button>
                                                </div>

                                                <p id="verifyMessage" class="text-sm mt-2 text-red-500 hidden"></p>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="flex flex-col w-full">
                                                <p class="text-base font-medium leading-normal pb-2 text-brand-black">Phone Number</p>
                                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-brand-black focus:outline-0 focus:ring-2 focus:ring-brand-red/50 border border-gray-300 bg-white focus:border-brand-red h-12 placeholder:text-gray-400 p-3 text-base font-normal leading-normal" placeholder="(123) 456-7890" type="tel" value="" name="phone_number"/>
                                            </label>
                                        </div>
                                    </div>
                                </section>
                                <section class="pt-10">
                                    <h2 class="text-2xl font-bold leading-tight tracking-[-0.015em] pb-4 border-b border-gray-200 text-brand-black">2. Shipping Address</h2>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5 pt-6">
                                        <div class="sm:col-span-2">
                                            <label class="flex flex-col w-full">
                                                <p class="text-base font-medium leading-normal pb-2 text-brand-black">Street Address</p>
                                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-brand-black focus:outline-0 focus:ring-2 focus:ring-brand-red/50 border border-gray-300 bg-white focus:border-brand-red h-12 placeholder:text-gray-400 p-3 text-base font-normal leading-normal" placeholder="123 Example Street" value="" name="address"/>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="flex flex-col w-full">
                                                <p class="text-base font-medium leading-normal pb-2 text-brand-black">City</p>
                                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-brand-black focus:outline-0 focus:ring-2 focus:ring-brand-red/50 border border-gray-300 bg-white focus:border-brand-red h-12 placeholder:text-gray-400 p-3 text-base font-normal leading-normal" placeholder="Colombo 7" value="" name="city"/>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="flex flex-col w-full">
                                                <p class="text-base font-medium leading-normal pb-2 text-brand-black">State / Province</p>
                                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-brand-black focus:outline-0 focus:ring-2 focus:ring-brand-red/50 border border-gray-300 bg-white focus:border-brand-red h-12 placeholder:text-gray-400 p-3 text-base font-normal leading-normal" placeholder="Western Province" value="" name="state"/>
                                            </label>
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="flex flex-col w-full">
                                                <p class="text-base font-medium leading-normal pb-2 text-brand-black">Zip / Postal Code</p>
                                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-brand-black focus:outline-0 focus:ring-2 focus:ring-brand-red/50 border border-gray-300 bg-white focus:border-brand-red h-12 placeholder:text-gray-400 p-3 text-base font-normal leading-normal" placeholder="10001" value="" name="zip_code"/>
                                            </label>
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="flex flex-col w-full">
                                                <p class="text-base font-medium leading-normal pb-2 text-brand-black">Delivery Instructions <span class="text-sm text-gray-500">(Optional)</span></p>
                                                <textarea class="form-textarea flex w-full min-w-0 flex-1 resize-y overflow-hidden rounded-lg text-brand-black focus:outline-0 focus:ring-2 focus:ring-brand-red/50 border border-gray-300 bg-white focus:border-brand-red min-h-24 placeholder:text-gray-400 p-3 text-base font-normal leading-normal" placeholder="e.g. Leave package at the front door." name="delivery_instructions"></textarea>
                                            </label>
                                        </div>
                                    </div>
                                </section>
                                <div class="flex items-start gap-3 rounded-lg bg-blue-50 border border-blue-200 p-4 mt-5">
                                    <span class="material-symbols-outlined text-blue-600 mt-0.5">shield</span>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-blue-900">Your payment is secure</p>
                                        <p class="text-xs text-blue-700 mt-1">Your card information is encrypted and processed securely by PayHere. We never store your card details.</p>
                                    </div>
                                </div>
                                <div class="pt-5">
                                    <button
                                        type="submit"
                                        id="payhere-payment"
                                        class="flex w-full sm:w-auto items-center justify-center rounded-lg bg-brand-red px-8 py-3.5 text-base font-bold text-white shadow-[0_4px_14px_0_rgb(244,37,37,0.3)] hover:bg-brand-red/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-red transition-colors">
                                        Proceed to Payment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--Side Cart Preview-->
                    <div class="lg:col-span-1">
                        <div class="sticky top-8 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                            <h3 class="text-xl font-bold mb-6 text-brand-black">Your Order</h3>

                            <div id="orderItems" class="space-y-4"></div>

                            <div class="mt-6 pt-6 border-t border-gray-200 space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Subtotal</span>
                                    <span id="subtotal" class="font-medium text-brand-black">LKR 0.00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Shipping</span>
                                    <span id="shipping" class="font-medium text-brand-black">LKR 0.00</span>
                                </div>
                                <div class="flex justify-between pt-3 text-base font-bold text-brand-black">
                                    <span>Total</span>
                                    <span id="total">LKR 0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
        <footer class="border-t border-gray-200 text-center py-6 px-4">
            <p class="text-sm text-gray-500">© 2024 Key Lanka. All rights reserved. <a class="hover:text-brand-red" href="#">Privacy Policy</a> · <a class="hover:text-brand-red" href="#">Terms of Service</a></p>
        </footer>
    </div>
</div>

<!-- External JavaScript -->
<script src="{{ asset('js/checkout-verification.js') }}"></script>
<script>
    // Function to show loading overlay
    function showLoadingOverlay() {
        const overlay = document.getElementById('loadingOverlay');
        overlay.classList.remove('hidden');

        // Prevent page scrolling
        document.body.style.overflow = 'hidden';
    }

    // Function to update loading state to success
    function showSuccessState() {
        const spinner = document.querySelector('.spinner');
        const successCheck = document.getElementById('successCheck');
        const loadingTitle = document.getElementById('loadingTitle');
        const loadingMessage = document.getElementById('loadingMessage');

        // Hide spinner
        spinner.style.display = 'none';

        // Show success checkmark
        successCheck.classList.remove('hidden');

        // Update text
        loadingTitle.textContent = 'Payment Successful!';
        loadingMessage.textContent = 'Redirecting to confirmation page...';
    }

    // Function to hide loading overlay
    function hideLoadingOverlay() {
        const overlay = document.getElementById('loadingOverlay');
        overlay.classList.add('hidden');

        // Re-enable page scrolling
        document.body.style.overflow = 'auto';
    }

    document.getElementById('payhere-payment').onclick = async function(e) {
        e.preventDefault();

        // Validate form before proceeding
        if (!validateForm()) {
            return;
        }

        const form = document.getElementById('checkoutForm');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const totalText = document.getElementById("total").innerText;
        const totalAmount = parseFloat(totalText.replace(/[^0-9.-]+/g, "")) || 0;
        const formattedAmount = totalAmount.toFixed(2);

        // Get cart items from localStorage
        let cartItems = [];
        try {
            const cartData = localStorage.getItem('cart');
            if (cartData) {
                cartItems = JSON.parse(cartData);
            }
        } catch (error) {
            console.error('Error reading cart from localStorage:', error);
        }

        const requestData = {
            first_name: form.first_name.value,
            last_name: form.last_name.value,
            email: form.email.value,
            phone: form.phone_number.value,
            address: form.address.value,
            city: form.city.value,
            state: form.state.value,
            zip_code: form.zip_code.value,
            delivery_instructions: form.delivery_instructions.value || '',
            items: cartItems,
            amount: formattedAmount,
            currency: 'LKR',
        };

        try {
            const response = await fetch("/checkoutpay", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify(requestData)
            });

            const data = await response.json();

            const payment = {
                sandbox: true,
                merchant_id: data.merchantId,
                return_url: window.location.href,
                cancel_url: window.location.href,
                notify_url: "https://subintentional-corinne-componental.ngrok-free.dev/payhere-notify",
                order_id: data.orderId,
                items: data.items,
                amount: data.amount,
                currency: data.currency,
                hash: data.hash,
                first_name: data.first_name,
                last_name: data.last_name,
                email: data.email,
                phone: data.phone,
                address: data.address,
                city: data.city,
                country: "Sri Lanka",
                delivery_address: data.address,
                delivery_city: data.city,
                delivery_country: "Sri Lanka"
            };

            payhere.startPayment(payment);

            payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. OrderID:" + orderId);

                // Show loading overlay immediately
                showLoadingOverlay();

                // Update to success state after a short delay
                setTimeout(() => {
                    showSuccessState();
                }, 500);

                // Clear cart and redirect
                localStorage.removeItem('cart');

                // Redirect after showing success
                setTimeout(() => {
                    window.location.href = `/payment/return?order_id=${orderId}`;
                }, 2000);
            };

            payhere.onDismissed = function onDismissed() {
                console.log("Payment dismissed");
                hideLoadingOverlay();
            };

            payhere.onError = function(error) {
                console.error("Payment error:", error);
                hideLoadingOverlay();
                alert("Payment failed: " + error);
            };

        } catch (err) {
            console.error(err);
            hideLoadingOverlay();
            alert("Payment initialization failed.");
        }
    };

    // Prevent back button during loading
    window.addEventListener('popstate', function(event) {
        const overlay = document.getElementById('loadingOverlay');
        if (!overlay.classList.contains('hidden')) {
            event.preventDefault();
            window.history.pushState(null, '', window.location.href);
        }
    });
</script>
</body>
</html>
