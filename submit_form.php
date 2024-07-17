<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $service = htmlspecialchars($_POST['service']);
    $details = htmlspecialchars($_POST['details']);

    $to = "ethan.mali.1120@gmail.com";
    $subject = "Service Request from $name";
    $message = "Service: $service\nDetails: $details\n\nContact: $phone";
    $headers = "From: noreply@yourdomain.com" . "\r\n" . "Reply-To: $email";

    if(mail($to, $subject, $message, $headers)) {
        $response = [
            "success" => true,
            "message" => "Thank you, $name! Your request for $service has been submitted successfully.",
            "contact" => "We will contact you at $email."
        ];
    } else {
        $response = [
            "success" => false,
            "message" => "There was an error sending your request. Please try again later."
        ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header("Location: request.html");
    exit();
}
?>
