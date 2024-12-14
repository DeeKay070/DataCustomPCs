<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\SMTP.php';
require 'PHPMailer-master\src\Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $issueDescription = htmlspecialchars($_POST['description']);
    $name = htmlspecialchars($_POST['name']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $device_type = htmlspecialchars($_POST['device_type']);
    $other_info = htmlspecialchars($_POST['other_info']);
    if ($device_type === 'Other') {
        $device_type = $other_info;
    }
    $water_damage = htmlspecialchars($_POST['water_damage']);
    $physical_damage = htmlspecialchars($_POST['physical_damage']);

    
    $rawTicketNumber = uniqid("REQ-"); // Generates something like "REQ64eac2a0"

    // Filter to keep only uppercase alphanumeric characters
    $filteredTicketNumber = preg_replace('/[^A-Z0-9]/', '', strtoupper($rawTicketNumber));
    
    // Extract the last 6 characters
    $lastSixDigits = substr($filteredTicketNumber, -6);
    
    // Prepend the prefix
    $ticketNumber = 'REQ' . $lastSixDigits;
    
    

    $mail = new PHPMailer(true);
    session_start();
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.purelymail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'daniel@datacustompcs.com';
        $mail->Password   = 'APP_PASSWORD';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email to company
        $mail->setFrom($mail->Username, 'Data Custom PCs');
        $mail->addAddress($mail->Username);
        $mail->Subject = $name . " - New Support Ticket: $ticketNumber";
        $mail->Body    = "You have received a new support ticket.\n\n" .
                         "Ticket Number: $ticketNumber\n" .
                         "Customer Name: $name\n" .
                         "Customer Email: $customerEmail\n" .
                         "Customer Phone: $phone_number\n" .
                         "Device Type: $device_type\n" .
                         "Water Damage: $water_damage\n" .
                         "Physical Damage: $physical_damage\n" .
                         "Issue Description:\n\n$issueDescription\n";
        $mail->send();

        // Email to customer
        $mail->clearAddresses(); // Clear previous addresses
        $mail->addAddress($customerEmail);
        $mail->Subject = "Your Support Ticket: $ticketNumber";
        $mail->Body    = "Thank you for reaching out to us. Your ticket has been received and you will receive a response soon.\n\n" .
                         "Ticket Number: $ticketNumber\n" .
                         "Device Type: $device_type\n" .
                         "Water Damage: $water_damage\n" .
                         "Physical Damage: $physical_damage\n" .
                         "Issue Description:\n\n$issueDescription\n\n" .
        $mail->send();
        // Existing code for ticket generation and email sending
        $_SESSION['success_message'] = "Thank you! Your ticket number is $ticketNumber. A confirmation email has been sent to $customerEmail.";
        header("Location: contact.php"); // Redirect back to the contact page
        exit();
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: contact.php"); // Redirect back to the contact page
        exit();
    }
    
}
?>
