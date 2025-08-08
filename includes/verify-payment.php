<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__. '/session.php';
require_once __DIR__.'/db_conn.php';
require_once __DIR__.'/loadenv.php';
require_once __DIR__.'/sms_config.php';
try {
    loadEnv(__DIR__ . '/../.env'); // Adjust the path if needed
} catch (Exception $e) {
    die($e->getMessage());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$paystackSecretKey = $_ENV['PAYSTACK_SECRET_KEY'];

// Get the reference from the query string
$transactionRef = $_GET['reference'] ?? null;

if (!$transactionRef) {
    die("No transaction reference provided.");
}

// Verify the payment with Paystack
$verificationUrl = "https://api.paystack.co/transaction/verify/$transactionRef";

try {
    // Initialize cURL
    $ch = curl_init();

    if (!$ch) {
        throw new Exception("Failed to initialize cURL.");
    }

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $verificationUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $paystackSecretKey",
    ]);

    // Execute cURL
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        throw new Exception("cURL Error: " . curl_error($ch));
    }

    // Decode the response
    $result = json_decode($response, true);

    // Check for JSON decode errors
    if ($result === null) {
        throw new Exception("JSON Decode Error: " . json_last_error_msg());
    }

    // Check Paystack API response
    if (!$result['status']) {
        throw new Exception("Payment verification failed: " . $result['message']);
    }

    // Close the cURL handle
    curl_close($ch);

} catch (Exception $e) {
    // Handle exceptions
    error_log($e->getMessage()); // Log the error for debugging
    die("Error occurred: " . $e->getMessage());
}    
$result = json_decode($response, true);

if ($result && $result['status'] && $result['data']['status'] == 'success') {
    // Determine reference (Paystack returns it in data.reference)
    $transactionRef = $result['data']['reference'] ?? ($_GET['reference'] ?? null);

    if (!$transactionRef) {
        die("No transaction reference provided.");
    }

    // get registration by payment_reference
    $row = $crud->getStudentByReference($transactionRef);
    if (!$row) {
        error_log("No registration found for reference: $transactionRef");
        die("No registration found for this transaction reference.");
    }

    // if already paid, redirect
    if (isset($row['status']) && $row['status'] === 'paid') {
        header("Location: ../success.php");
        exit;
    }

    // mark as paid
    $mark = $crud->markStudentPaid($transactionRef);
    if (!$mark['success']) {
        error_log("Failed to mark paid: " . ($mark['error'] ?? 'unknown'));
        die("Server error while finalizing registration.");
    }

    // Send SMS using your sendSms function
    if (function_exists('sendSms')) {
        $message = "Dear {$row['first_name']}, your payment and registration was successful. Your room number is {$row['room_number']}. Welcome to SAFO HALL.";
        sendSms($row['contact'], $message);
    }

    header("Location: ../success.php");
    exit;
} else {
    require_once __DIR__ . '/errMessage.php';
    echo "Payment verification failed: " . ($result['message'] ?? 'Unknown error');
    exit;
}