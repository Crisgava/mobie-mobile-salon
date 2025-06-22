<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Successful</title>
    <meta http-equiv="refresh" content="5; url=index.php"> <!-- This part handles auto redirection -->
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
            color: red;
        }

        p {
            margin-top: 10px;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>😴 Account Inactive</h1>
        <p>Unfortunately, the account was deactivated.</p>
        <p>You will be redirected to the homepage shortly...</p>
    </div>
</body>

</html>