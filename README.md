# Saloon-Web-App
Saloon web app for us students written in html, css, js and php.
Salon-Web-App
Salon web app for we students written in html, css, js, mysql and php.

💇‍♀ Mobie - Mobile Salon Web Application
📘 Description
Mobie is a mobile salon web application designed to bring salon services directly to clients' homes through a seamless online experience. Users can book hairdressing, nail care, and other beauty services on demand, while salon professionals manage bookings and services via a dashboard.

This system was developed as a final year project for the Uganda Institute of Information and Communications Technology (UICT), showcasing practical implementation of full-stack web development using PHP and MySQL.

✨ Features
🔐 User registration and login (Clients and Salon Professionals)
🧖 Browse and search for available salon services
🗓 Book appointments with time and date selection
🧾 View and manage booking history
🤖 Integrated AI-powered chatbot for user support
🛠 Admin dashboard for user and service management
📱 Mobile-responsive design
🧰 Technologies Used
Frontend: HTML5, CSS3, JavaScript, Bootstrap
Backend: PHP (Core PHP)
Database: MySQL
Server: WampServer (Local Development Environment)
🗃 Database Structure
The application includes the following key tables:

users – Stores user profiles (clients and service providers)
services – Contains service names, prices, and descriptions
bookings – Records client bookings with time and status
chat_history – Logs chatbot interaction history
admin – Manages admin authentication and controls
🚀 Installation Guide
To run Mobie locally on your machine:

✅ Install WampServer or similar PHP local server.
✅ Download or clone this repository: git clone https://github.com/GideonNiwaha/mobile-salon-web-app-final-year-project.git
sql Copy Edit 3. ✅ Move the project folder to your Wamp www directory. 4. ✅ Import the saloon.sql file into your MySQL server using phpMyAdmin. 5. ✅ Update database credentials in config.php:

$conn = new mysqli("localhost", "root", "", "saloon");
✅ Open your browser and visit:

arduino
Copy
Edit
http://localhost/mobile-salon-web-app/
🧪 Demo Login Credentials
👤 Client
Email: client@example.com

Password: 123456

🛠 Admin
Email: admin@example.com

Password: admin123

You can modify or add new accounts via phpMyAdmin.





📈 Future Improvements
💳 Integration of payment gateway (e.g., MTN Mobile Money, AirtelPay) of which we have done the biggest part remainig to pay for it to start working.

📱 Android/iOS mobile app version

🔔 Real-time SMS/Email notifications

📍 GPS tracking of salon professionals

⭐ Ratings and reviews system

👨‍🎓 Author
GROUP 11
STUDENT NAME	REGISTRATION NUMBERS
NIWAHA GIDEON	2023/DCS/DAY/1095/G
MATSIKO CRISTOPHER	2023/DCS/DAY/1616/G
LAKICA PATRICIA	2023/DCS/DAY/1123/G
MUHUMUZA IGNITIOUS	2023/DCS/DAY/1113/G

🏫 Institution: Uganda Institute of Information and Communications Technology (UICT)

📅 Year: 2025

💬 Project Type: Final Year Project

📄 License
This project is intended for academic
