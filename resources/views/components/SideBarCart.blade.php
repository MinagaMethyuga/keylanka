<div id="CartOverlay" class="hidden w-full h-screen fixed top-0 left-0 bg-black/75 z-50 opacity-0 transition-opacity duration-300 ease-out">
    <div id="CartPanel" class="w-full max-w-[600px] md:w-2/3 lg:w-1/2 xl:w-1/3 h-[97vh] bg-white fixed right-0 md:right-2 top-1/2 -translate-y-1/2 rounded-none md:rounded-lg flex flex-col translate-x-full shadow-2xl" style="transition: transform 500ms cubic-bezier(0.68, -0.55, 0.265, 1.55);">
        <!-- Top Header -->
        <div class="w-[85%] mx-auto flex justify-between items-center mt-5">
            <h1 class="font-bold text-2xl text-text-light-primary dark:text-text-dark-primary">Cart</h1>
            <button id="CloseCart" class="flex items-center justify-center hover:bg-border-light dark:hover:bg-border-dark rounded-full p-2 transition-colors duration-200">
                <span class="material-symbols-outlined text-text-light-primary dark:text-text-dark-primary">close</span>
            </button>
        </div>

        <!-- Scrollable Items Section -->
        <div class="flex-1 mt-5 overflow-y-auto px-6 md:px-12 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200 dark:scrollbar-thumb-gray-600 dark:scrollbar-track-gray-800">
            <div class="space-y-5" id="CartItems">
                <!-- Cart items will be dynamically added here by JavaScript -->
            </div>
        </div>

        <!-- Bottom Panel -->
        <div class="w-full border-t border-border-light dark:border-border-dark flex select-none">
            <div class="w-[85%] mx-auto">
                <div class="w-full flex justify-between py-2 mt-5">
                    <h1 class="font-bold text-text-light-primary dark:text-text-dark-primary text-2xl">Total</h1>
                    <h1 id="CartTotal" class="font-bold text-text-light-primary dark:text-text-dark-primary text-2xl">LKR 0.00</h1>
                </div>
                <p class="text-sm text-secondary-light dark:text-secondary-dark">
                    *Taxes and shipping calculated at checkout*
                </p>
                <button id="ProceedToCheckoutBtn" class="w-full mb-5 mt-8 h-12 bg-primary text-white rounded-lg hover:bg-red-700 dark:hover:bg-red-500 flex items-center justify-center transition-colors duration-200">
                    <span class="font-bold text-lg">Checkout</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="js/Cart.js"></script>
