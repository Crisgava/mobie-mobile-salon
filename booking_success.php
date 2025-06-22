<?php
// Optional: Start session or check for booking confirmation flag
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Booking Successful</title>
  <meta http-equiv="refresh" content="5; url=pay_settings.php">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f8fb;
      color: #333;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      flex-direction: column;
    }

    .card {
      background: white;
      padding: 2rem 3rem;
      border-radius: 12px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    h1 {
      color: #28a745;
    }

    p {
      margin-top: 10px;
      font-size: 1.1rem;
    }
  </style>
</head>

<body>
  <div class="card">
    <h1>✅ Booking Successful</h1>
    <p>Thank you! Your booking has been received.</p>
    <p>You will be redirected to the homepage shortly...</p>
  </div>
</body>

</html>