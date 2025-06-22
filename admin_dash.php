<?php
include 'auth.php';

require 'functions.php';

$host = getenv("host");
$username = getenv("host_username");
$pass = getenv("host_userpass");
$db = getenv("host_db");
$conn = new mysqli($host, $username, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['action'])) {
    $userId = intval($_POST['user_id']);
    $action = $_POST['action'];

    if ($action === 'toggle_status') {
        // Change account status
        $newStatus = $_POST['current_status'] === 'active' ? 'inactive' : 'active';
        $stmt = $conn->prepare("UPDATE users SET status = ? WHERE user_id = ?");
        $stmt->bind_param("si", $newStatus, $userId);
    } elseif ($action === 'change_role' && in_array($_POST['new_role'], ['user', 'stylist', 'admin'])) {
        $newRole = $_POST['new_role'];
        $stmt = $conn->prepare("UPDATE users SET user_role = ? WHERE user_id = ?");
        $stmt->bind_param("si", $newRole, $userId);
    }
    if (isset($stmt)) {
        $stmt->execute();
        $stmt->close();
    }
    header("Location: admin_dash.php");
    exit();
}

// Fetch all users
$result = $conn->query("SELECT user_id, username, email, user_role, status FROM users WHERE user_role <> 'admin' ORDER BY username");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: var(--primary-color);
            color: #fff;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 120px;
        }

        .btn-status {
            background: #28a745;
            color: #fff;
        }

        .btn-status.inactive {
            background: #dc3545;
        }

        .btn-role {
            background: #6c757d;
            color: #fff;
        }

        select {
            padding: 4px;
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
        <h1>User management</h1>
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
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['user_id']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['user_role']) ?></td>
                        <td><?= htmlspecialchars($user['status']) ?></td>
                        <td>
                            <!-- Toggle Active/Inactive -->
                            <form method="post" style="display:inline-block;">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <input type="hidden" name="current_status" value="<?= htmlspecialchars($user['status']) ?>">
                                <button type="submit" name="action" value="toggle_status"
                                    class="btn btn-status <?= $user['status'] === 'inactive' ? 'inactive' : '' ?>">
                                    <?= $user['status'] === 'active' ? 'Deactivate' : 'Activate' ?>
                                </button>
                            </form>

                            <!-- Change Role -->
                            <form method="post" style="display:inline-block;">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <select name="new_role">
                                    <?php foreach (['user', 'stylist', 'admin'] as $role): ?>
                                        <option value="<?= $role ?>" <?= $user['user_role'] === $role ? 'selected' : '' ?>>
                                            <?= ucfirst($role) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" name="action" value="change_role" class="btn btn-role">
                                    Change
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
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