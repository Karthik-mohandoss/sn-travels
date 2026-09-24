<?php
$pickup = isset($_GET['pickup']) ? htmlspecialchars($_GET['pickup']) : '';
$dropoff = isset($_GET['dropoff']) ? htmlspecialchars($_GET['dropoff']) : '';
$mobile = isset($_GET['mobile']) ? htmlspecialchars($_GET['mobile']) : '';

// 1. SEND EMAIL
$to = "sntravelsoff@gmail.com";
$subject = "New Lead: Taxi Enquiry (" . $mobile . ")";

$message = "🚕 SN Travels - New Lead Capture 🚕\n\n";
$message .= "Customer Mobile: " . $mobile . "\n";
$message .= "Pickup: " . $pickup . "\n";
$message .= "Drop-off: " . $dropoff . "\n";

$headers = "From: noreply@sn-travels.in\r\n";
$headers .= "Reply-To: noreply@sn-travels.in\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send mail silently
@mail($to, $subject, $message, $headers);

// 2. SEND TELEGRAM
function sendToTelegram($msg) {
    $botToken = "8934344294:AAFrhE6aSk7BpEy8pcZFqsCO0T75iyZMJC8";
    $chatId = "YOUR_CHAT_ID_HERE"; // We will update this soon!
    
    // Only send if chat ID is set
    if ($chatId !== "YOUR_CHAT_ID_HERE") {
        $url = "https://api.telegram.org/bot" . $botToken . "/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $msg
        ];
        
        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type:application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($data),
                'ignore_errors' => true
            ]
        ];
        $context = stream_context_create($options);
        @file_get_contents($url, false, $context);
    }
}

sendToTelegram($message);

// 3. Redirect to cars.php
$query = http_build_query([
    'pickup' => $_GET['pickup'] ?? '',
    'dropoff' => $_GET['dropoff'] ?? '',
    'mobile' => $_GET['mobile'] ?? ''
]);

header("Location: cars.php?" . $query);
exit();
?>
