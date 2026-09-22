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

    // Swap Locations logic remains
    const swapBtn = document.querySelector('.swap-btn');
    if (swapBtn) {
        swapBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const fromInput = document.getElementById('pickup');
            const toInput = document.getElementById('dropoff');
            
            if (fromInput && toInput) {
                const temp = fromInput.value;
                fromInput.value = toInput.value;
                toInput.value = temp;
                
                swapBtn.style.transform = 'rotate(180deg)';
                setTimeout(() => {
                    swapBtn.style.transition = 'none';
                    swapBtn.style.transform = 'rotate(0deg)';
                    setTimeout(() => {
                        swapBtn.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                    }, 50);
                }, 300);
            }
        });
    }

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
