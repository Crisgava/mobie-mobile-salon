<?php
include 'auth.php';
require 'functions.php';

$stylist = $_SESSION['username'];

$host = getenv("host");
$username = getenv("host_username");
$pass = getenv("host_userpass");
$db = getenv("host_db");
$conn = new mysqli($host, $username, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch Today's Bookings
$stmtToday = $conn->prepare("
    SELECT * FROM bookings
    WHERE provider = ? 
      AND DATE(date) = CURDATE()
    ORDER BY time
");
$stmtToday->bind_param("s", $stylist);
$stmtToday->execute();
$todayResult = $stmtToday->get_result();

// Fetch Upcoming Bookings (future dates)
$stmtUpcoming = $conn->prepare("
    SELECT * FROM bookings
    WHERE provider = ? 
      AND DATE(date) > CURDATE()
    ORDER BY date, time
");
$stmtUpcoming->bind_param("s", $stylist);
$stmtUpcoming->execute();
$upcomingResult = $stmtUpcoming->get_result();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'], $_POST['action'])) {
    $bookingId = intval($_POST['booking_id']);
    $action = $_POST['action'];

    // Set status based on the action received
    $status = 'Accepted';

    // Prepare and execute the update statement
    $stmt = $conn->prepare("UPDATE bookings SET status = ?, provider = ? WHERE id = ?");
    $stmt->bind_param("ssi", $status, $stylist, $bookingId);
    $stmt->execute();
    $stmt->close();

    // Redirect to the same page to refresh the list
    header("Location: stylist_dash.php");
    exit();
}

// Fetch pending bookings from the database
$result = $conn->query("SELECT * FROM bookings WHERE status = 'pending'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Activity Manager</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: var(--primary-color);
            color: #fff;
        }

        button {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button.approve {
            background-color: var(--success-color);
            color: #fff;
        }

        button.reject {
            background-color: var(--danger-color);
            color: #fff;
        }

        button.approve:hover {
            background-color: #218838;
        }

        button.reject:hover {
            background-color: #c82333;
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

<body style="padding: 2rem;">
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
        <h1>My Activity Manager</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About & Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Service</th>
                    <th>Date & Time</th>
                    <th>Instructions</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['service']); ?></td>
                        <td><?php echo htmlspecialchars($booking['date']) . " " . htmlspecialchars($booking['time']); ?>
                        </td>
                        <td><?php echo htmlspecialchars($booking['instructions']); ?></td>
                        <td><?php echo htmlspecialchars($booking['status']); ?></td>
                        <td>
                            <!-- Approve form -->
                            <form method="post" style="display:inline-block;">
                                <input type="hidden" name="booking_id"
                                    value="<?php echo htmlspecialchars($booking['id']); ?>">
                                <button type="submit" name="action" value="accept" class="approve">Accept</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Today's Bookings -->
        <h2>Today's Bookings (<?php echo date('Y-m-d'); ?>)</h2>
        <table>
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Service</th>
                    <th>Time</th>
                    <th>Instructions</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($todayResult->num_rows): ?>
                    <?php while ($row = $todayResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['service']); ?></td>
                            <td><?php echo htmlspecialchars($row['time']); ?></td>
                            <td><?php echo htmlspecialchars($row['instructions']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No bookings for today.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Upcoming Bookings -->
        <h2>Upcoming Bookings</h2>
        <table>
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($upcomingResult->num_rows): ?>
                    <?php while ($row = $upcomingResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['service']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['time']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No upcoming bookings.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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