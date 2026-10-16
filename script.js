document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const mobileBtn = document.querySelector('.mobile-menu-btn');
    const mobileNav = document.querySelector('.mobile-nav');
    
    if (mobileBtn && mobileNav) {
        mobileBtn.addEventListener('click', () => {
            mobileNav.classList.toggle('open');
            const icon = mobileBtn.querySelector('i');
            if (mobileNav.classList.contains('open')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }

    // Close mobile nav when clicking a link
    const navLinks = document.querySelectorAll('.mobile-nav .nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileNav.classList.remove('open');
            if(mobileBtn) {
                const icon = mobileBtn.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    });

    // Header Scroll Effect
    const header = document.querySelector('.header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Swap Locations logic
    const setupSwap = (btnSelector, fromId, toId) => {
        const btn = document.querySelector(btnSelector);
        if (btn) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const fromInput = document.getElementById(fromId);
                const toInput = document.getElementById(toId);
                
                if (fromInput && toInput) {
                    const temp = fromInput.value;
                    fromInput.value = toInput.value;
                    toInput.value = temp;
                    
                    btn.style.transform = 'rotate(180deg) scale(1.15)';
                    setTimeout(() => {
                        btn.style.transition = 'none';
                        btn.style.transform = 'rotate(0deg)';
                        setTimeout(() => {
                            btn.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                        }, 50);
                    }, 300);
                }
            });
        }
    };
    setupSwap('#bookingForm .swap-btn-pill, #bookingForm .swap-btn', 'pickup', 'dropoff');
    setupSwap('#modalSwapBtn', 'modalPickup', 'modalDropoff');

    // Modal Logic
    const modal = document.getElementById('bookingModal');
    const closeBtn = document.getElementById('closeModalBtn');
    const modalSubtitle = document.getElementById('modalSubtitle');
    const modalCabType = document.getElementById('modalCabType');

    const openModal = (cabType = 'General') => {
        if (modal) {
            modal.classList.add('active');
            if (cabType !== 'General') {
                modalSubtitle.textContent = `Booking for ${cabType}`;
                modalCabType.value = cabType;
            } else {
                modalSubtitle.textContent = 'Please enter details to confirm your ride';
                modalCabType.value = 'General';
            }
        }
    };

    const closeModal = () => {
        if (modal) {
            modal.classList.remove('active');
        }
    };

    if (closeBtn) closeBtn.addEventListener('click', (e) => { e.preventDefault(); closeModal(); });
    if (modal) modal.addEventListener('click', (e) => { if(e.target === modal) closeModal(); });

    // Open modal from Fleet buttons
    const selectBtns = document.querySelectorAll('.fleet-card .btn-primary');
    selectBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const title = e.target.closest('.fleet-content').querySelector('.fleet-title').textContent;
            openModal(title);
        });
    });

    // Open modal from Services buttons
    const serviceBtns = document.querySelectorAll('.service-link');
    serviceBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const title = e.target.closest('.service-card').querySelector('.service-title').textContent;
            openModal(title);
        });
    });

    // Google Ads Conversion Tracking on "Check Fares & Book" Form Submission
    let isSubmitting = false;
    const setupConversionForm = (formId) => {
        const form = document.getElementById(formId);
        if (form) {
            form.addEventListener('submit', function(e) {
                if (isSubmitting) return;
                e.preventDefault();
                isSubmitting = true;

                const formEl = this;
                let submitted = false;

                const doSubmit = () => {
                    if (!submitted) {
                        submitted = true;
                        HTMLFormElement.prototype.submit.call(formEl);
                    }
                };

                const submitBtn = formEl.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.style.opacity = '0.7';
                    submitBtn.innerText = 'Processing...';
                }

                // Fire Google Ads Conversion Event
                if (typeof gtag === 'function') {
                    gtag('event', 'conversion', {
                        'send_to': 'AW-18445888475/Kt08CLS75YAdENvX19tE',
                        'event_callback': doSubmit
                    });
                    // Fallback after 400ms in case gtag callback is delayed or blocked
                    setTimeout(doSubmit, 400);
                } else {
                    doSubmit();
                }
            });
        }
    };

    setupConversionForm('bookingForm');
    setupConversionForm('confirmBookingForm');

    // Auto-clean mobile inputs (strip non-digits, leading 0 or 91)
    const cleanMobileInput = (inputId) => {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('input', function() {
                let val = this.value.replace(/\D/g, '');
                if (val.length === 11 && val.startsWith('0')) {
                    val = val.substring(1);
                } else if (val.length === 12 && val.startsWith('91')) {
                    val = val.substring(2);
                }
                if (val.length > 10) {
                    val = val.slice(0, 10);
                }
                this.value = val;
            });
        }
    };
    cleanMobileInput('mobile');
    cleanMobileInput('modalMobile');

});

// Global callback for Google Maps API
window.initMap = function() {
    const options = {
        componentRestrictions: { country: "in" },
        fields: ["formatted_address", "geometry", "name"],
    };

    const pickupInput = document.getElementById('pickup');
    const dropoffInput = document.getElementById('dropoff');
    const modalPickupInput = document.getElementById('modalPickup');
    const modalDropoffInput = document.getElementById('modalDropoff');

    if (pickupInput && window.google) new google.maps.places.Autocomplete(pickupInput, options);
    if (dropoffInput && window.google) new google.maps.places.Autocomplete(dropoffInput, options);
    if (modalPickupInput && window.google) new google.maps.places.Autocomplete(modalPickupInput, options);
    if (modalDropoffInput && window.google) new google.maps.places.Autocomplete(modalDropoffInput, options);
};
