<?php
require_once __DIR__ . '/../config.php'; 
header("Content-Type: application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get regular form data
$timestamp = $_POST["timestamp"] ?? null;
$frame = $_POST["frame"] ?? null;
$helmet = $_POST["helmet"] ?? null;
$user_id = $_POST["user_id"] ?? null;

// Get image binary data
$imageData = file_get_contents($_FILES['image']['tmp_name']);

if (!$timestamp || !$frame || !$helmet || !$user_id || !$imageData) {
    echo json_encode(["status" => "error", "message" => "Missing data"]);
    exit();
}

$stmt = $conn->prepare("INSERT INTO detections (user_id, timestamp, frame_number, helmet_status, image) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isisb", $user_id, $timestamp, $frame, $helmet, $null);  // TEMP

// Use send_long_data for large image blobs
$stmt->send_long_data(4, $imageData);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "fail", "message" => $stmt->error]);
}
?>
