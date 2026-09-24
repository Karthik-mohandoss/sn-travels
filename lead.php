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
    $chatId = "7161123775"; // We will update this soon!
    
    // Only send if chat ID is set
    if ($chatId !== "YOUR_CHAT_ID_HERE") {
        $url = "https://api.telegram.org/bot" . $botToken . "/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $msg
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $response = curl_exec($ch);
        curl_close($ch);
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
