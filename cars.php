<?php
$mobile = isset($_GET['mobile']) ? htmlspecialchars($_GET['mobile']) : '';
$pickup = isset($_GET['pickup']) ? htmlspecialchars($_GET['pickup']) : '';
$dropoff = isset($_GET['dropoff']) ? htmlspecialchars($_GET['dropoff']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Cab - SN Travels</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .cars-page { padding-top: 100px; padding-bottom: 50px; background: #f8f9fa; }
        .cars-container { max-width: 800px; margin: 0 auto; padding: 0 5%; }
        
        .trip-type-toggle {
            display: flex;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .trip-type-btn {
            flex: 1;
            padding: 15px;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
            border: none;
            background: white;
            color: #666;
            transition: all 0.3s;
        }
        .trip-type-btn.active {
            background: var(--primary-color);
            color: white;
        }
        
        .route-info {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .route-details { display: flex; align-items: center; gap: 15px; font-weight: 600; color: var(--text-color); }
        .route-dist { background: var(--accent-color); color: var(--primary-color); padding: 5px 15px; border-radius: 20px; font-weight: 700; font-size: 0.9rem; }
        
        .car-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.3s ease;
            border-left: 4px solid transparent;
        }
        .car-card:hover { transform: translateY(-3px); border-left-color: var(--accent-color); }
        .car-img { width: 150px; height: 80px; object-fit: contain; }
        .car-info { flex: 1; padding: 0 20px; }
        .car-name { font-size: 1.3rem; font-weight: 800; color: var(--primary-color); margin-bottom: 5px; }
        .car-seats { font-size: 0.9rem; color: #666; margin-bottom: 10px; }
        .car-price { font-size: 1.6rem; font-weight: 800; color: var(--accent-color); }
        
        @media (max-width: 768px) {
            .car-card { flex-direction: column; text-align: center; }
            .car-info { padding: 15px 0; }
            .route-info { flex-direction: column; text-align: center; }
            .route-details { flex-direction: column; gap: 5px; }
        }
        #loading { text-align: center; padding: 50px; font-size: 1.2rem; color: var(--primary-color); }
    </style>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-18445888475"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'AW-18445888475');
    </script>
</head>
<body>
    <header class="header" style="background: #ffffff; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
        <div class="container header-container">
            <a href="index.html" class="logo">
                <img src="logo.png" alt="SN Travels Logo" class="brand-logo">
            </a>
            <nav class="nav-links">
                <a href="index.html#home" class="nav-link">Home</a>
                <a href="index.html#services" class="nav-link">Services</a>
                <a href="index.html#fleet" class="nav-link">Our Fleet</a>
                <a href="index.html#contact" class="nav-link">Contact</a>
            </nav>
            <div class="header-actions">
                <a href="tel:+919080573379" class="btn btn-outline">
                    <i class="fas fa-phone-alt"></i> +91 90805 73379
                </a>
            </div>
        </div>
    </header>

    <div class="cars-page">
        <div class="cars-container">
            <h2 style="text-align:center; color:var(--primary-color); margin-bottom:20px;">Select Your Cab</h2>
            
            <div class="trip-type-toggle">
                <button class="trip-type-btn active" id="btnOneWay" onclick="setTripType('One Way')">One Way Drop</button>
                <button class="trip-type-btn" id="btnRoundTrip" onclick="setTripType('Round Trip')">Round Trip</button>
            </div>

            <div class="route-info" style="display:none;" id="routeCard">
                <div class="route-details">
                    <span><i class="fas fa-map-marker-alt" style="color: var(--accent-color);"></i> <span id="txtPickup"><?= $pickup ?></span></span>
                    <i class="fas fa-arrow-right"></i>
                    <span><i class="fas fa-map-pin" style="color: var(--accent-color);"></i> <span id="txtDropoff"><?= $dropoff ?></span></span>
                </div>
                <div class="route-dist" id="txtDist">Calculating...</div>
            </div>

            <div id="loading"><i class="fas fa-spinner fa-spin"></i> Calculating fares...</div>
            
            <div id="carsList" style="display:none;"></div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <a href="index.html" class="logo" style="margin-bottom: 1.5rem;">
                        <img src="logo.png" alt="SN Travels Logo" class="footer-logo-img">
                    </a>
                    <p class="footer-desc">Your trusted, premium taxi partner in Tamil Nadu. Outstation rides, airport transfers, and local trips with transparent fares.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/919080573379" class="social-link"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="footer-title">Quick Links</h3>
                    <div class="footer-links">
                        <a href="index.html#home" class="footer-link"><i class="fas fa-angle-right"></i> Home</a>
                        <a href="index.html#services" class="footer-link"><i class="fas fa-angle-right"></i> Services</a>
                        <a href="index.html#fleet" class="footer-link"><i class="fas fa-angle-right"></i> Our Fleet</a>
                    </div>
                </div>
                <div>
                    <h3 class="footer-title">Contact Us</h3>
                    <div class="footer-contact">
                        <div class="fc-item">
                            <div class="fc-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="fc-text">
                                <h4>Call or WhatsApp</h4>
                                <p>+91 90805 73379</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 SN Travels. All rights reserved. Developed by <a href="https://apexsofttech.com" target="_blank" style="color: var(--accent-color); text-decoration: none;">ApexSoftTech</a>.</p>
            </div>
        </div>
    </footer>

    <script>
        const pickup = "<?= $pickup ?>";
        const dropoff = "<?= $dropoff ?>";
        const mobile = "<?= $mobile ?>";
        let tripType = 'One Way';
        let baseDistanceKm = 0;

        const carTypes = [
            { id: 'hatchback', name: 'Hatchback', seats: '4', rate: 13, driver: 400, img: 'https://media.mahindrafirstchoice.com/live_web_images/usedcarsimg/mfc/4351/577927/cover_image-20230718161449.jpeg' },
            { id: 'sedan', name: 'Sedan', seats: '4', rate: 14, driver: 400, img: 'https://s3.ap-south-1.amazonaws.com/cb360static/uploads/333742ef-2f6c-4f06-9664-faede6dcc1d8--New%20Project%20-%202025-01-16T161103.598.webp' },
            { id: 'suv', name: 'SUV (Innova)', seats: '7', rate: 18, driver: 500, img: 'https://i.pinimg.com/564x/ae/ac/cb/aeaccb280abfd5f4029fc2b48dc9dc73.jpg' },
            { id: 'crysta', name: 'Innova Crysta', seats: '7', rate: 20, driver: 600, img: 'https://images.ctfassets.net/5iu1oya45cp3/tJyQQpUfF0XuYTl6soPvz/c42def0a66d1aa5e33e82ab25385c0d8/New_Project__13_.png' }
        ];

        function setTripType(type) {
            tripType = type;
            document.getElementById('btnOneWay').classList.remove('active');
            document.getElementById('btnRoundTrip').classList.remove('active');
            if (type === 'One Way') {
                document.getElementById('btnOneWay').classList.add('active');
            } else {
                document.getElementById('btnRoundTrip').classList.add('active');
            }
            if (baseDistanceKm > 0) renderCars();
        }

        window.initCarsMap = function() {
            if (!pickup || !dropoff) {
                document.getElementById('loading').innerHTML = "Invalid route. Please <a href='index.html'>go back</a>.";
                return;
            }

            document.getElementById('routeCard').style.display = 'flex';
            
            const service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix({
                origins: [pickup],
                destinations: [dropoff],
                travelMode: 'DRIVING',
                region: 'in'
            }, (response, status) => {
                if (status === 'OK' && response.rows[0].elements[0].status === 'OK') {
                    baseDistanceKm = Math.round(response.rows[0].elements[0].distance.value / 1000);
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('carsList').style.display = 'block';
                    renderCars();
                } else {
                    baseDistanceKm = 130; // fallback
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('carsList').style.display = 'block';
                    renderCars();
                }
            });
        };

        function renderCars() {
            const list = document.getElementById('carsList');
            let html = '';
            
            let billedKms = baseDistanceKm;
            if (tripType === 'Round Trip') {
                billedKms = baseDistanceKm * 2;
                if (billedKms < 250) billedKms = 250;
            } else {
                if (billedKms < 130) billedKms = 130;
            }

            document.getElementById('txtDist').innerText = `${billedKms} km`;

            carTypes.forEach(c => {
                const driverBata = tripType === 'Round Trip' ? c.driver * 2 : c.driver;
                const fare = Math.round((billedKms * c.rate) + driverBata);
                
                html += `
                <div class="car-card">
                    <img src="${c.img}" alt="${c.name}" class="car-img">
                    <div class="car-info">
                        <div class="car-name">${c.name}</div>
                        <div class="car-seats">${c.seats} Seater AC Cab</div>
                        <div style="font-size: 0.85rem; color: #777;"><i class="fas fa-check-circle" style="color: green;"></i> Driver Bata included. Tolls extra.</div>
                    </div>
                    <div style="text-align:right;">
                        <div class="car-price">₹${fare}</div>
                        <br>
                        <button class="btn btn-primary" onclick="proceedToBook('${c.name}', ${fare}, ${billedKms})">Book Car</button>
                    </div>
                </div>`;
            });
            
            list.innerHTML = html;
        }

        function proceedToBook(carName, fare, kms) {
            const params = new URLSearchParams({
                pickup: pickup,
                dropoff: dropoff,
                mobile: mobile,
                tripType: tripType,
                car: carName,
                fare: fare,
                distance: kms
            });
            window.location.href = `book.php?${params.toString()}`;
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCH5nO7MHp_16hu6xl3BITgFy43xF1GLt0&libraries=places&callback=initCarsMap"></script>
</body>
</html>
