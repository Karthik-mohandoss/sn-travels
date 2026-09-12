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

    // Swap Locations
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
                
                // Add a small rotation animation to icon
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

    // Function to handle form submission
    const handleFormSubmit = (e, formType, mobileId, pickupId, dropoffId, btnId) => {
        e.preventDefault();
        const mobile = document.getElementById(mobileId)?.value;
        const pickup = document.getElementById(pickupId)?.value;
        const dropoff = document.getElementById(dropoffId)?.value;
        const btn = document.getElementById(btnId);
        
        if (!mobile || !pickup || !dropoff) {
            alert('Please fill in all the details (Mobile, Pickup, Drop-off).');
            return;
        }

        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        btn.disabled = true;

        fetch('send_mail.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                formType: formType,
                mobile: mobile,
                pickup: pickup,
                dropoff: dropoff
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Booking request sent successfully! We will contact you shortly.');
                // Also redirect to WhatsApp
                const waNumber = '919080573379';
                const message = `Hi SN Travels! I have sent a booking request.\n\nType: ${formType}\nFrom: ${pickup}\nTo: ${dropoff}\nMobile: ${mobile}`;
                window.open(`https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`, '_blank');
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(err => {
            alert('Something went wrong, but you can still book via WhatsApp!');
            const waNumber = '919080573379';
            const message = `Hi SN Travels! I would like to book a ride.\n\nFrom: ${pickup}\nTo: ${dropoff}\nMobile: ${mobile}`;
            window.open(`https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`, '_blank');
        })
        .finally(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    };

    // Quick Booking Form Submit
    const bookBtn = document.getElementById('bookBtn');
    if (bookBtn) {
        bookBtn.addEventListener('click', (e) => {
            handleFormSubmit(e, 'Quick Booking', 'mobile', 'pickup', 'dropoff', 'bookBtn');
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

    // Confirm Booking Form Submit
    const confirmBookBtn = document.getElementById('confirmBookBtn');
    if (confirmBookBtn) {
        confirmBookBtn.addEventListener('click', (e) => {
            const type = document.getElementById('modalCabType').value;
            handleFormSubmit(e, `Confirm Booking - ${type}`, 'modalMobile', 'modalPickup', 'modalDropoff', 'confirmBookBtn');
        });
    }

    // Initialize Google Maps Places Autocomplete
    const initAutocomplete = () => {
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

    // Call init when google maps is loaded, or wait for it
    if (window.google && window.google.maps) {
        initAutocomplete();
    } else {
        // Since we load the script synchronously before this script, it should be available.
        // But adding a small timeout fallback just in case.
        setTimeout(() => {
            if (window.google && window.google.maps) initAutocomplete();
        }, 1000);
    }
});
