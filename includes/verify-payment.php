<?php
require_once 'includes/db_conn.php';
require_once 'includes/session.php';

$paystackSecretKey = 'sk_live_956a88d5f75a2cfc07f189c166af748633f74b80';

// Get the reference from the query string
$transactionRef = $_GET['reference'] ?? null;

if (!$transactionRef) {
    die("No transaction reference provided.");
}

// Verify the payment with Paystack
$verificationUrl = "https://api.paystack.co/transaction/verify/$transactionRef";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $verificationUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $paystackSecretKey",
]);

$response = curl_exec($ch);
curl_close($ch);

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