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

    // Booking Form Submit
    const bookBtn = document.getElementById('bookBtn');
    if (bookBtn) {
        bookBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const mobile = document.getElementById('mobile')?.value;
            const pickup = document.getElementById('pickup')?.value;
            const dropoff = document.getElementById('dropoff')?.value;
            
            if (!mobile || !pickup || !dropoff) {
                alert('Please fill in all the details (Mobile, Pickup, Drop-off) to check fares.');
                return;
            }

            // Redirect to WhatsApp with pre-filled message
            const waNumber = '919080573379'; // SN Travels Number
            const message = `Hi SN Travels! I would like to book a ride.\n\nFrom: ${pickup}\nTo: ${dropoff}\nMobile: ${mobile}`;
            const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`;
            
            window.open(waUrl, '_blank');
        });
    }
});
