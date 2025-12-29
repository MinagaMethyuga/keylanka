// Cart.js - Shopping Cart Toggle with Full Functionality

document.addEventListener('DOMContentLoaded', function() {
    const cartButton = document.getElementById('CartButton');
    const mobileCartButton = document.getElementById('MobileCartButton');
    const cartOverlay = document.getElementById('CartOverlay');
    const cartPanel = document.getElementById('CartPanel');
    const closeCartButton = document.getElementById('CloseCart');
    const cartItemsContainer = document.getElementById('CartItems');
    const cartTotalElement = document.getElementById('CartTotal');
    const cartCountElement = document.getElementById('CartCount');
    const mobileCartCountElement = document.getElementById('MobileCartCount');

    // Initialize cart from localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Update cart display on page load
    updateCartDisplay();

    // Open cart function
    function openCart() {
        // Show overlay first
        cartOverlay.classList.remove('hidden');
        cartOverlay.classList.add('flex');

        // Force reflow to ensure transition works
        cartOverlay.offsetHeight;

        // Fade in overlay
        cartOverlay.classList.remove('opacity-0');
        cartOverlay.classList.add('opacity-100');

        // After a brief delay, slide in the cart panel
        setTimeout(() => {
            cartPanel.classList.remove('translate-x-full');
            cartPanel.classList.add('translate-x-0');
        }, 150);

        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    // Open cart - Desktop
    if (cartButton) {
        cartButton.addEventListener('click', openCart);
    }

    // Open cart - Mobile
    if (mobileCartButton) {
        mobileCartButton.addEventListener('click', openCart);
    }

    // Close cart function
    function closeCart() {
        // Slide out panel first
        cartPanel.classList.remove('translate-x-0');
        cartPanel.classList.add('translate-x-full');

        // Fade out overlay
        cartOverlay.classList.remove('opacity-100');
        cartOverlay.classList.add('opacity-0');

        // After animation completes, hide completely
        setTimeout(() => {
            cartOverlay.classList.remove('flex');
            cartOverlay.classList.add('hidden');
        }, 300);

        // Restore body scroll
        document.body.style.overflow = '';
    }

    // Close cart on button click
    if (closeCartButton) {
        closeCartButton.addEventListener('click', closeCart);
    }

    // Close cart when clicking on overlay (outside the cart panel)
    if (cartOverlay) {
        cartOverlay.addEventListener('click', function(e) {
            if (e.target === cartOverlay) {
                closeCart();
            }
        });
    }

    // Add to cart functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.add-to-cart-btn')) {
            const button = e.target.closest('.add-to-cart-btn');
            const productCard = button.closest('[data-product-id]');

            if (productCard) {
                const product = {
                    id: productCard.dataset.productId,
                    title: productCard.dataset.productTitle,
                    price: parseFloat(productCard.dataset.productPrice),
                    image: productCard.dataset.productImage,
                    quantity: 1
                };

                addToCart(product);
            }
        }
    });

    // Add to cart function
    function addToCart(product) {
        const existingItem = cart.find(item => item.id === product.id);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push(product);
        }

        saveCart();
        updateCartDisplay();

        // Show a brief success indication
        showAddedToCartFeedback();
    }

    // Remove from cart
    function removeFromCart(productId) {
        cart = cart.filter(item => item.id !== productId);
        saveCart();
        updateCartDisplay();
    }

    // Update quantity
    function updateQuantity(productId, newQuantity) {
        const item = cart.find(item => item.id === productId);
        if (item) {
            if (newQuantity <= 0) {
                removeFromCart(productId);
            } else {
                item.quantity = newQuantity;
                saveCart();
                updateCartDisplay();
            }
        }
    }

    // Save cart to localStorage
    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    // Update cart display
    function updateCartDisplay() {
        if (!cartItemsContainer) return;

        // Clear current items
        cartItemsContainer.innerHTML = '';

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <span class="material-symbols-outlined text-6xl text-gray-300 dark:text-gray-600 mb-4">shopping_cart</span>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">Your cart is empty</p>
                </div>
            `;
            updateCartTotal();
            return;
        }

        // Add each item
        cart.forEach(item => {
            const itemElement = createCartItemElement(item);
            cartItemsContainer.appendChild(itemElement);
        });

        // Update total
        updateCartTotal();
    }

    // Create cart item element
    function createCartItemElement(item) {
        const div = document.createElement('div');
        div.className = 'w-full h-28 flex items-center justify-between rounded-lg';
        div.innerHTML = `
            <!-- Image + Details -->
            <div class="flex items-center gap-2">
                <div class="h-28 w-32">
                    <img src="${item.image}"
                         alt="${item.title}"
                         class="h-full w-full object-contain rounded-2xl"
                    />
                </div>
                <div class="flex flex-col">
                    <h1 class="font-bold text-lg text-text-light-primary dark:text-text-dark-primary">${item.title}</h1>
                    <h1 class="font-regular text-gray-500 dark:text-gray-400 text-sm">Rs ${item.price.toFixed(2)} LKR</h1>
                </div>
            </div>

            <!-- Quantity + Remove -->
            <div class="h-28 w-[55px] flex flex-col justify-center gap-2">
                <input type="text"
                       value="${item.quantity}"
                       data-product-id="${item.id}"
                       class="quantity-input w-full h-12 text-center rounded-lg border border-gray-300 dark:border-gray-600 hover:border-gray-400 dark:hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-primary font-medium bg-background-light dark:bg-background-dark text-text-light-primary dark:text-text-dark-primary"/>
                <h1 class="remove-item relative cursor-pointer text-sm inline-block text-text-light-primary dark:text-text-dark-primary after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[1px] after:bg-current after:w-full after:origin-left after:scale-x-100 after:transition-transform after:duration-300 hover:after:scale-x-0 hover:text-primary"
                    data-product-id="${item.id}">
                    Remove
                </h1>
            </div>
        `;

        // Add event listeners
        const quantityInput = div.querySelector('.quantity-input');
        const removeButton = div.querySelector('.remove-item');

        quantityInput.addEventListener('change', function() {
            const newQty = parseInt(this.value);
            if (isNaN(newQty) || newQty < 1) {
                this.value = item.quantity;
                return;
            }
            updateQuantity(item.id, newQty);
        });

        removeButton.addEventListener('click', function() {
            removeFromCart(item.id);
        });

        return div;
    }

    // Update cart total
    function updateCartTotal() {
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const itemCount = cart.reduce((sum, item) => sum + item.quantity, 0);

        if (cartTotalElement) {
            cartTotalElement.textContent = `LKR ${total.toFixed(2)}`;
        }

        // Update desktop cart count badge
        if (cartCountElement) {
            if (itemCount > 0) {
                cartCountElement.textContent = itemCount;
                cartCountElement.classList.remove('hidden');
            } else {
                cartCountElement.classList.add('hidden');
            }
        }

        // Update mobile cart count badge
        if (mobileCartCountElement) {
            if (itemCount > 0) {
                mobileCartCountElement.textContent = itemCount;
                mobileCartCountElement.classList.remove('hidden');
            } else {
                mobileCartCountElement.classList.add('hidden');
            }
        }
    }

    // Show feedback when item is added
    function showAddedToCartFeedback() {
        // Create a temporary notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-20 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-slide-in';
        notification.innerHTML = `
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                <span>Added to cart!</span>
            </div>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            notification.style.transition = 'all 0.3s ease-out';
            setTimeout(() => notification.remove(), 300);
        }, 2000);
    }

    document.getElementById('ProceedToCheckoutBtn').addEventListener('click', function (){
        const  finalAmount= document.getElementById('CartTotal').innerHTML;
        localStorage.setItem('finalAmount', finalAmount);
        window.location.href = '/checkout';
    });
});
