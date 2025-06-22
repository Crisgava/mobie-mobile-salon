<?php // about.php
include 'auth.php';
require 'functions.php';

$host = getenv("host");
$username = getenv("host_username");
$pass = getenv("host_userpass");
$db = getenv("host_db");

// Create a database connection
$conn = new mysqli($host, $username, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in user's identifier (assumed to be stored in 'username')
$currentUser = $_SESSION['email'];

// Use a prepared statement to safely retrieve bookings for the current user
$stmt = $conn->prepare("SELECT * FROM bookings WHERE email = ? ORDER BY date, time");
$stmt->bind_param("s", $currentUser);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Mobie Mobile Salon</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .status {
      position: fixed;
      top: 10px;
      right: 10px;
      background-color: rgba(0, 0, 0, 0.7);
      color: #fff;
      padding: 5px 10px;
      border-radius: 5px;
      z-index: 10;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .status img {
      width: 20px;
      height: 20px;
      border-radius: 50%;
    }

    /* Base styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 20px;
    }

    .dashboard-container {
      max-width: auto;
      margin: auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    /* Table styles */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table thead {
      background-color: #d2691e;
      color: #fff;
    }

    table th,
    table td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    table tbody tr:hover {
      background-color: #f1f1f1;
    }

    /* Status indicators */
    .status-approved {
      color: green;
      font-weight: bold;
    }

    .status-rejected {
      color: red;
      font-weight: bold;
    }

    /* Responsive design for smaller screens */
    @media (max-width: 600px) {

      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;
      }

      table tr {
        margin-bottom: 15px;
      }

      table td {
        padding: 10px;
        border: none;
        position: relative;
      }

      table td::before {
        content: attr(data-label);
        font-weight: bold;
        display: inline-block;
        width: 120px;
      }
    }
  </style>
</head>

<body>

  <!-- Status Bar -->
  <div class="status">
    <img src="icons/user.png" alt="User Profile">
    <span>
      Hello
      <?php
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <?php echo htmlspecialchars($_SESSION['username']); ?>
        <a href="logout.php" class="tooltip">
          <img src="icons/logout.png" alt="Logout">
          <span class="tooltip-text">Logout</span>
        </a>
      <?php else: ?>
        <?php echo htmlspecialchars('Guest'); ?>
      <?php endif; ?>
    </span>

  </div>
  <header>
    <h1>Mobie Mobile Salon</h1>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About & Contact</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="pay_settings.php">Payment Settings</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="dashboard-container">
      <h1>My Bookings</h1>
      <table>
        <thead>
          <tr>
            <th>Service</th>
            <th>Date</th>
            <th>Time</th>
            <th>Instructions</th>
            <th>Status</th>
            <th>Your provider</th>
            <th>Provider location</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($booking = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($booking['service']); ?></td>
              <td><?php echo htmlspecialchars($booking['date']); ?></td>
              <td><?php echo htmlspecialchars($booking['time']); ?></td>
              <td><?php echo htmlspecialchars($booking['instructions']); ?></td>
              <td><?php echo htmlspecialchars($booking['status']); ?></td>
              <td><?php echo htmlspecialchars($booking['provider']); ?></td>
              <td><?php echo htmlspecialchars($booking['location']); ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
  <footer>
    <div class="social-media">
      <a href="[Facebook Link]"><img src="icons/facebook.png" alt="Facebook"></a>
      <a href="[Twitter Link]"><img src="icons/twitter.png" alt="Twitter"></a>
      <a href="[Instagram Link]"><img src="icons/instagram.png" alt="Instagram"></a>
    </div>
    <div class="contact-info">
      <p>Phone: 0777777777</p>
      <p>Email: info@mobiemobile.com</p>
    </div>
    <p>&copy; <?php echo date("Y"); ?> Mobie Mobile Salon</p>
  </footer>
</body>

</html>