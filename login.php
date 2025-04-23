<?php
$lifetime = 60 * 60 * 24 * 7; // 7 days

session_set_cookie_params([
    'lifetime' => $lifetime,
    'path' => '/',
    'domain' => '', // Leave blank unless needed
    'secure' => false, // Set to true if using HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error)
{
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm)
{
    return $formName === $activeForm ? 'active' : '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration - Smooth Animations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.396.0/dist/umd/lucide.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="login.css" />
    <link rel="shortcut icon" href="IMAGES/ppg.png" type="image/x-icon">

</head>

<body class="flex items-center justify-center min-h-screen">

    <div id="particles-js"></div>

    <nav class="navbar">
        <a href="index.php" class="navbar-logo">
            <img src="IMAGES/logo1.png" alt="Civic Eye Logo">
        </a>

        <div class="navbar-links">
            <a href="index.php">Home</a>
            <a href="download.php">Download</a>
            <a href="team.php">Team</a>
            <a href="contact-us.php">Contact Us</a>
            <span class="login-btn-link">
                <button class="login-btn">LOGIN / SIGNUP</button>
            </span>
        </div>

        <button class="hamburger-menu" aria-label="Open navigation menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </nav>

    <div class="mobile-nav-menu">
        <button class="close-menu-btn" aria-label="Close navigation menu">
            <i data-lucide="x"></i>
        </button>
        <a href="index.php">Home</a>
        <a href="download.php">Download</a>
        <a href="team.php">Team</a>
        <a href="contact-us.php">Contact Us</a>
        <span class="login-btn-link">
            <button class="login-btn">LOGIN / SIGNUP</button>
        </span>
    </div>

    <div class="relative w-[90%] max-w-4xl h-[500px] md:h-[450px] bg-black bg-opacity-20 backdrop-blur-sm rounded-2xl overflow-hidden neon-glow-border flex mt-0"
        id="form-wrapper">

        <div class="absolute top-0 left-0 w-full h-full">
            <div id="login-form-container" class="form-container <?= isActiveForm('login', $activeForm); ?>">
                <form action="login_register.php" method="post" class="w-full">
                    <h2 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-center font-orbitron text-white">Login
                    </h2>
                    <?= showError($errors['login']); ?>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <a href="#"
                        class="block text-right text-xs md:text-sm text-[#ff5722] hover:underline mb-4 md:mb-6">Forgot
                        password?</a>
                    <button type="submit" name="login" value="login">Login</button>
                </form>
            </div>
            <div id="register-form-container" class="form-container <?= isActiveForm('register', $activeForm); ?>">
                <form action="login_register.php" method="post" class="w-full">
                    <h2 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-center font-orbitron text-white">Register
                    </h2>
                    <?= showError($errors['register']); ?>
                    <input type="text" name="name" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="register" value="register">Register</button>
                </form>
            </div>
        </div>

        <div id="switch-overlay">
            <div class="switch-content-wrapper">
                <div id="switch-content-login">
                    <h2 class="text-xl md:text-2xl font-bold mb-2 md:mb-4 font-orbitron text-white">New Here?</h2>
                    <p class="text-sm md:text-base mb-4 md:mb-6 text-white">Don't have an account? Feel free to Sign up!
                    </p>
                    <button id="showRegisterBtn" class="switch-button text-sm md:text-base">Sign Up</button>
                </div>
                <div id="switch-content-register">
                    <h2 class="text-xl md:text-2xl font-bold mb-2 md:mb-4 font-orbitron text-white">One of Us?</h2>
                    <p class="text-sm md:text-base mb-4 md:mb-6 text-white">If you already have an account, just sign
                        in. We've missed you!</p>
                    <button id="showLoginBtn" class="switch-button text-sm md:text-base">Sign In</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // --- DOM Element References ---
            const showRegisterBtn = document.getElementById('showRegisterBtn');
            const showLoginBtn = document.getElementById('showLoginBtn');
            const formWrapper = document.getElementById('form-wrapper');
            const switchOverlay = document.getElementById('switch-overlay');

            // Mobile Nav References
            const hamburgerBtn = document.querySelector('.hamburger-menu');
            const mobileNav = document.querySelector('.mobile-nav-menu');
            const closeNavBtn = document.querySelector('.close-menu-btn');
            const navLinks = mobileNav ? mobileNav.querySelectorAll('a, button') : [];

            // --- Event Listeners ---

            // Form switching logic
            if (showRegisterBtn && formWrapper) {
                showRegisterBtn.addEventListener('click', () => formWrapper.classList.add('show-register'));
            } else { console.error("Element 'showRegisterBtn' or 'formWrapper' not found."); }

            if (showLoginBtn && formWrapper) {
                showLoginBtn.addEventListener('click', () => formWrapper.classList.remove('show-register'));
            } else { console.error("Element 'showLoginBtn' or 'formWrapper' not found."); }

            // Mobile Navigation Toggle Logic
            const toggleNav = (event) => {
                if (event) event.stopPropagation();
                if (mobileNav) {
                    mobileNav.classList.toggle('active');
                    document.body.classList.toggle('no-scroll', mobileNav.classList.contains('active'));
                }
            };
            const closeNav = () => {
                if (mobileNav && mobileNav.classList.contains('active')) {
                    mobileNav.classList.remove('active');
                    document.body.classList.remove('no-scroll');
                }
            };
            if (hamburgerBtn && mobileNav && closeNavBtn) {
                hamburgerBtn.addEventListener('click', toggleNav);
                closeNavBtn.addEventListener('click', closeNav);
                navLinks.forEach(link => link.addEventListener('click', closeNav));
                document.addEventListener('click', (event) => {
                    if (mobileNav.classList.contains('active') && !mobileNav.contains(event.target) && !hamburgerBtn.contains(event.target)) {
                        closeNav();
                    }
                });
                mobileNav.addEventListener('click', (event) => event.stopPropagation());
            } else { console.error("Mobile navigation elements not found."); }

            // --- particles.js Initialization ---
            if (typeof particlesJS === 'function') {
                particlesJS('particles-js', { /* Configuration kept from previous version */
                    "particles": { "number": { "value": 80, "density": { "enable": true, "value_area": 800 } }, "color": { "value": "#7BD3EA" }, "shape": { "type": "circle" }, "opacity": { "value": 0.6, "random": true, "anim": { "enable": true, "speed": 0.8, "opacity_min": 0.1, "sync": false } }, "size": { "value": 3, "random": true, "anim": { "enable": true, "speed": 1, "size_min": 0.1, "sync": false } }, "line_linked": { "enable": true, "distance": 150, "color": "#8300fe", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 2, "direction": "none", "random": true, "straight": false, "out_mode": "out", "bounce": false } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "repulse" }, "onclick": { "enable": true, "mode": "push" }, "resize": true }, "modes": { "repulse": { "distance": 100, "duration": 0.4 }, "push": { "particles_nb": 4 } } }, "retina_detect": true
                });
            } else { console.error("particlesJS not loaded correctly."); }

            // --- Initialize Lucide Icons ---
            try {
                if (typeof lucide !== 'undefined') { lucide.createIcons(); console.log("Lucide icons initialized."); }
                else { console.error("Lucide library not found."); }
            } catch (e) { console.error("Lucide icons initialization failed:", e); }
        });
    </script>

</body>

</html>