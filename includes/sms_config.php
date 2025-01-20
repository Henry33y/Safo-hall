<?php
require_once __DIR__.'/loadenv.php';

function sendSms($phoneNumber, $message)
{
    try {
        loadEnv(__DIR__ . '/../.env'); // Adjust the path if needed
    } catch (Exception $e) {
        die($e->getMessage());
    }
    // Arkesel SMS API key
    $apiKey = $_ENV['ARKESEL_API_KEY'];
    $sender = $_ENV['ARKESEL_SENDER_ID'];

    // Initialize cURL
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://sms.arkesel.com/api/v2/sms/send',
        CURLOPT_HTTPHEADER => ['api-key: ' . $apiKey],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query([
            'sender' => $sender,
            'message' => $message,
            'recipients' => [$phoneNumber],
            'sandbox' => true, // Set to false for live messages
        ]),
    ]);

    // Execute the cURL request
    $response = curl_exec($curl);

    // Check for cURL errors
    if ($response === false) {
        $error = curl_error($curl);
        curl_close($curl);
        return "cURL Error: " . $error;
    }

    // Close the cURL session
    curl_close($curl);

    // Return the API response
    return $response;
}