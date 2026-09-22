<?php
$mobile = isset($_GET['mobile']) ? htmlspecialchars($_GET['mobile']) : '';
$pickup = isset($_GET['pickup']) ? htmlspecialchars($_GET['pickup']) : '';
$dropoff = isset($_GET['dropoff']) ? htmlspecialchars($_GET['dropoff']) : '';
$cabType = isset($_GET['cabType']) ? htmlspecialchars($_GET['cabType']) : 'Quick Booking';

if (!empty($mobile) && !empty($pickup) && !empty($dropoff)) {
    $to = "sntravelsoff@gmail.com";
    $subject = "New Taxi Lead: " . $cabType;
    $message = "You have received a new booking lead.\n\n";
    $message .= "Booking Type: " . $cabType . "\n";
    $message .= "Mobile Number: " . $mobile . "\n";
    $message .= "Pickup Location: " . $pickup . "\n";
    $message .= "Drop-off Location: " . $dropoff . "\n";
    
    $headers = "From: noreply@sn-travels.in\r\n";
    $headers .= "Reply-To: noreply@sn-travels.in\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Send email silently
    @mail($to, $subject, $message, $headers);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cabs - SN Travels</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .cars-header {
            padding: 100px 5% 40px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #001f3f 100%);
            color: white;
            text-align: center;
        }
        .cars-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 5%;
        }
        .route-info {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .route-details {
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 600;
            color: var(--text-color);
        }
        .route-dist {
            background: var(--accent-color);
            color: var(--primary-color);
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
        }
        .car-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        .car-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-color);
        }
        .car-img {
            width: 150px;
            height: 80px;
            object-fit: contain;
        }
        .car-info {
            flex: 1;
            padding: 0 20px;
        }
        .car-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        .car-seats {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 10px;
        }
        .car-price {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--accent-color);
        }
        .car-book .btn {
            padding: 12px 25px;
        }
        @media (max-width: 768px) {
            .car-card {
                flex-direction: column;
                text-align: center;
            }
            .car-info {
                padding: 15px 0;
            }
            .route-info {
                flex-direction: column;
                text-align: center;
            }
            .route-details {
                flex-direction: column;
                gap: 5px;
            }
        }
        #loading {
            text-align: center;
            padding: 50px;
            font-size: 1.2rem;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <header class="header" style="background: white;">
        <div class="container header-container">
            <a href="index.html" class="logo">
                <div class="logo-icon"><i class="fas fa-car-side"></i></div>
                <div class="logo-text">SN <span>Travels</span></div>
            </a>
            <div class="header-actions">
                <a href="tel:+919080573379" class="btn btn-outline"><i class="fas fa-phone-alt"></i> +91 90805 73379</a>
            </div>
        </div>
    </header>

    <div class="cars-header">
        <h1>Select Your Cab</h1>
        <p>Transparent pricing, no hidden charges</p>
    </div>

    <div class="cars-container">
        <div class="route-info" style="display:none;" id="routeCard">
            <div class="route-details">
                <span><i class="fas fa-map-marker-alt" style="color: var(--accent-color);"></i> <span id="txtPickup"><?= $pickup ?></span></span>
                <i class="fas fa-arrow-right"></i>
                <span><i class="fas fa-map-pin" style="color: var(--accent-color);"></i> <span id="txtDropoff"><?= $dropoff ?></span></span>
            </div>
            <div class="route-dist" id="txtDist">Calculating...</div>
        </div>

        <div id="loading"><i class="fas fa-spinner fa-spin"></i> Calculating best fares for your route...</div>
        
        <div id="carsList" style="display:none;">
            <!-- Cars will be injected here -->
        </div>
    </div>

    <script>
        const pickup = "<?= $pickup ?>";
        const dropoff = "<?= $dropoff ?>";
        const mobile = "<?= $mobile ?>";

        const carTypes = [
            { id: 'hatchback', name: 'Hatchback', seats: '4', rate: 13, driver: 400, img: 'https://media.mahindrafirstchoice.com/live_web_images/usedcarsimg/mfc/4351/577927/cover_image-20230718161449.jpeg' },
            { id: 'sedan', name: 'Sedan', seats: '4', rate: 14, driver: 400, img: 'https://s3.ap-south-1.amazonaws.com/cb360static/uploads/333742ef-2f6c-4f06-9664-faede6dcc1d8--New%20Project%20-%202025-01-16T161103.598.webp' },
            { id: 'suv', name: 'SUV (Innova)', seats: '7', rate: 18, driver: 500, img: 'https://i.pinimg.com/564x/ae/ac/cb/aeaccb280abfd5f4029fc2b48dc9dc73.jpg' },
            { id: 'crysta', name: 'Innova Crysta', seats: '7', rate: 20, driver: 600, img: 'https://images.ctfassets.net/5iu1oya45cp3/tJyQQpUfF0XuYTl6soPvz/c42def0a66d1aa5e33e82ab25385c0d8/New_Project__13_.png' }
        ];

        window.initCarsMap = function() {
            if (!pickup || !dropoff) {
                document.getElementById('loading').innerHTML = "Invalid route. Please <a href='index.html'>go back</a> and try again.";
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
                    const distanceKm = Math.round(response.rows[0].elements[0].distance.value / 1000);
                    // Minimum 130km for outstation
                    const billedKms = distanceKm < 130 ? 130 : distanceKm;
                    
                    document.getElementById('txtDist').innerText = `${distanceKm} km`;
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('carsList').style.display = 'block';

                    renderCars(billedKms);
                } else {
                    document.getElementById('txtDist').innerText = 'Distance unavailable';
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('carsList').style.display = 'block';
                    renderCars(130); // Default to minimum if API fails
                }
            });
        };

        function renderCars(kms) {
            const list = document.getElementById('carsList');
            let html = '';
            
            carTypes.forEach(c => {
                const fare = Math.round((kms * c.rate) + c.driver);
                html += `
                <div class="car-card">
                    <img src="${c.img}" alt="${c.name}" class="car-img">
                    <div class="car-info">
                        <div class="car-name">${c.name}</div>
                        <div class="car-seats">${c.seats} Seater AC Cab</div>
                        <div style="font-size: 0.85rem; color: #777;"><i class="fas fa-check-circle" style="color: green;"></i> Driver Bata included. Tolls & Tax extra.</div>
                    </div>
                    <div class="car-book">
                        <div class="car-price">₹${fare}</div>
                        <br>
                        <button class="btn btn-primary" onclick="bookNow('${c.name}', ${fare}, ${kms})">Book Now</button>
                    </div>
                </div>`;
            });
            
            list.innerHTML = html;
        }

        function bookNow(carName, fare, kms) {
            const waNumber = '919080573379';
            const message = `Hi SN Travels! I would like to confirm my ride.\n\nFrom: ${pickup}\nTo: ${dropoff}\nCar: ${carName}\nDistance: ${kms} km\nEstimated Fare: ₹${fare}\nMobile: ${mobile}`;
            window.open(`https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`, '_blank');
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCH5nO7MHp_16hu6xl3BITgFy43xF1GLt0&libraries=places&callback=initCarsMap"></script>
</body>
</html>
