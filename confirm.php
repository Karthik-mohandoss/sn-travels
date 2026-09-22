<?php
// Extract all GET parameters securely
$pickup = isset($_GET['pickup']) ? htmlspecialchars($_GET['pickup']) : '';
$dropoff = isset($_GET['dropoff']) ? htmlspecialchars($_GET['dropoff']) : '';
$mobile = isset($_GET['mobile']) ? htmlspecialchars($_GET['mobile']) : '';
$tripType = isset($_GET['tripType']) ? htmlspecialchars($_GET['tripType']) : '';
$car = isset($_GET['car']) ? htmlspecialchars($_GET['car']) : '';
$fare = isset($_GET['fare']) ? htmlspecialchars($_GET['fare']) : '';
$distance = isset($_GET['distance']) ? htmlspecialchars($_GET['distance']) : '';
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
$date = isset($_GET['date']) ? htmlspecialchars($_GET['date']) : '';
$time = isset($_GET['time']) ? htmlspecialchars($_GET['time']) : '';
$returnDate = isset($_GET['returnDate']) ? htmlspecialchars($_GET['returnDate']) : '';

// 1. SEND EMAIL
$to = "sntravelsoff@gmail.com";
$subject = "Confirm Booking: " . $name . " - " . $tripType;

$message = "🚕 SN Travels - New Booking Confirmed 🚕\n\n";
$message .= "Customer Name: " . $name . "\n";
$message .= "Mobile Number: " . $mobile . "\n";
$message .= "Pickup: " . $pickup . "\n";
$message .= "Drop-off: " . $dropoff . "\n";
$message .= "Trip Type: " . $tripType . "\n";
$message .= "Pickup Date: " . $date . "\n";
$message .= "Pickup Time: " . $time . "\n";
if ($tripType === 'Round Trip' && !empty($returnDate)) {
    $message .= "Return Date: " . $returnDate . "\n";
}
$message .= "Car Selected: " . $car . "\n";
$message .= "Distance: " . $distance . " km\n";
$message .= "Estimated Fare: ₹" . $fare . "\n";

$headers = "From: noreply@sn-travels.in\r\n";
$headers .= "Reply-To: noreply@sn-travels.in\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send mail silently
@mail($to, $subject, $message, $headers);

// 2. WHATSAPP REDIRECT
$waNumber = '919080573379';
$waText = "Hi SN Travels! I am confirming my booking.\n\n";
$waText .= "Name: " . $name . "\n";
$waText .= "Mobile: " . $mobile . "\n";
$waText .= "From: " . $pickup . "\n";
$waText .= "To: " . $dropoff . "\n";
$waText .= "Type: " . $tripType . "\n";
$waText .= "Date: " . $date . "\n";
$waText .= "Time: " . $time . "\n";
if ($tripType === 'Round Trip' && !empty($returnDate)) {
    $waText .= "Return Date: " . $returnDate . "\n";
}
$waText .= "Car: " . $car . "\n";
$waText .= "Distance: " . $distance . " km\n";
$waText .= "Fare: ₹" . $fare;

$waUrl = "https://wa.me/" . $waNumber . "?text=" . urlencode($waText);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to WhatsApp...</title>
    <style>
        body { margin: 0; padding: 0; font-family: system-ui, sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; background: #f8f9fa; }
        .redirect-box { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); text-align: center; max-width: 400px; width: 90%; }
        .redirect-box i { font-size: 3rem; color: #25D366; margin-bottom: 20px; }
        h2 { margin: 0 0 10px 0; color: #333; }
        p { color: #666; margin-bottom: 20px; }
        .spinner { border: 4px solid rgba(0,0,0,0.1); width: 36px; height: 36px; border-radius: 50%; border-left-color: #25D366; animation: spin 1s linear infinite; margin: 0 auto; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
    <!-- Include FontAwesome for WhatsApp icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        // Redirect to WhatsApp immediately
        window.onload = function() {
            setTimeout(function() {
                window.location.href = "<?= $waUrl ?>";
            }, 1000); // 1 second delay for visual feedback
        };
    </script>
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
    <div class="redirect-box">
        <i class="fab fa-whatsapp"></i>
        <h2>Booking Confirmed!</h2>
        <p>Your details have been sent. Redirecting you to WhatsApp to complete your booking...</p>
        <div class="spinner"></div>
    </div>
</body>
</html>
