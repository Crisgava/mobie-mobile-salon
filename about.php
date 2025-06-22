<?php // about.php
include 'auth.php';
require 'functions.php';

$dashboardUrl = '';
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // Set dashboard URL based on the user's role
    $dashboardUrl = ($_SESSION["role"] === "admin") ? "admin_dash.php" : "dashboard.php";
} else {
    // If not logged in, direct the user to the login page
    $dashboardUrl = "login.php";
}
//  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mobie Mobile Salon - About & Contact</title>
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
        <h1>Mobie Mobile Salon</h1>
        <nav>
            <ul>
                <li><a href="<?php echo $dashboardUrl; ?>">Dashboard</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="services.php">Our Services</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="about-container">
            <div class="about">
                <h2>About Us</h2>
                <p>Welcome to Mobie Mobile Salon, where beauty meets relaxation! 🌿✨</p>

                <p>At Mobie Mobile Salon, we believe that self-care is not just a luxury—it's a necessity. Our expert
                    stylists and beauty professionals are dedicated to providing top-tier hair, skin, and nail services
                    in a calm and welcoming environment. Whether you're here for a fresh haircut, a rejuvenating facial,
                    or a stunning manicure, we ensure a personalized experience that leaves you feeling confident and
                    refreshed.</P>
                <br>
                <h3>Why Choose Us?</h3>
                <p>✔ Experienced Professionals - Our talented team stays up-to-date with the latest trends and
                    techniques.</p>
                <p>✔ Premium Products - We use only high-quality, salon-grade products for exceptional results.</p>
                <p>✔ Relaxing Atmosphere - Step into our peaceful space and enjoy a moment of pure self-care.</p>
                <p>✔ Tailored Services - Every client is unique, and we customize our treatments to suit your style and
                    needs.</p>

                <p>Your beauty and well-being are our top priorities. Book an appointment today and let us help you
                    shine! 🌟</p>
            </div>
            <div class="contact" style="flex-wrap: wrap;">
                <div class="contact-form-container">
                    <h2>Contact Us</h2>
                    <p>Have any questions? Fill out the form below and we'll get back to you!</p>
                    <form action="contact_process.php" method="POST">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" placeholder="Enter subject" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Type your message here..."
                                required></textarea>
                        </div>

                        <button type="submit" class="submit-btn">Send Message</button>
                    </form>
                </div>

                <section class="map-container">
                    <div>
                        <h2>Find Us Here</h2>
                        <p>Visit us at our convenient location!</p>
                    </div>
                    <!-- Google Map Embed -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7488218289923!2d32.583746875328686!3d0.3381811996584932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbbae31f63ad7%3A0xabdd927afe42cf5d!2sAcacia%20Mall!5e0!3m2!1sen!2sug!4v1743412297734!5m2!1sen!2sug"
                        width="700" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </section>

            </div>
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