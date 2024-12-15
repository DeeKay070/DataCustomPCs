<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\SMTP.php';
require 'PHPMailer-master\src\Exception.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $customerEmail = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $details = htmlspecialchars($_POST['details']);
    $cart = json_decode($_POST['cart'], true);


    $rawTicketNumber = uniqid("REQ-"); // Generates something like "REQ64eac2a0"

    // Filter to keep only uppercase alphanumeric characters
    $filteredTicketNumber = preg_replace('/[^A-Z0-9]/', '', strtoupper($rawTicketNumber));
    
    // Extract the last 6 characters
    $lastSixDigits = substr($filteredTicketNumber, -6);
    
    // Prepend the prefix
    $ticketNumber = 'REQ' . $lastSixDigits;

    // Prepare the order summary
    $orderSummary = "Order Summary:\n\n";
    $total = 0;

    foreach ($cart as $item) {
        $orderSummary .= "- {$item['name']}: \${$item['price']}\n";
        $total += $item['price'];
    }

    $orderSummary .= "\nTotal: \$$total";
    $requestEmailBody = "Customer Details:\nName: $name\nEmail: $customerEmail\nPhone: $phone\nExtra Details: $details\n\n" . $orderSummary;

    // Support email
    $supportEmail = 'daniel@datacustompcs.com';

    // Confirmation email to user
    $userSubject = "Order Confirmation - Thank You, $name!";
    $userMessage = "Thank you for your order, $name! We will be in contact with you soon about fulfilling your request.\n\nFor future reference, your ticket number is: $ticketNumber\n\n$orderSummary";
    
    

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
        $mail->Subject = $name . " - New Order: $ticketNumber";
        $mail->Body    = $requestEmailBody;
        $mail->send();

        // Email to customer
        $mail->clearAddresses();
        $mail->addAddress($customerEmail);
        $mail->Subject = "Your Order Number: $ticketNumber";
        $mail->Body    = $userMessage;
        $mail->send();
        // Existing code for ticket generation and email sending
        $_SESSION['success_message'] = "Thank you! Your ticket number is $ticketNumber. A confirmation email has been sent to $customerEmail.";
        // Redirect to a thank-you page
        header('Location: thank_you.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: checkout.php");
        exit();
    }
    exit;
}
?>
