<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

// ✅ INCLUDE config, NOT this file itself!
require_once(__DIR__ . '/../config.php');

$data = json_decode(file_get_contents("php://input"), true);
$email = $data["email"];
$password = $data["password"];

if (!$email || !$password) {
    echo json_encode(["status" => "error", "message" => "Missing fields"]);
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    echo json_encode([
        "status" => "success",
        "user" => [
            "id" => $user["id"],        // ✅ make sure this is included
            "name" => $user["name"],
            "role" => $user["role"]
        ]
    ]);

} else {
    echo json_encode(["status" => "fail", "message" => "Invalid credentials"]);
}
?>