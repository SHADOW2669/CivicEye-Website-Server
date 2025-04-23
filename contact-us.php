<?php
// Include the database configuration file
// Ensure this path is correct relative to this file
require_once 'config.php'; // MAKE SURE config.php IS IN THE SAME DIRECTORY

// Start the session to handle success messages and user login state
// Place session_start() at the very beginning before any output
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// --- Form Submission Logic ---
$form_error = ''; // Variable to hold potential errors
$form_success = ''; // Variable to hold the success message

// Check if there's a success message stored in the session from a previous redirect
if (isset($_SESSION['contact_success'])) {
    $form_success = $_SESSION['contact_success'];
    // Unset the session variable so it doesn't show again on refresh
    unset($_SESSION['contact_success']);
}

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // --- Basic Input Validation & Sanitization ---
    // Trim whitespace from inputs
    // Use 'name' to match the input field name attribute
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        $form_error = "All fields (Name, Email, Message) are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate email format
        $form_error = "Invalid email format provided.";
    } else {
        // --- Prepare for Database Insertion (Using Prepared Statements for Security) ---
        // SQL statement with placeholders (?)
        $sql = "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)";

        // Check if the connection object exists and is valid
        if ($conn && $stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            // 'sss' denotes the types of parameters: string, string, string
            $stmt->bind_param("sss", $param_name, $param_email, $param_message);

            // Set parameters and execute
            $param_name = $name;
            $param_email = $email;
            $param_message = $message;

            if ($stmt->execute()) {
                // Set success message in session before redirecting
                $_SESSION['contact_success'] = "Thank you for contacting us! We have received your message.";
                // Redirect back to the contact page to prevent form resubmission on refresh
                header("Location: contact-us.php"); // Redirect to the same page
                exit(); // Important to stop script execution after redirect
            } else {
                // Error during execution
                $form_error = "Oops! Something went wrong while sending your message. Please try again later.";
                // Optional: Log detailed error for debugging (don't show to user)
                // error_log("Contact form DB execute error: " . $stmt->error);
            }

            // Close statement
            $stmt->close();
        } else {
            // Error preparing the statement or connection issue
            $form_error = "Oops! There was a server error. Please try again later.";
            // Optional: Log detailed error for debugging (don't show to user)
            // error_log("Contact form DB prepare error: " . $conn->error);
        }
        // Close connection (optional, often done automatically at script end)
        // $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Civic Eye | Contact Us</title>
    <link rel="shortcut icon" href="IMAGES/ppg.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="contact-us.css" />

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.396.0/dist/umd/lucide.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

   

</head>

<body>
    <div id="particles-js"></div>
    <nav class="navbar">
        <a href="index.php" class="navbar-logo">
            <img src="IMAGES/logo1.png" alt="Civic Eye Logo">
        </a>

        <div class="navbar-links">
            <a href="index.php">Home</a>
            <a href="download.php">Download</a>
            <a href="team.php">Team</a>
            <a href="contact-us.php" class="active">Contact Us</a>
            <?php if (isset($_SESSION['email'])): ?>
                <a href="user_page.php" class="login-btn-link">
                    <button class="login-btn">DASHBOARD</button>
                </a>
            <?php else: ?>
                <a href="login.php" class="login-btn-link">
                    <button class="login-btn">LOGIN / SIGNUP</button>
                </a>
            <?php endif; ?>
        </div>

        <button class="menu-toggle" id="menuToggle" aria-label="Open menu">
            <i data-lucide="menu"></i>
        </button>
    </nav>

    <div class="mobile-nav" id="mobileNav">
        <button class="close-menu" id="closeMenu" aria-label="Close menu">
            <i data-lucide="x"></i>
        </button>

        <a href="index.php"><i data-lucide="home"></i>Home</a>
        <a href="download.php"><i data-lucide="download"></i>Download</a>
        <a href="team.php"><i data-lucide="users"></i>Team</a>
        <a href="contact-us.php"><i data-lucide="mail"></i>Contact Us</a>
        <?php if (isset($_SESSION['email'])): ?>
            <a href="user_page.php" class="login-btn-link">
                <button class="login-btn">DASHBOARD</button>
            </a>
        <?php else: ?>
            <a href="login.php" class="login-btn-link">
                <button class="login-btn">LOGIN / SIGNUP</button>
            </a>
        <?php endif; ?>
    </div>

    <div class="overlay" id="overlay"></div>

    <main>
        <div class="contact-section-container" data-aos="fade-up">
            <div class="contact-header">
                <h1>Contact Us</h1>
                <p>Have questions or feedback? We'd love to hear from you. Reach out using the details below or send us
                    a message directly.</p>
            </div>

            <div class="contact-content">
                <div class="contact-info">
                    <div class="info-item">
                        <div class="icon">
                            <i data-lucide="map-pin"></i>
                        </div>
                        <div class="details">
                            <h4>Address</h4>
                            <p>Mangaluru, Karnataka 575001, India.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="icon">
                            <i data-lucide="phone"></i>
                        </div>
                        <div class="details">
                            <h4>Phone</h4>
                            <p>+91 XXXXX-XXXXX</p> </div>
                    </div>
                    <div class="info-item">
                        <div class="icon">
                            <i data-lucide="mail"></i>
                        </div>
                        <div class="details">
                            <h4>Email</h4>
                            <p>info@civiceye.example.com</p> </div>
                    </div>
                    <div class="info-item">
                        <div class="icon">
                            <i data-lucide="github"></i>
                        </div>
                        <div class="details">
                            <h4>Issues / Support</h4>
                            <p><a href="https://github.com/SHADOW2669/CivicEye/issues" target="_blank"
                                    rel="noopener noreferrer">Report on GitHub</a></p>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <h3>Send Us a Message</h3>

                     <?php if (!empty($form_success)): ?>
                        <div class="form-message form-success" role="alert">
                            <?php echo htmlspecialchars($form_success); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($form_error)): ?>
                        <div class="form-message form-error" role="alert">
                            <strong>Error:</strong> <?php echo htmlspecialchars($form_error); ?>
                        </div>
                    <?php endif; ?>

                    <form id="contactForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="contactName">Name</label>
                            <input type="text" id="contactName" name="name"
                                placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <label for="contactEmail">Email</label>
                            <input type="email" id="contactEmail" name="email"
                                placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <label for="contactMessage">Message</label>
                            <textarea id="contactMessage" name="message"
                                placeholder="Type your message here..." required></textarea>
                        </div>
                        <button type="submit" class="submit-btn">
                            <i data-lucide="send" style="width: 1em; height: 1em; vertical-align: middle; margin-right: 5px;"></i>
                            <span>Send Message</span>
                        </button>
                         </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-bottom">
                <div>&copy; <span id="currentYear"></span> Civic Eye. All rights reserved.</div>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize libraries and handle mobile menu (existing JS)
        document.addEventListener("DOMContentLoaded", () => {
            // particles.js initialization
            if (typeof particlesJS !== 'undefined') {
                particlesJS("particles-js", { /* Your particles config */
                    "particles": { "number": { "value": 80, "density": { "enable": true, "value_area": 800 } }, "color": { "value": ["#8300FE", "#a855f7", "#38bdf8"] }, "shape": { "type": "circle" }, "opacity": { "value": 0.5, "random": true, "anim": { "enable": true, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": 3, "random": true, "anim": { "enable": false } }, "line_linked": { "enable": true, "distance": 150, "color": "#555", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 2, "direction": "none", "random": true, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": true, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "grab" }, "onclick": { "enable": false }, "resize": true }, "modes": { "grab": { "distance": 140, "line_linked": { "opacity": 0.7 } } } }, "retina_detect": true
                });
            } else { console.error("particles.js not loaded"); }

            // AOS initialization
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 700,
                    once: true,
                    offset: 80,
                    easing: 'ease-out-cubic',
                });
            } else {
                console.error("AOS not loaded");
            }

            // Lucide icons initialization
            try {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                    console.log("Lucide icons initialized.");
                } else {
                    console.error("Lucide library not loaded.");
                }
            } catch (e) {
                console.error("Lucide icons initialization failed:", e);
            }

            // Footer year update
            const yearSpan = document.getElementById('currentYear');
            if (yearSpan) {
                yearSpan.textContent = new Date().getFullYear();
            }

            // Mobile Menu Logic (remains the same)
            const menuToggle = document.getElementById('menuToggle');
            const closeMenu = document.getElementById('closeMenu');
            const mobileNav = document.getElementById('mobileNav');
            const overlay = document.getElementById('overlay');
            const mobileNavLinks = document.querySelectorAll('.mobile-nav a');

            if (menuToggle && closeMenu && mobileNav && overlay) {
                 const openMenu = () => {
                    mobileNav.classList.add('open');
                    overlay.classList.add('open');
                    document.body.classList.add('no-scroll');
                    menuToggle.setAttribute('aria-expanded', 'true');
                 };

                 const closeMenuFunc = () => {
                    mobileNav.classList.remove('open');
                    overlay.classList.remove('open');
                    document.body.classList.remove('no-scroll');
                    menuToggle.setAttribute('aria-expanded', 'false');
                 };

                 menuToggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    openMenu();
                 });

                 closeMenu.addEventListener('click', closeMenuFunc);
                 overlay.addEventListener('click', closeMenuFunc);

                 mobileNavLinks.forEach(link => {
                    link.addEventListener('click', closeMenuFunc);
                 });

                 document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && mobileNav.classList.contains('open')) {
                        closeMenuFunc();
                    }
                 });

                 mobileNav.addEventListener('click', (e) => {
                    e.stopPropagation();
                 });
            } else {
                console.warn("Mobile menu elements not found.");
            }

            // REMOVED the contactForm event listener for GitHub submission

        });
    </script>
</body>

</html>
