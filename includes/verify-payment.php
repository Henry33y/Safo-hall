<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__.'/db_conn.php';
require_once __DIR__. '/session.php';
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
        $area = $formData['area'] ?? 'None';
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
            $area,
            $roomNumber
        );

        if ($isSuccess['success']) {
            // require_once __DIR__ . '/successMessage.php';
            // Send SMS notification
            $message = "Dear $firstName, your payment and registration was successful. Your room number is $roomNumber. Welcome to SAFO HALL.";
            $response = sendSms($contact, $message);
            if ($response) {
                // var_dump("SMS notification sent: $response");
                error_log("SMS notification sent: $response");
            } else {
                error_log("Failed to send SMS notification.");
            }
            echo "<script>window.location.href='../success.php'</script>";
        } else {
            require_once __DIR__. '/errMessage.php';
        }
        unset($_SESSION['form_data']);
    } else {
        echo "No form data found.";
    }
} else {
    // Payment failed
    require_once __DIR__ . '/errMessage.php';
    echo "Payment verification failed: " . $result['message'];
    exit;
}