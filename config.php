<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$dbuser = "";         // default for localhost if you're not using a custom user
$dbpass = "";// enter your MySQL root password here (often empty on local)
$dbname = "";      // ✅ this is your actual database name

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>