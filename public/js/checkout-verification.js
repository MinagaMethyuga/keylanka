function checkEmail() {
    const emailInput = document.getElementById('emailInput');
    const verifyBtn = document.getElementById('verifyBtn');

    // Simple email regex for validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailRegex.test(emailInput.value)) {
        verifyBtn.disabled = false;
        verifyBtn.classList.remove('bg-gray-200', 'text-gray-500', 'cursor-not-allowed');
        verifyBtn.classList.add('bg-gray-400', 'text-white', 'cursor-pointer');
    } else {
        verifyBtn.disabled = true;
        verifyBtn.classList.add('bg-gray-200', 'text-gray-500', 'cursor-not-allowed');
        verifyBtn.classList.remove('bg-gray-400', 'text-white', 'cursor-pointer');
    }
}

function verifyEmail() {
    const email = document.getElementById('emailInput').value;
    const firstName = document.querySelector('input[name="first_name"]').value;
    const lastName = document.querySelector('input[name="last_name"]').value;
    const name = `${firstName} ${lastName}`.trim();

    const messageEl = document.getElementById('verifyMessage');
    const verifyBtn = document.getElementById('verifyBtn');
    const verifyBtnText = document.getElementById('verifyBtnText');
    const verifySpinner = document.getElementById('verifySpinner');
    const verifyCheck = document.getElementById('verifyCheck');
    const codeSection = document.getElementById('codeSection');
    const emailSection = document.getElementById('emailSection');

    // Get CSRF token and route from meta tags
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const verifyEmailRoute = document.querySelector('meta[name="verify-email-route"]').getAttribute('content');

    // Show loading state
    verifyBtn.disabled = true;
    verifyBtnText.classList.add('hidden');
    verifySpinner.classList.remove('hidden');
    verifyBtn.classList.remove('bg-gray-400', 'hover:bg-gray-300');
    verifyBtn.classList.add('bg-gray-400', 'cursor-not-allowed');

    fetch(verifyEmailRoute, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            email: email,
            name: name
        })
    })
        .then(res => res.json())
        .then(data => {
            setTimeout(() => {
                if (data.status === 'already_verified') {
                    // Email exists and is verified - show green checkmark, done!
                    verifySpinner.classList.add('hidden');
                    verifyCheck.classList.remove('hidden');
                    verifyBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                    verifyBtn.classList.add('bg-green-500', 'cursor-default');

                    messageEl.textContent = data.message;
                    messageEl.classList.remove('text-red-500', 'hidden');
                    messageEl.classList.add('text-green-500');

                } else if (data.status === 'code_sent') {
                    // Email exists but not verified OR new email - show code input
                    verifySpinner.classList.add('hidden');
                    verifyBtnText.classList.remove('hidden');

                    // Switch to code input section
                    codeSection.classList.remove('hidden');
                    codeSection.classList.add('flex');
                    emailSection.classList.remove('flex');
                    emailSection.classList.add('hidden');

                    messageEl.textContent = data.message;
                    messageEl.classList.remove('text-red-500', 'hidden');
                    messageEl.classList.add('text-green-500');

                } else {
                    // Error state
                    verifySpinner.classList.add('hidden');
                    verifyBtnText.classList.remove('hidden');
                    verifyBtn.disabled = false;
                    verifyBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                    verifyBtn.classList.add('bg-gray-400', 'hover:bg-gray-300', 'cursor-pointer');

                    messageEl.textContent = data.message || 'An error occurred';
                    messageEl.classList.remove('text-green-500', 'hidden');
                    messageEl.classList.add('text-red-500');
                }
            }, 500);
        })
        .catch(err => {
            console.error(err);
            setTimeout(() => {
                verifySpinner.classList.add('hidden');
                verifyBtnText.classList.remove('hidden');
                verifyBtn.disabled = false;
                verifyBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                verifyBtn.classList.add('bg-gray-400', 'hover:bg-gray-300', 'cursor-pointer');

                messageEl.textContent = 'Network error. Please try again.';
                messageEl.classList.remove('text-green-500', 'hidden');
                messageEl.classList.add('text-red-500');
            }, 500);
        });
}

function verifyCode() {
    const email = document.getElementById('emailInput').value;
    const code = document.getElementById('codeInput').value;
    const messageEl = document.getElementById('verifyMessage');
    const codeSection = document.getElementById('codeSection');
    const emailSection = document.getElementById('emailSection');
    const verifyBtn = document.getElementById('verifyBtn');
    const verifyBtnText = document.getElementById('verifyBtnText');
    const verifyCheck = document.getElementById('verifyCheck');

    // Get CSRF token and route from meta tags
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const verifyCodeRoute = document.querySelector('meta[name="verify-code-route"]').getAttribute('content');

    fetch(verifyCodeRoute, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ email: email, code: code })
    })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                messageEl.textContent = data.message;
                messageEl.classList.remove('text-red-500', 'hidden');
                messageEl.classList.add('text-green-500');

                // Hide code section, show email section with green checkmark
                codeSection.classList.add('hidden');
                codeSection.classList.remove('flex');
                emailSection.classList.add('flex');
                emailSection.classList.remove('hidden');

                // Show success state
                verifyBtnText.classList.add('hidden');
                verifyCheck.classList.remove('hidden');
                verifyBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                verifyBtn.classList.add('bg-green-500', 'cursor-default');
                verifyBtn.disabled = true;
            } else {
                messageEl.textContent = data.message;
                messageEl.classList.remove('text-green-500', 'hidden');
                messageEl.classList.add('text-red-500');
            }
        })
        .catch(err => {
            console.error(err);
            messageEl.textContent = 'An error occurred. Please try again.';
            messageEl.classList.remove('text-green-500', 'hidden');
            messageEl.classList.add('text-red-500');
        });
}

// Helper function to clear error state from input
function clearError(input) {
    input.classList.remove('border-red-500', 'border-2');
    input.classList.add('border-gray-300');

    // Remove error message if exists
    const errorMsg = input.parentElement.querySelector('.error-message');
    if (errorMsg) {
        errorMsg.remove();
    }
}

// Helper function to show error on input
function showError(input, message) {
    input.classList.remove('border-gray-300');
    input.classList.add('border-red-500', 'border-2');

    // Remove existing error message if any
    const existingError = input.parentElement.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }

    // Add error message
    const errorMsg = document.createElement('p');
    errorMsg.className = 'error-message text-sm text-red-500 mt-1';
    errorMsg.textContent = message;
    input.parentElement.appendChild(errorMsg);
}

// Function to validate all form fields
function validateForm() {
    const form = document.getElementById('checkoutForm');
    let isValid = true;
    let firstErrorField = null;

    // Define required fields with their labels
    const requiredFields = [
        { name: 'first_name', label: 'First Name' },
        { name: 'last_name', label: 'Last Name' },
        { name: 'email', label: 'Email Address' },
        { name: 'phone_number', label: 'Phone Number' },
        { name: 'address', label: 'Street Address' },
        { name: 'city', label: 'City' },
        { name: 'state', label: 'State / Province' },
        { name: 'zip_code', label: 'Zip / Postal Code' }
    ];

    // Clear all previous errors
    requiredFields.forEach(field => {
        const input = form.querySelector(`[name="${field.name}"]`);
        if (input) {
            clearError(input);
        }
    });

    // Validate each required field
    requiredFields.forEach(field => {
        const input = form.querySelector(`[name="${field.name}"]`);
        if (input && !input.value.trim()) {
            showError(input, `${field.label} is required`);
            isValid = false;
            if (!firstErrorField) {
                firstErrorField = input;
            }
        }
    });

    // Special validation for email format
    const emailInput = form.querySelector('[name="email"]');
    if (emailInput && emailInput.value.trim()) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value)) {
            showError(emailInput, 'Please enter a valid email address');
            isValid = false;
            if (!firstErrorField) {
                firstErrorField = emailInput;
            }
        }
    }

    // Check if email is verified (green checkmark visible)
    const verifyCheck = document.getElementById('verifyCheck');
    const verifyBtn = document.getElementById('verifyBtn');
    const emailVerified = !verifyCheck.classList.contains('hidden') &&
        verifyBtn.classList.contains('bg-green-500');

    if (!emailVerified && emailInput && emailInput.value.trim()) {
        showError(emailInput, 'Please verify your email address before proceeding');
        isValid = false;
        if (!firstErrorField) {
            firstErrorField = emailInput;
        }
    }

    // Scroll to first error field
    if (!isValid && firstErrorField) {
        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        firstErrorField.focus();
    }

    return isValid;
}

// Load order from localStorage and display in sidebar
function loadOrder() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let finalAmount = localStorage.getItem("finalAmount") || "LKR 0.00";

    let orderBox = document.getElementById("orderItems");
    orderBox.innerHTML = "";

    let subtotalValue = 0;

    cart.forEach(item => {
        subtotalValue += item.price * item.quantity;
        orderBox.innerHTML += `
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-lg bg-gray-100 overflow-hidden">
                    <img src="${item.image}" class="w-full h-full object-cover" />
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-brand-black">${item.title}</p>
                    <p class="text-sm text-gray-500">Qty: ${item.quantity}</p>
                </div>
                <p class="font-medium text-brand-black">LKR ${(item.price * item.quantity).toLocaleString()}</p>
            </div>
        `;
    });

    // Set summary values
    document.getElementById("subtotal").innerText = "LKR " + subtotalValue.toLocaleString();

    let shipping = 350;
    document.getElementById("shipping").innerText = "LKR " + shipping.toLocaleString();

    let total = subtotalValue + shipping;
    document.getElementById("total").innerText = "LKR " + total.toLocaleString();
}

// Load order when page loads
loadOrder();

// Add input event listeners to clear errors when user starts typing
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('checkoutForm');
    const inputs = form.querySelectorAll('input, textarea');

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            clearError(this);
        });
    });
});
