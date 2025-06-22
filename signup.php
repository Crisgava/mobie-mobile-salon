<?php
include 'auth.php';
require 'functions.php';

// Establish database connection
$host = getenv("host");
$username = getenv("host_username");
$pass = getenv("host_userpass");
$db = getenv("host_db");
$conn = new mysqli($host, $username, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form was submitted:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1) Collect & sanitize
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    $location = trim($_POST['location'] ?? '');

    $errors = [];

    // 2) Validate
    if (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }
    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }
    if ($location === '') {
        $errors[] = "Please enter your location.";
    }

    // 3) Check email uniqueness
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "That email is already registered.";
        }
        $stmt->close();
    }

    // 4) If no errors, insert
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user';
        $status = 'active';

        $stmt = $conn->prepare("
            INSERT INTO users (username, email, password, user_role, status, location)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "ssssss",
            $username,
            $email,
            $hash,
            $role,
            $status,
            $location
        );
        if ($stmt->execute()) {
            $_SESSION['signup_success'] = "Registration successful! Please log in.";
            header("Location: acc_created.php");
            exit;
        } else {
            $errors[] = "Database error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Mobie Mobile Salon</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .errors {
            background: #ffe6e6;
            padding: 10px;
            border: 1px solid #ffcccc;
            margin-bottom: 15px;
        }

        .errors li {
            color: #cc0000;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: var(--primary-color, #007bff);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: var(--primary-hover, #0056b3);
        }
    </style>
</head>

<body>
<header>
      <h1><a href="index.php" style="text-decoration: none; color: inherit;">Mobie Mobile Salon</a></h1>
   </header>
   <main>
   <div class="container">
        <h2>Create Account</h2>

        <?php if (!empty($errors)): ?>
            <ul class="errors">
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" required
                    value="<?= htmlspecialchars($username ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" required value="<?= htmlspecialchars($email ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input id="location" name="location" type="text" required
                    value="<?= htmlspecialchars($location ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input id="confirm_password" name="confirm_password" type="password" required>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>

        <p style="text-align:center; margin-top:10px;">
            Already have an account? <a href="login.php">Log in</a>
        </p>
    </div>
   </main>
</body>

</html>