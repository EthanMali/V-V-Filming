<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust path as needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $service = filter_input(INPUT_POST, 'service', FILTER_SANITIZE_STRING);
    $details = filter_input(INPUT_POST, 'details', FILTER_SANITIZE_STRING);

    if (!$email) {
        echo json_encode(["success" => false, "message" => "Invalid email address."]);
        exit();
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USERNAME'); // Use environment variable
        $mail->Password = getenv('SMTP_PASSWORD'); // Use environment variable
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'V&V Filming');
        $mail->addAddress('your-email@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Service Request from $name";
        $mail->Body = "
            <p>Name: $name</p>
            <p>Email: $email</p>
            <p>Phone: $phone</p>
            <p>Service: $service</p>
            <p>Details: $details</p>
        ";

        $mail->send();

        $response = [
            "success" => true,
            "message" => "Thank you, $name! Your request for $service has been submitted successfully.",
            "contact" => "We will contact you at $email."
        ];
        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    header("Location: request.html");
    exit();
}
?>
