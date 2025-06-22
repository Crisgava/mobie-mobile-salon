<?php
include 'auth.php';
require 'functions.php';

$host = getenv('host');
$user = getenv('host_username');
$pass = getenv('host_userpass');
$dbName = getenv('host_db');
$conn = new mysqli($host, $user, $pass, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Retrieve & sanitize form inputs
    $clientName = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $time = trim($_POST['time'] ?? '');
    $instructions = trim($_POST['instructions'] ?? '');

    // 2. Basic validation
    $errors = [];
    if ($clientName === '')
        $errors[] = 'Name is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = 'Valid email is required.';
    if ($phone === '')
        $errors[] = 'Phone is required.';
    if ($service === '')
        $errors[] = 'Please select a service.';
    if ($date === '')
        $errors[] = 'Please choose a date.';
    if ($time === '')
        $errors[] = 'Please choose a time.';

    if (empty($errors)) {
        // 3. Insert into database
        $stmt = $conn->prepare("
          INSERT INTO bookings 
            (name, email, phone, service, location, date, time, instructions, status) 
          VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, 'pending')
      ");
        $stmt->bind_param(
            "ssssssss",
            $clientName,
            $email,
            $phone,
            $service,
            $location,
            $date,
            $time,
            $instructions
        );

        if ($stmt->execute()) {
            // 4. Success – redirect or show message
            $_SESSION['flash_success'] = "Your booking has been submitted! We will confirm soon.";
            header("Location: booking_success.php");
            exit();
        } else {
            $errors[] = "Database error: " . $stmt->error;
        }
        $stmt->close();
    }
    // If we reach here, either validation or DB error occurred
    $_SESSION['flash_errors'] = $errors;
    header("Location: book.php"); // redirect back to form
    exit();
}
?>