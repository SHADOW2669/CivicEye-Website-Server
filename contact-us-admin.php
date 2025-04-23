<?php
session_start();
require 'config.php'; // Make sure this file correctly connects to your 'user_db' database

// Optional: restrict to admin only
// if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
//     header("Location: login.php");
//     exit();
// }

// Handle logout
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Civic Eye | Contact Messages</title>
    <link rel="shortcut icon" href="IMAGES/ppg.png" type="image/x-icon">
    <link rel="stylesheet" href="contact-us-admin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.396.0/dist/umd/lucide.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<body>
    <nav class="navbar">
        <a href="index.php" class="navbar-logo">
            <img src="IMAGES/logo1.png" alt="Civic Eye Logo"
                onerror="this.onerror=null; this.src='https://placehold.co/150x45/111111/FFFFFF?text=CivicEye';">
        </a>
        <div class="navbar-links">
            <?php if (isset($_SESSION['email'])): ?>
                <a href="?logout=true" class="logout-btn-link-desktop">
                    <button class="btn-base btn-nav-action logout-btn">LOGOUT</button>
                </a>
            <?php endif; ?>
        </div>
        <button class="hamburger-menu" aria-label="Open navigation menu" aria-expanded="false"
            aria-controls="mobileNavMenu">
            <svg viewBox="0 0 100 80" width="28" height="28">
                <rect width="100" height="12" rx="6" fill="white"></rect>
                <rect y="34" width="100" height="12" rx="6" fill="white"></rect>
                <rect y="68" width="100" height="12" rx="6" fill="white"></rect>
            </svg>
        </button>
    </nav>

    <div class="mobile-nav-menu" id="mobileNavMenu" aria-hidden="true">
        <button class="close-menu-btn" aria-label="Close navigation menu">
            <i data-lucide="x"></i>
        </button>
        <a href="index.php">Home</a>
        <a href="admin.php">Admin Review</a>
        <a href="contact-us-admin.php">Contact Messages</a>
        <?php if (isset($_SESSION['email'])): ?>
            <a href="?logout=true" class="logout-btn-link">
                <button class="btn-base btn-nav-action logout-btn">LOGOUT</button>
            </a>
        <?php endif; ?>
    </div>

    <div id="particles-js"></div>

    <main>
        <div class="admin-container">
            <header class="admin-header" data-aos="fade-down">
                <h1>Contact Form Submissions</h1>
                <p>Messages received through the website contact form.</p>
            </header>

            <section class="contact-messages-section" data-aos="fade-up" data-aos-delay="100">
                <div class="messages-table-container">
                    <table class="messages-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date Received</th>
                            </tr>
                        </thead>
                        <tbody>contacts
                            <?php
                            // Ensure $conn is a valid mysqli connection from config.php
                            if ($conn) {
                                // *** Updated Query: Use 'contacts' table and 'submitted_at' column ***
                                $sql = "SELECT id, name, email, message, submitted_at FROM contacts ORDER BY submitted_at DESC";
                                $result = $conn->query($sql);

                                // Check if query was successful and returned results
                                if ($result && $result->num_rows > 0) {
                                    // Loop through each row in the result set
                                    while ($row = $result->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['name']) ?></td>
                                            <td><?= htmlspecialchars($row['email']) ?></td>
                                            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                                            <td><?= date('Y-m-d H:i:s', strtotime($row['submitted_at'])) ?></td>
                                        </tr>
                                        <?php
                                    endwhile; // End of while loop
                                } else {
                                    // Display a message if no contacts are found or if there was a query error
                                    $errorMessage = $result ? "No contact messages found." : "Error fetching messages: " . $conn->error;
                                    echo '<tr><td colspan="4" style="text-align:center;">' . $errorMessage . '</td></tr>';
                                }
                                // Close the database connection
                                $conn->close();
                            } else {
                                // Display an error message if the database connection failed
                                echo '<tr><td colspan="4" style="text-align:center;">Database connection error. Please check config.php.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-logo">
                    <img src="IMAGES/logo1.png" alt="Civic Eye Logo"
                        onerror="this.onerror=null; this.src='https://placehold.co/150x35/111111/FFFFFF?text=CivicEye';" />
                </div>
                <div class="footer-description">Civic Eye: AI-powered traffic violation monitoring using existing CCTV,
                    prioritizing local processing and privacy.</div>
                <div class="footer-social">
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook Profile"><i
                            data-lucide="facebook"></i></a>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram Profile"><i
                            data-lucide="instagram"></i></a>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Profile"><i
                            data-lucide="linkedin"></i></a>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="YouTube Profile"><i
                            data-lucide="youtube"></i></a>
                </div>
            </div>
            <div class="footer-links-section">
                <div class="footer-links-column">
                    <h3>Quick Links</h3>
                    <nav><a href="#">Home</a><a href="#">Download</a><a href="#">Team</a><a href="#">Contact Us</a>
                    </nav>
                </div>
                <div class="footer-links-column">
                    <h3>Resources</h3>
                    <nav><a href="#">Features</a><a href="#">Requirements</a><a href="#">Documentation</a></nav>
                </div>
                <div class="footer-links-column">
                    <h3>Contact Info</h3>
                    <p>Mangaluru, Karnataka 575001, India.</p>
                    <p>+91 XXXXX-XXXXX</p>
                    <p>info@civiceye.example.com</p>
                </div>
                <div class="footer-links-column">
                    <h3>Legal</h3>
                    <nav><a href="#">Privacy Policy</a><a href="#">Terms & Conditions</a></nav>
                </div>
            </div>
            <div class="footer-bottom">
                <div>&copy; <?= date('Y') ?> Civic Eye. All rights reserved.</div>
                <div class="footer-bottom-links"><a href="#">Privacy</a><a href="#">Terms</a><a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Initialize Particles.js if the library is loaded
            if (typeof particlesJS !== 'undefined') {
                particlesJS("particles-js", {
                    // Particle configuration (adjust as needed)
                    particles: {
                        number: { value: 60, density: { enable: true, value_area: 800 } },
                        color: { value: ["#8300fe", "#a855f7", "#38bdf8", "#555"] }, // Array of colors
                        shape: { type: "circle" },
                        opacity: { value: 0.5, random: true },
                        size: { value: 2.8, random: true },
                        line_linked: { enable: true, distance: 140, color: "#444", opacity: 0.35, width: 1 },
                        move: { enable: true, speed: 1.6, direction: "none", random: true, straight: false, out_mode: "out", bounce: false }
                    },
                    // Interactivity configuration
                    interactivity: {
                        detect_on: "canvas",
                        events: { onhover: { enable: true, mode: "grab" }, onclick: { enable: true, mode: "push" }, resize: true },
                        modes: { grab: { distance: 150, line_linked: { opacity: 0.6 } }, push: { particles_nb: 3 } }
                    },
                    retina_detect: true // Enable retina display support
                });
            } else {
                console.warn("Particles.js library not found.");
            }

            // Initialize AOS (Animate On Scroll) if the library is loaded
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 900,      // Animation duration
                    once: false,        // Animation happens every time you scroll to the element
                    offset: 80,         // Offset (in px) from the original trigger point
                    easing: 'ease-out-quart' // Type of easing
                });
            } else {
                console.warn("AOS library not found.");
            }

            // Mobile Navigation Toggle Logic
            const hamburgerBtn = document.querySelector('.hamburger-menu');
            const mobileNav = document.querySelector('.mobile-nav-menu');
            const closeNavBtn = document.querySelector('.close-menu-btn');
            const body = document.body;

            function toggleNav() {
                const isActive = mobileNav.classList.toggle('active'); // Toggle 'active' class
                body.classList.toggle('modal-open', isActive); // Add/remove class to body to prevent scrolling
                hamburgerBtn.setAttribute('aria-expanded', isActive); // Update ARIA attribute for accessibility
                mobileNav.setAttribute('aria-hidden', !isActive); // Update ARIA attribute
            }

            // Add event listener to hamburger button if it exists
            if (hamburgerBtn && mobileNav) {
                hamburgerBtn.addEventListener('click', toggleNav);
            }

            // Add event listener to close button if it exists
            if (closeNavBtn && mobileNav) {
                closeNavBtn.addEventListener('click', () => {
                    mobileNav.classList.remove('active');
                    body.classList.remove('modal-open');
                    hamburgerBtn?.setAttribute('aria-expanded', 'false');
                    mobileNav.setAttribute('aria-hidden', 'true');
                });
            }

            // Initialize Lucide icons if the library is loaded
            if (typeof lucide !== 'undefined') {
                lucide.createIcons(); // Render all elements with data-lucide attribute
            } else {
                console.warn("Lucide icons library not found.");
            }
        });
    </script>
</body>

</html>