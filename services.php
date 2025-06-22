<?php // events.php
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mobie Mobile Salon - Services</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #b30059;
            background-color: #f9f1f5;
            padding: 5px 12px;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
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
        <h1>Mobie Mobile Salon</h1>
        <nav>
            <ul>
                <li><a href="<?php echo $dashboardUrl; ?>">Dashboard</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About & Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="services">
            <div class="service">
                <img src="icons/nail-polish.png"></img>
                <h3>Manicure</h3>
                <h4 class="price">UGX 15,500</h4>
                <p>Polish up your hands. Nail shaping, cuticle care,
                    and polish in classic or trendy styles.</p>
                <br><br>
                <a href="book.php?service=<?php echo urlencode('Manicure'); ?>" class="btn">Book Now</a>
            </div>

            <div class="service">
                <img src="icons/hair-treat.png"></img>
                <h3>Hair Treatment</h3>
                <h4 class="price">UGX 30,500</h4>
                <p>Treat your hair right. Nourishing masks and repair treatments to restore shine,
                    strength, and softness.</p>
                <br><br>
                <a href="book.php?service=<?php echo urlencode('Hair Treatment'); ?>" class="btn">Book Now</a>
            </div>

            <div class="service">
                <img src="icons/hair-dye.png"></img>
                <h3>Hair Coloring</h3>
                <h4 class="price">UGX 22,500</h4>
                <p>Add some flair! From highlights to full-color transformations,
                    we’ll help you achieve your dream shade.</p>
                <br><br>
                <a href="book.php?service=<?php echo urlencode('Hair Coloring'); ?>" class="btn">Book Now</a>
            </div>
        </section>
        <section id="services">
            <div class="service">
                <img src="icons/hairstyle.png"></img>
                <h3>Hair Cut</h3>
                <h4 class="price">UGX 4,500</h4>
                <p>A fresh new look! Whether you want a trim or a full makeover,
                    we cut and style your hair to match your vibe.</p>
                <br><br>
                <a href="book.php?service=<?php echo urlencode('Hair Cut'); ?>" class="btn">Book Now</a>
            </div>

            <div class="service">
                <img src="icons/beardtrim.png"></img>
                <h3>Beard Cut</h3>
                <h4 class="price">UGX 3,500</h4>
                <p>Even beards deserve some love! Whether you want a trim or a full makeover,
                    we cut and style your beard to match your vibe.</p>
                <br><br>
                <a href="book.php?service=<?php echo urlencode('Beard Cut'); ?>" class="btn">Book Now</a>
            </div>

            <div class="service">
                <img src="icons/hair.png"></img>
                <h3>Hair Styling</h3>
                <h4 class="price">UGX 30,500</h4>
                <p>Ready for an event or just want to feel great? We offer blowouts, curls, straightening,
                    and updos to match any occasion.</p>
                <br><br>
                <a href="book.php?service=<?php echo urlencode('Hair Styling'); ?>" class="btn">Book Now</a>
            </div>
        </section>
        <section id="services">
            <div class="service">
                <img src="icons/pedicure.png"></img>
                <h3>Pedicure</h3>
                <h4 class="price">UGX 13,500</h4>
                <p>Happy feet, happy you. Enjoy a relaxing foot soak, scrub, nail care, and a pop of polish.</p>
                <br><br>
                <a href="book.php?service=<?php echo urlencode('Pedicure'); ?>" class="btn">Book Now</a>
            </div>

            <div class="service">
                <img src="icons/face-mask.png"></img>
                <h3>Facial</h3>
                <h4 class="price">UGX 40,500</h4>
                <p>Glowing skin starts here. Cleanse, exfoliate, and moisturize your face
                    with personalized treatments.</p>
                <br><br>
                <a href="book.php?service=<?php echo urlencode('Facial'); ?>" class="btn">Book Now</a>
            </div>

            <div class="service">
                <img src="icons/cosmetics.png"></img>
                <h3>Makeup Application</h3>
                <h4 class="price">UGX 24,500</h4>
                <p>Look flawless for any event. From natural glam to full glam, we’ve got your look covered.</p>
                <br><br>
                <a href="book.php?service=<?php echo urlencode('Makeup Application'); ?>" class="btn">Book Now</a>
            </div>
        </section>
        <section id="services">
            <div class="service">
                <img src="icons/eyebrow.png"></img>
                <h3>Eyebrow Shaping</h3>
                <h4 class="price">UGX 22,500</h4>
                <p>Perfect arches. Threading, waxing, or tweezing to define your brows just right.</p>
                <br><br>
                <a href="book.php?service=<?php echo urlencode('Eyebrow Shaping'); ?>" class="btn">Book Now</a>
            </div>

            <div class="service">
                <img src="icons/waxing.png"></img>
                <h3>Waxing</h3>
                <h4 class="price">UGX 60,500</h4>
                <p>Smooth skin, no fuss. Gentle hair removal for legs, arms or face</p>
                <br><br>
                <a href="book.php?service=<?php echo urlencode('Waxing'); ?>" class="btn">Book Now</a>
            </div>
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