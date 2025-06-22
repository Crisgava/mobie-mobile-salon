<?php
include 'auth.php';
require 'functions.php';

$prefillService = $_GET['service'] ?? '';

$dashboardUrl = '';
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  // Set dashboard URL based on the user's role
  $dashboardUrl = ($_SESSION["role"] === "admin") ? "admin_dash.php" : "dashboard.php";
} else {
  // If not logged in, direct the user to the login page
  $dashboardUrl = "login.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking - Mobie Mobile Salon</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      padding: 20px;
      margin: 0;
    }

    #booking {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #booking h2 {
      text-align: center;
      color: #d2691e;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1rem;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #d2691e;
      color: #fff;
      text-decoration: none;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-size: 1rem;
    }

    .btn:hover {
      background-color: #b85e17;
    }

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
          <img src="icons/logout.png" alt="">
          <span class="tooltip-text">Logout</span>
        </a>
      <?php else: ?>
        <?php echo htmlspecialchars('Guest'); ?>
      <?php endif; ?>
    </span>

  </div>

  <header>
    <div class="container">
      <h1>Mobie Mobile Salon</h1>
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="<?php echo $dashboardUrl; ?>">Dashboard</a></li>
          <li><a href="about.php">Contact Us</a></li>
          <li><a href="services.php">Our services</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <section id="booking">
      <h2>Book Our Services</h2>
      <form action="book_service.php" method="post" id="bookingForm">
        <div class="form-group">
          <label for="name">Your Name</label>
          <input type="text" id="name" name="name" placeholder="John Doe" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" placeholder="john@example.com" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" placeholder="+256712345678" required>
        </div>
        <div class="form-group">
          <label for="service">Select a Service</label>
          <select id="service" name="service" required>
            <option value="" disabled <?= $prefillService === '' ? 'selected' : '' ?>>Select a Service</option>
            <?php
            $services = ['Hair Cut', 'Hair Coloring', 'Hair Styling', 'Beard cut', 'Waxing', 'Manicure', 'Hair Treatment', 'Pedicure', 'Facial', 'Makeup Application', 'Eyebrow Shaping'];
            foreach ($services as $svc):
              $sel = ($svc === $prefillService) ? 'selected' : '';
              ?>
              <option value="<?= htmlspecialchars($svc) ?>" <?= $sel ?>>
                <?= htmlspecialchars($svc) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="service">Preferred Location</label>
          <input type="text" id="location" name="location" placeholder="Lugogo" required>
        </div>
        <div class="form-group">
          <label for="date">Preferred Date</label>
          <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
          <label for="time">Preferred Time</label>
          <input type="time" id="time" name="time" required>
        </div>
        <div class="form-group">
          <label for="instructions">Additional Instructions</label>
          <textarea id="instructions" name="instructions" rows="4"
            placeholder="Enter any additional details here..."></textarea>
        </div>
        <button type="submit" class="btn">Book Now</button>
      </form>
    </section>
    <br><br>
  </main>
  <br><br>
  <footer>
    <div class="social-media">
      <a href="[Facebook Link]"><img src="icons/facebook.png" alt="Facebook"></a>
      <a href="[Twitter Link]"><img src="icons/twitter.png" alt="Twitter"></a>
      <a href="[Instagram Link]"><img src="icons/instagram.png" alt="Instagram"></a>
    </div>
    <div class="contact-info">
      <p>Phone: 0779099356</p>
      <p>Email: info@mobiemobile.com</p>
    </div>
    <p>&copy; <?php echo date("Y"); ?> Mobie Mobile Salon</p>
  </footer>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const phoneInput = document.getElementById("phone");
  phoneInput.value = "+256"; // default start

  phoneInput.addEventListener("keydown", function (e) {
    // Allow control keys
    if (
      ["Backspace", "Delete", "ArrowLeft", "ArrowRight", "Tab"].includes(e.key)
    ) return;

    // Prevent deleting "+256"
    if (this.selectionStart < 4) {
      e.preventDefault();
      return;
    }

    // Allow digits only
    if (!/[0-9]/.test(e.key) || this.value.length >= 13) {
      e.preventDefault();
    }
  });

  phoneInput.addEventListener("input", function () {
    // Ensure the input always starts with +256
    if (!this.value.startsWith("+256")) {
      this.value = "+256";
    }
  });

  // Name validation
  const nameInput = document.getElementById("name");
  nameInput.setAttribute("maxlength", "50");
  nameInput.setAttribute("pattern", "[A-Za-z ]+");
  nameInput.setAttribute("title", "Only letters and spaces are allowed");

  // Email validation
  const emailInput = document.getElementById("email");
  emailInput.setAttribute("maxlength", "100");
  emailInput.setAttribute(
    "pattern",
    "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$"
  );
  emailInput.setAttribute(
    "title",
    "Enter a valid email and must end with .com and with small letters like user@example.com"
  );
});
</script>
</body>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form"); // adjust if your form has an ID
  const emailInput = document.getElementById("email");

  form.addEventListener("submit", function (e) {
    const email = emailInput.value;

    const emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.com$/;

    if (!emailRegex.test(email)) {
      alert("Email must be lowercase and end with .com, e.g., user@example.com");
      emailInput.focus();
      e.preventDefault(); // block form submission
    }
  });
});
</script>
</html>