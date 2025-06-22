<?php
include 'auth.php';
require 'functions.php';

$dashboardUrl = '';
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  // Set dashboard URL based on the user's role
  if ($_SESSION["role"] === "admin") {
    $dashboardUrl = "admin_dash.php";
  } elseif ($_SESSION["role"] === "stylist") {
    $dashboardUrl = "stylist_dash.php";
  } else {
    $dashboardUrl = "dashboard.php";
  }

} else {
  // If not logged in, direct the user to the login page
  $dashboardUrl = "login.php";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mobie Mobile Salon</title>
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

    .testimonial-carousel {
      max-width: 60%;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      position: relative;
      justify-content: center;
    }

    .testimonial-item {
      display: none;
      max-width: 80%;
      margin: auto;
      text-align: center;
    }

    .testimonial-item.active {
      display: block;
      max-width: 50%;
    }

    .testimonial-text {
      font-size: 1.2rem;
      font-style: italic;
      color: #555;
      max-width: 90%;
    }

    .testimonial-client {
      font-weight: bold;
      margin-top: 10px;
    }

    .carousel-buttons {
      display: flex;
      justify-content: center;
      margin-top: 10px;
    }

    .carousel-button {
      background-color: #d2691e;
      color: white;
      border: none;
      padding: 8px 15px;
      cursor: pointer;
      border-radius: 5px;
      margin: 0 5px;
      transition: background 0.3s;
    }

    .carousel-button:hover {
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

  <!-- Header & Navigation -->
  <header>
    <div class="container">
      <h1>Welcome to Mobie Mobile Salon</h1>
      <nav style="padding-top: 10px;">
        <ul>
          <li><a href="<?php echo $dashboardUrl; ?>">Dashboard</a></li>
          <li><a href="about.php">Contact Us</a></li>
          <li><a href="services.php">Our services</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main style="padding-left: 15%; padding-right: 15%;">
    <h2 style="text-align:center; margin-bottom:1rem; color: var(--primary-color);">Experience Luxury & Style at the
      Best Salon in Town</h2>
    <p>At Mobie Mobile Salon, we believe that beauty is not just about appearance; it’s about confidence and self-care.
      Our team of skilled professionals is dedicated to giving you an unforgettable salon experience that leaves you
      looking and feeling your best.</p>
    <h2 style="text-align:center; margin-bottom:1rem; color: var(--primary-color);">Our Services</h2>
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

    <!-- Testimonial Carousel -->
    <h2 style="text-align:center; margin-bottom:1rem; color: var(--primary-color);">What Our Clients Say</h2>
    <section id="testimonial-carousel">
      <div class="testimonial-item active">
        <p class="testimonial-text">"Amazing service! My haircut was perfect and the staff was very friendly."</p>
        <p class="testimonial-client">John Doe</p>
      </div>

      <div class="testimonial-item">
        <p class="testimonial-text">"The massage was so relaxing! I'll definitely come back for another one."</p>
        <p class="testimonial-client">Sarah M.</p>
      </div>

      <div class="testimonial-item">
        <p class="testimonial-text">"I loved the hair color they recommended! It suits me so well."</p>
        <p class="testimonial-client">Michael B.</p>
      </div>

      <!-- Navigation Buttons -->
      <div class="carousel-buttons">
        <button class="carousel-button" onclick="prevTestimonial()">&#9665; Prev</button>
        <button class="carousel-button" onclick="nextTestimonial()">Next &#9655;</button>
      </div>
    </section>
    <br><br>
  </main>
  <!-- Footer -->
  <footer>
    <div class="container">
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
    </div>
  </footer>

  <div class="chat-container">
    <!-- Live Chat Button -->
    <button class="chat-button" onclick="toggleChat('liveChat')">
      <span class="tooltip">
        <img src="icons/support.png">
        <p class="tooltip-text">Live Chat</p>
      </span>
    </button>

    <!-- Chatbot Button -->
    <button class="chat-button chatbot" onclick="toggleChat('chatbot')">
      <span class="tooltip">
        <img src="icons/chatbot.png">
        <p class="tooltip-text">Chat with Gideon</p>
      </span>
    </button>

    <!-- Live Chat Window -->
    <div class="chat-box" id="liveChat">
      <div class="chat-header">
        <img src="icons/button.png" alt=""> Live Chat
        <button class="close-chat" onclick="toggleChat('liveChat')">✖</button>
      </div>
      <div class="chat-body">
        <div class="chat-message admin-message">
          <p>Hello! My name is John Clement. How may I assist you today?</p>
          <span class="chat-timestamp">10:30 AM</span>
        </div>
        <div class="chat-message user-message">
          <p>I need help with my booking.</p>
          <span class="chat-timestamp" style="color: white;">10:31 AM</span>
        </div>
      </div>
      <div class="chat-footer">
        <input type="text" placeholder="Type a message...">
        <button>Send</button>
      </div>
    </div>

    <!-- Chatbot Window -->
    <div class="chat-box" id="chatbot">
      <div class="chat-header">
        <img src="icons/chatbot.png" alt=""> Chat with Gideon
        <button class="close-chat" onclick="toggleChat('chatbot')">✖</button>
      </div>
      <div class="chat-body">
        <div class="chat-message bot-message">
          <p>Hello! I am your virtual assistant Gideon. Ask me anything about our services!</p>
          <span class="chat-timestamp" style="color: white;">10:32 AM</span>
        </div>
      </div>
      <div class="chat-footer">
        <input type="text" placeholder="Ask me something...">
        <button>Send</button>
      </div>
    </div>
  </div>


  <script>
    // This js is controlling the reviews at the bottom of the home page.
    let currentIndex = 0;
    const testimonials = document.querySelectorAll('.testimonial-item');

    function showTestimonial(index) {
      testimonials.forEach((item, i) => {
        item.classList.toggle('active', i === index);
      });
    }

    function nextTestimonial() {
      currentIndex = (currentIndex + 1) % testimonials.length;
      showTestimonial(currentIndex);
    }

    function prevTestimonial() {
      currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
      showTestimonial(currentIndex);
    }

    function toggleChat(chatId) {
      let chatBoxes = document.querySelectorAll(".chat-box");

      chatBoxes.forEach(chat => {
        if (chat.id === chatId) {
          // Toggle the selected chat
          chat.style.display = (chat.style.display === "none" || chat.style.display === "") ? "block" : "none";
        } else {
          // Close any other open chats
          chat.style.display = "none";
        }
      });
    }

    // Auto-slide reviews every 5 seconds
    setInterval(nextTestimonial, 5000);
  </script>
</body>

</html>