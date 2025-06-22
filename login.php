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

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Get and sanitize inputs
   $useremail = trim($_POST["useremail"]);
   $password = trim($_POST["password"]);

   // Prepare statement to prevent SQL injection
   $stmt = $conn->prepare("SELECT user_id, username, email, password, user_role, status FROM users WHERE email = ?");
   $stmt->bind_param("s", $useremail);
   $stmt->execute();
   $result = $stmt->get_result();

   // Check if user exists and verify password
   if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();
      if (password_verify($password, $row["password"])) {
         // Correct credentials, start a session
         $_SESSION["loggedin"] = true;
         $_SESSION["user_id"] = $row["user_id"];
         $_SESSION["username"] = $row["username"];
         $_SESSION["role"] = $row["user_role"];
         $_SESSION["email"] = $row["email"];


         $role = $row["user_role"];

         // This statement checks if the user account is active and redirects accordingly.
         if ($role === 'admin' && $row['status'] === 'active') {
            header("Location: admin_dash.php");
         } elseif ($role === "stylist" && $row['status'] === 'active') {
            header("Location: stylist_dash.php");
         } elseif ($role === 'user' && $row['status'] === 'active') {
            header("Location: dashboard.php");
         } else {
            session_unset();   // Unset all session variables
            session_destroy(); // Destroy the session
            header("Location: account_inactive.php");
         }

         exit;
      } else {
         $error = "Invalid email or password.";
      }
   } else {
      $error = "Invalid email or password.";
   }
   $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login - Mobie Mobile Salon</title>
   <link rel="stylesheet" href="style.css">
   <style>
      /* Login Page Specific Styles */
      .login-container {
         max-width: 400px;
         margin: 50px auto;
         padding: 20px;
         background-color: #fff;
         border: 1px solid #ddd;
         border-radius: 8px;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .login-container h2 {
         text-align: center;
         margin-bottom: 20px;
         color: #333;
      }

      .login-container label {
         display: block;
         font-weight: bold;
         margin-bottom: 5px;
         color: #333;
      }

      .login-container input[type="email"],
      .login-container input[type="password"] {
         width: 100%;
         padding: 10px;
         margin-bottom: 15px;
         border: 1px solid #ccc;
         border-radius: 5px;
      }

      .login-container button {
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

      .login-container button:hover {
         background-color: var(--primary-hover, #0056b3);
      }

      .error {
         color: var(--danger-color, #dc3545);
         text-align: center;
         margin-bottom: 15px;
      }
   </style>
</head>

<body>
   <header>
      <h1><a href="index.php" style="text-decoration: none; color: inherit;">Mobie Mobile Salon</a></h1>
   </header>
   <main>
      <div class="login-container">
         <h2>Login</h2>
         <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
         <?php endif; ?>
         <form action="login.php" method="post">
            <div>
               <label for="useremail">Email:</label>
               <input type="email" name="useremail" id="useremail" required>
            </div>
            <div>
               <label for="password">Password:</label>
               <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
         </form>
         <p style="text-align:center; margin-top:10px;">
            Have no account? <a href="signup.php">Sign-Up</a>
        </p>
      </div>
   </main>
   <footer>
      <p>&copy; <?php echo date("Y"); ?> Mobie Mobile Salon</p>
   </footer>
</body>

</html>