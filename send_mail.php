<?php
header('Content-Type: application/json');

// Get POST data (either from JSON payload or form data)
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Extract variables based on JSON or form data
    $mobile = isset($input['mobile']) ? $input['mobile'] : (isset($_POST['mobile']) ? $_POST['mobile'] : '');
    $pickup = isset($input['pickup']) ? $input['pickup'] : (isset($_POST['pickup']) ? $_POST['pickup'] : '');
    $dropoff = isset($input['dropoff']) ? $input['dropoff'] : (isset($_POST['dropoff']) ? $_POST['dropoff'] : '');
    $formType = isset($input['formType']) ? $input['formType'] : (isset($_POST['formType']) ? $_POST['formType'] : 'Quick Booking');

    if (empty($mobile) || empty($pickup) || empty($dropoff)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    $to = "sntravelsoff@gmail.com";
    $subject = "New Taxi Lead: " . $formType;
    
    $message = "You have received a new booking lead.\n\n";
    $message .= "Booking Type: " . $formType . "\n";
    $message .= "Mobile Number: " . $mobile . "\n";
    $message .= "Pickup Location: " . $pickup . "\n";
    $message .= "Drop-off Location: " . $dropoff . "\n";
    
    $headers = "From: noreply@sn-travels.in\r\n";
    $headers .= "Reply-To: noreply@sn-travels.in\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(["status" => "success", "message" => "Booking request sent successfully."]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to send email. Please try again."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed."]);
}
?>
