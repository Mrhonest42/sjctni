<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = ""; // Change if you have password
$db = "ACIC_instruments";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    http_response_code(400);
    die("Invalid JSON");
}

$mobile = $conn->real_escape_string($data['mobile'] ?? '');
$key = $conn->real_escape_string($data['key'] ?? '');
$items = $data['items'] ?? [];

if (empty($mobile) || empty($items) || empty($key)) {
    http_response_code(400);
    die("Missing required fields");
}

foreach ($items as $item) {
    $instrument = $conn->real_escape_string($item['instrument']);
    $count = intval($item['count']);
    $amount = intval($item['amount']);

    $sql = "INSERT INTO instruments (mobile, instrument, count, amount, purchase_key)
            VALUES ('$mobile', '$instrument', $count, $amount, '$key')";
    
    if (!$conn->query($sql)) {
        http_response_code(500);
        die("Query failed: " . $conn->error);
    }
}

echo "Inserted Successfully";