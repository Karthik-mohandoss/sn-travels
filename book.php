<?php
$pickup = isset($_GET['pickup']) ? htmlspecialchars($_GET['pickup']) : '';
$dropoff = isset($_GET['dropoff']) ? htmlspecialchars($_GET['dropoff']) : '';
$mobile = isset($_GET['mobile']) ? htmlspecialchars($_GET['mobile']) : '';
$tripType = isset($_GET['tripType']) ? htmlspecialchars($_GET['tripType']) : 'One Way';
$car = isset($_GET['car']) ? htmlspecialchars($_GET['car']) : '';
$fare = isset($_GET['fare']) ? htmlspecialchars($_GET['fare']) : '';
$distance = isset($_GET['distance']) ? htmlspecialchars($_GET['distance']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Details - SN Travels</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .book-page { padding-top: 100px; padding-bottom: 50px; background: #f8f9fa; }
        .book-container { max-width: 600px; margin: 0 auto; padding: 0 5%; }
        
        .summary-card {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .summary-title { font-size: 1.2rem; font-weight: 700; margin-bottom: 15px; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 0.95rem; }
        .summary-row.total { font-size: 1.2rem; font-weight: 800; color: var(--accent-color); margin-top: 15px; padding-top: 15px; border-top: 1px dashed rgba(255,255,255,0.3); }
        
        .form-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-color); font-size: 0.9rem; }
        .form-control { width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; outline: none; transition: border-color 0.3s; }
        .form-control:focus { border-color: var(--primary-color); }
        
        .submit-btn {
            width: 100%;
            padding: 15px;
            background: var(--accent-color);
            color: var(--primary-color);
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .submit-btn:hover { background: #e5b300; transform: translateY(-2px); }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header" style="background: rgba(255, 255, 255, 0.98); box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
        <div class="container header-container">
            <a href="index.html" class="logo">
                <img src="logo.png" alt="SN Travels Logo" class="brand-logo">
            </a>
            <div class="header-actions">
                <a href="tel:+919080573379" class="btn btn-outline"><i class="fas fa-phone-alt"></i> +91 90805 73379</a>
            </div>
        </div>
    </header>

    <div class="book-page">
        <div class="book-container">
            
            <div class="summary-card">
                <div class="summary-title">Booking Summary</div>
                <div class="summary-row"><span>Route</span> <span><?= $pickup ?> &rarr; <?= $dropoff ?></span></div>
                <div class="summary-row"><span>Trip Type</span> <span><?= $tripType ?> (<?= $distance ?> km)</span></div>
                <div class="summary-row"><span>Car Selected</span> <span><?= $car ?></span></div>
                <div class="summary-row total"><span>Total Fare</span> <span>₹<?= $fare ?></span></div>
            </div>

            <div class="form-card">
                <h3 style="margin-bottom: 20px; color: var(--primary-color);">Enter Passenger Details</h3>
                <form action="confirm.php" method="GET">
                    <!-- Hidden fields to pass data -->
                    <input type="hidden" name="pickup" value="<?= $pickup ?>">
                    <input type="hidden" name="dropoff" value="<?= $dropoff ?>">
                    <input type="hidden" name="mobile" value="<?= $mobile ?>">
                    <input type="hidden" name="tripType" value="<?= $tripType ?>">
                    <input type="hidden" name="car" value="<?= $car ?>">
                    <input type="hidden" name="fare" value="<?= $fare ?>">
                    <input type="hidden" name="distance" value="<?= $distance ?>">

                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. John Doe" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pickup Date *</label>
                        <input type="date" name="date" class="form-control" id="tripDate" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pickup Time *</label>
                        <input type="time" name="time" class="form-control" required>
                    </div>

                    <?php if ($tripType === 'Round Trip'): ?>
                    <div class="form-group">
                        <label class="form-label">Return Date *</label>
                        <input type="date" name="returnDate" class="form-control" id="returnDate" required>
                    </div>
                    <?php endif; ?>

                    <button type="submit" class="submit-btn" id="confirmBtn">Confirm Booking</button>
                </form>
            </div>

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
                    <p class="footer-desc">Your trusted, premium taxi partner in Tamil Nadu.</p>
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
                <p>&copy; 2026 SN Travels. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tripDate').min = today;
        <?php if ($tripType === 'Round Trip'): ?>
        const tripDate = document.getElementById('tripDate');
        const returnDate = document.getElementById('returnDate');
        tripDate.addEventListener('change', () => {
            returnDate.min = tripDate.value;
        });
        <?php endif; ?>

        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('confirmBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            btn.style.pointerEvents = 'none';
        });
    </script>
</body>
</html>
