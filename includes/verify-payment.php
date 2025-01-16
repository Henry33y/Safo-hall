<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__.'/db_conn.php';
require_once __DIR__. '/session.php';

$paystackSecretKey = 'sk_live_956a88d5f75a2cfc07f189c166af748633f74b80';

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

    // Proceed with your logic
    echo "Payment verified successfully!";

} catch (Exception $e) {
    // Handle exceptions
    error_log($e->getMessage()); // Log the error for debugging
    die("Error occurred: " . $e->getMessage());
}    
$result = json_decode($response, true);

if ($result && $result['status'] && $result['data']['status'] == 'success') {
    // Payment was successful
    $formData = $_SESSION['form_data'] ?? null;

    if ($formData) {
        // Extract stored form data
        $firstName = $formData['first_name'];
        $lastName = $formData['last_name'];
        $studentId = $formData['student_id'];
        $email = $formData['email'];
        $category = $formData['category'];
        $programme = $formData['programme'];
        $level = $formData['level'];
        $contact = $formData['contact'];
        $parentName = $formData['parent_name'];
        $parentContact = $formData['parent_contact'];
        $disability = $formData['disability'] ?? 'None';
        $scholarshipSpecify = $formData['scholarship'] ?? 'None';
        $roomNumber = $formData['room_number'];

        // Save to the database
        $isSuccess = $crud->insertStudentInfo(
            $firstName,
            $lastName,
            $studentId,
            $category,
            $level,
            $programme,
            $contact,
            $email,
            $parentName,
            $parentContact,
            $disability,
            $scholarshipSpecify,
            $roomNumber
        );

        if ($isSuccess) {
            include 'includes/successMessage.php';
            echo "<script>window.location.href='success.php'</script>";
        } else {
            include 'includes/errMessage.php';
        }
    } else {
        echo "No form data found.";
    }
} else {
    // Payment failed
    include 'includes/errMessage.php';
    echo "Payment verification failed: " . $result['message'];
    exit;
}