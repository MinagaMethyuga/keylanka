// Navbar Dropdown Management
document.addEventListener('DOMContentLoaded', function() {
    // Get all triggers and dropdowns
    const locksmithTrigger = document.getElementById('LocksmithTrigger');
    const locksmithDropdown = document.getElementById('LockSmithDropdown');

    const remoteKeysTrigger = document.getElementById('RemoteKeysTrigger');
    const remoteKeysDropdown = document.getElementById('RemoteKeysDropDown');

    const smartKeysTrigger = document.getElementById('SmartKeysTrigger');
    const smartKeysDropdown = document.getElementById('SmartKeysDropDown');

    let currentDropdown = null;
    let currentTrigger = null;
    let hideTimeout = null;

    // Function to show dropdown
    function showDropdown(dropdown, trigger) {
        // Hide any currently open dropdown
        if (currentDropdown && currentDropdown !== dropdown) {
            hideDropdownImmediate(currentDropdown);
        }

        clearTimeout(hideTimeout);
        dropdown.style.height = '9rem';
        dropdown.style.opacity = '1';
        dropdown.style.pointerEvents = 'auto';
        currentDropdown = dropdown;
        currentTrigger = trigger;
    }

    // Function to hide dropdown immediately (no delay)
    function hideDropdownImmediate(dropdown) {
        dropdown.style.height = '0px';
        dropdown.style.opacity = '0';
        dropdown.style.pointerEvents = 'none';
        if (currentDropdown === dropdown) {
            currentDropdown = null;
            currentTrigger = null;
        }
    }

    // Function to hide dropdown with delay
    function scheduleHideDropdown(dropdown) {
        clearTimeout(hideTimeout);
        hideTimeout = setTimeout(() => {
            hideDropdownImmediate(dropdown);
        }, 200); // Increased delay for smoother transition
    }

    // Function to setup dropdown handlers
    function setupDropdown(trigger, dropdown) {
        if (!trigger || !dropdown) return;

        // Show on trigger hover
        trigger.addEventListener('mouseenter', function() {
            showDropdown(dropdown, trigger);
        });

        // Keep dropdown open when hovering over it
        dropdown.addEventListener('mouseenter', function() {
            clearTimeout(hideTimeout);
        });

        // Schedule hide when leaving trigger
        trigger.addEventListener('mouseleave', function(e) {
            // Check if mouse is moving towards the dropdown
            const rect = dropdown.getBoundingClientRect();
            if (e.clientY < rect.top) {
                // Mouse is above dropdown, schedule hide
                scheduleHideDropdown(dropdown);
            } else {
                // Mouse might be moving to dropdown, give more time
                clearTimeout(hideTimeout);
                hideTimeout = setTimeout(() => {
                    if (!dropdown.matches(':hover')) {
                        hideDropdownImmediate(dropdown);
                    }
                }, 300);
            }
        });

        // Hide when leaving dropdown
        dropdown.addEventListener('mouseleave', function() {
            scheduleHideDropdown(dropdown);
        });
    }

    // Setup all dropdowns
    setupDropdown(locksmithTrigger, locksmithDropdown);
    setupDropdown(remoteKeysTrigger, remoteKeysDropdown);
    setupDropdown(smartKeysTrigger, smartKeysDropdown);

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (currentDropdown) {
            const triggers = [locksmithTrigger, remoteKeysTrigger, smartKeysTrigger];
            const isClickOnTrigger = triggers.some(trigger => trigger && trigger.contains(e.target));
            const isClickOnDropdown = currentDropdown.contains(e.target);

            if (!isClickOnTrigger && !isClickOnDropdown) {
                hideDropdownImmediate(currentDropdown);
            }
        }
    });
});

// Mobile Menu Management
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('MobileMenuBtn');
    const closeMobileMenu = document.getElementById('CloseMobileMenu');
    const mobileMenu = document.getElementById('MobileMenu');

    // Mobile menu toggle
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.style.transform = 'translateY(0)';
        });
    }

    if (closeMobileMenu) {
        closeMobileMenu.addEventListener('click', function() {
            mobileMenu.style.transform = 'translateY(-100%)';
        });
    }

    // Mobile accordion handlers
    const accordions = [
        { trigger: 'MobileLocksmithTrigger', dropdown: 'MobileLocksmithDropdown' },
        { trigger: 'MobileRemoteKeysTrigger', dropdown: 'MobileRemoteKeysDropdown' },
        { trigger: 'MobileSmartKeysTrigger', dropdown: 'MobileSmartKeysDropdown' }
    ];

    accordions.forEach(({ trigger, dropdown }) => {
        const triggerEl = document.getElementById(trigger);
        const dropdownEl = document.getElementById(dropdown);

        if (triggerEl && dropdownEl) {
            triggerEl.addEventListener('click', function() {
                const icon = this.querySelector('.material-symbols-outlined');
                const isOpen = dropdownEl.classList.contains('flex') || dropdownEl.classList.contains('grid');

                if (isOpen) {
                    dropdownEl.classList.add('hidden');
                    dropdownEl.classList.remove('flex', 'grid');
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    dropdownEl.classList.remove('hidden');
                    // Check if it should be grid or flex
                    if (dropdownEl.classList.contains('grid-cols-2')) {
                        dropdownEl.classList.add('grid');
                    } else {
                        dropdownEl.classList.add('flex');
                    }
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        }
    });
});
