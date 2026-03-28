<?php

// Simple example: Shoptet order webhook -> Google Sheets row append

$rawPayload = file_get_contents('php://input');
$data = json_decode($rawPayload, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON payload']);
    exit;
}

// Example mapping - adjust field names according to real webhook payload
$orderId = $data['order']['code'] ?? '';
$createdAt = $data['order']['createdAt'] ?? '';
$firstName = $data['order']['billingAddress']['firstName'] ?? '';
$lastName = $data['order']['billingAddress']['lastName'] ?? '';
$email = $data['order']['email'] ?? '';
$phone = $data['order']['billingAddress']['phone'] ?? '';
$country = $data['order']['billingAddress']['countryCode'] ?? '';
$currency = $data['order']['currency']['code'] ?? '';
$totalPrice = $data['order']['price']['withVat'] ?? '';
$orderStatus = $data['order']['status'] ?? '';
$deliveryMethod = $data['order']['deliveryMethod']['name'] ?? '';
$paymentMethod = $data['order']['paymentMethod']['name'] ?? '';
$customerNote = $data['order']['customerNote'] ?? '';

$products = [];
if (!empty($data['order']['items']) && is_array($data['order']['items'])) {
    foreach ($data['order']['items'] as $item) {
        $name = $item['name'] ?? 'Produkt';
        $quantity = $item['quantity'] ?? 1;
        $products[] = $name . ' (' . $quantity . ' ks)';
    }
}

$productsString = implode(', ', $products);

// Google Sheets config
$spreadsheetId = 'YOUR_SPREADSHEET_ID';
$sheetName = 'Orders';
$accessToken = 'YOUR_GOOGLE_ACCESS_TOKEN';

$row = [
    [
        $orderId,
        $createdAt,
        trim($firstName . ' ' . $lastName),
        $email,
        $phone,
        $country,
        $currency,
        $totalPrice,
        $orderStatus,
        $deliveryMethod,
        $paymentMethod,
        $productsString,
        $customerNote
    ]
];

$url = 'https://sheets.googleapis.com/v4/spreadsheets/' . $spreadsheetId . '/values/' . urlencode($sheetName . '!A1') . ':append?valueInputOption=USER_ENTERED';

$body = json_encode([
    'values' => $row
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $accessToken,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Google Sheets request failed',
        'details' => curl_error($ch)
    ]);
    curl_close($ch);
    exit;
}

curl_close($ch);

if ($httpCode < 200 || $httpCode >= 300) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Google Sheets API returned an error',
        'http_code' => $httpCode,
        'response' => $response
    ]);
    exit;
}

http_response_code(200);
echo json_encode([
    'success' => true,
    'message' => 'Order appended to Google Sheets'
]);