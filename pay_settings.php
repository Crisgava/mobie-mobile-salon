<?php
include 'auth.php';
require 'functions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Mobie Mobile Salon</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Enhanced status bar styling */
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

        main {
            max-width: 600px;
            margin: 2rem auto;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .method-list {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }

        .method-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8f8f8;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 4px;
        }

        .inline-form {
            margin: 0;
        }

        .remove-btn {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .remove-btn:hover {
            background: #c82333;
        }

        .add-method-form .form-group {
            margin-bottom: 1rem;
        }

        .add-method-form label {
            display: block;
            margin-bottom: 4px;
        }

        .add-method-form input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            background: #d2691e;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background: #b85e17;
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
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About & Contact</a></li>
                <li><a href="services.php">Services</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>My Payment Methods</h1>

        <!-- Sample Existing Methods -->
        <section id="existing-methods">
            <?php
            $methods = [
                ['type' => 'icons/visa.png', 'number' => '•••• •••• 1234', 'expiry' => '04/25'],
                ['type' => 'icons/MTN-MOMO.png', 'number' => '07********', 'expiry' => 'N/A']
            ];
            if (!empty($methods)): ?>
                <ul class="method-list">
                    <?php foreach ($methods as $m): ?>
                        <li>
                            <span class="method-type"><img width="40px" src="<?= htmlspecialchars($m['type']) ?>"></span>
                            <span class="method-type"><?= htmlspecialchars($m['number']) ?></span>
                            <span class="method-expiry">(exp: <?= htmlspecialchars($m['expiry']) ?>)</span>
                            <form method="post" class="inline-form">
                                <input type="hidden" name="method_id">
                                <button type="submit" class="remove-btn">Remove</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>You have no saved payment methods.</p>
            <?php endif; ?>
        </section>
        <br><br>
        <h2>Pay with Mobile Money</h2>
        <section id="add-method">
            <form method="post" class="add-method-form">
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="0712 345 678" required>
                </div>
                <div class="form-group">
                    <label for="provider">Provider</label>
                    <input type="text" id="provider" name="provider" placeholder="MTN/Airtel" required>
                </div>
                <button type="submit" class="btn">Verify and Save</button>
            </form>
        </section>
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