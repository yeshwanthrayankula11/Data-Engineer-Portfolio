<?php

// Recipient Email Address
$receiving_email_address = 'yeshwanth.r@themailpad.com';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize input fields
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Set email headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email content
    $email_body = "You have received a new message from your website contact form:\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n\n";
    $email_body .= "Message:\n$message\n";

    // Send email
    if (mail($receiving_email_address, $subject, $email_body, $headers)) {
        echo "success";  // Success response for JavaScript handling
    } else {
        echo "error";  // Error response
    }
} else {
    echo "Invalid request.";
}

?>
