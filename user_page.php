<?php
require_once 'auth.php';
protect('user'); // Only users allowed
?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Civic Eye | Download</title>

    <link rel="shortcut icon" href="https://placehold.co/32x32/8300FE/FFFFFF?text=CE" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.396.0/dist/umd/lucide.min.js"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <link rel="shortcut icon" href="IMAGES/ppg.png" type="image/x-icon">

    <link rel="stylesheet" href="user_page.css" />

</head>

<body>


    <nav class="navbar">

        <a href="index.php" class="navbar-logo">

            <img src="IMAGES/logo1.png"
                onerror="this.onerror=null; this.src='https://placehold.co/150x40/111111/FFFFFF?text=CivicEye';"
                alt="Civic Eye Logo">

        </a>



        <div class="navbar-links">

            <a href="index.php">Home</a>

            <a href="download.php">Download</a>

            <a href="team.php">Team</a>

            <a href="contact-us.php">Contact Us</a>

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

            <i data-lucide="x"></i> </button>

        <a href="index.php">Home</a>

        <a href="download.php">Download</a>

        <a href="team.php">Team</a>

        <a href="contact-us.php">Contact Us</a>



        <?php if (isset($_SESSION['email'])): ?>
    <a href="?logout=true" class="logout-btn-link">
        <button class="btn-base btn-nav-action logout-btn">LOGOUT</button>
    </a>
<?php endif; ?>




    </div>





    <div id="particles-js"></div>



    <main>

        <div class="dashboard-container">

            <header class="dashboard-header">

                <h1>Detected Violations</h1>

                <p>(Illustrative Data Only)</p>

            </header>



            <section class="stats-section" data-aos="fade-up">

                <div class="stats-numbers">

                    <div class="stat-item total"> <span class="stat-value">158</span>

                        <span class="stat-label">Total Detections</span>

                    </div>

                    <div class="stat-item pending"> <span class="stat-value">25</span>

                        <span class="stat-label">Pending Review</span>

                    </div>

                    <div class="stat-item approved"> <span class="stat-value">95</span>

                        <span class="stat-label">Approved Violations</span>

                    </div>

                    <div class="stat-item rejected"> <span class="stat-value">38</span>

                        <span class="stat-label">Rejected / False</span>

                    </div>

                </div>

                <div class="status-bar-container">

                    <div class="status-bar-label-text">Approval Rate (Approved / Total)</div>

                    <div class="status-bar-outer">

                        <div class="status-bar-inner" style="width: 0%;"></div>

                        <span class="status-bar-percentage">0%</span>

                    </div>

                </div>

            </section>



            <div class="violations-grid" id="violationsGrid" data-aos="fade-up" data-aos-delay="100">

                <div class="violation-card">

                    <img src="https://placehold.co/400x220/111827/A855F7?text=Violation+Image+1"
                        alt="Violation Screenshot 1"
                        onerror="this.style.backgroundColor='#333'; this.alt='Image load error'; this.src='https://placehold.co/400x220/333333/cccccc?text=Error';">

                    <div class="violation-details">

                        <h4>Violation: No Helmet</h4>

                        <p><strong>Date:</strong> 2025-04-11</p>

                        <p><strong>Time:</strong> 14:32:15</p>

                        <p><strong>Location:</strong> Cam 01 - Main St.</p>

                        <p><strong>Status:</strong> <span style="color: #4db6ac;">Approved</span></p>

                    </div>

                </div>

                <div class="violation-card">

                    <img src="https://placehold.co/400x220/111827/FF6600?text=Violation+Image+2"
                        alt="Violation Screenshot 2"
                        onerror="this.style.backgroundColor='#333'; this.alt='Image load error'; this.src='https://placehold.co/400x220/333333/cccccc?text=Error';">

                    <div class="violation-details">

                        <h4>Violation: No Helmet</h4>

                        <p><strong>Date:</strong> 2025-04-11</p>

                        <p><strong>Time:</strong> 11:05:48</p>

                        <p><strong>Location:</strong> Cam 03 - Park Ave.</p>

                        <p><strong>Status:</strong> <span style="color: #ffb74d;">Pending</span></p>

                    </div>

                </div>

                <div class="violation-card">

                    <img src="https://placehold.co/400x220/111827/7BD3EA?text=Violation+Image+3"
                        alt="Violation Screenshot 3"
                        onerror="this.style.backgroundColor='#333'; this.alt='Image load error'; this.src='https://placehold.co/400x220/333333/cccccc?text=Error';">

                    <div class="violation-details">

                        <h4>Violation: No Helmet</h4>

                        <p><strong>Date:</strong> 2025-04-10</p>

                        <p><strong>Time:</strong> 18:15:30</p>

                        <p><strong>Location:</strong> Cam 01 - Main St.</p>

                        <p><strong>Status:</strong> <span style="color: #4db6ac;">Approved</span></p>

                    </div>

                </div>

                <div class="violation-card">

                    <img src="https://placehold.co/400x220/111827/A855F7?text=Violation+Image+4"
                        alt="Violation Screenshot 4"
                        onerror="this.style.backgroundColor='#333'; this.alt='Image load error'; this.src='https://placehold.co/400x220/333333/cccccc?text=Error';">

                    <div class="violation-details">

                        <h4>Violation: No Helmet</h4>

                        <p><strong>Date:</strong> 2025-04-10</p>

                        <p><strong>Time:</strong> 09:55:11</p>

                        <p><strong>Location:</strong> Cam 02 - Side Rd.</p>

                        <p><strong>Status:</strong> <span style="color: #ef5350;">Rejected</span></p>

                    </div>

                </div>

                <div class="violation-card">

                    <img src="https://placehold.co/400x220/111827/FF6600?text=Violation+Image+5"
                        alt="Violation Screenshot 5"
                        onerror="this.style.backgroundColor='#333'; this.alt='Image load error'; this.src='https://placehold.co/400x220/333333/cccccc?text=Error';">

                    <div class="violation-details">

                        <h4>Violation: No Helmet</h4>

                        <p><strong>Date:</strong> 2025-04-09</p>

                        <p><strong>Time:</strong> 12:01:01</p>

                        <p><strong>Location:</strong> Cam 04 - Elm St.</p>

                        <p><strong>Status:</strong> <span style="color: #4db6ac;">Approved</span></p>

                    </div>

                </div>

                <div class="violation-card">

                    <img src="https://placehold.co/400x220/111827/7BD3EA?text=Violation+Image+6"
                        alt="Violation Screenshot 6"
                        onerror="this.style.backgroundColor='#333'; this.alt='Image load error'; this.src='https://placehold.co/400x220/333333/cccccc?text=Error';">

                    <div class="violation-details">

                        <h4>Violation: No Helmet</h4>

                        <p><strong>Date:</strong> 2025-04-08</p>

                        <p><strong>Time:</strong> 16:45:00</p>

                        <p><strong>Location:</strong> Cam 01 - Main St.</p>

                        <p><strong>Status:</strong> <span style="color: #4db6ac;">Approved</span></p>

                    </div>

                </div>

            </div>

        </div>

    </main>



    <footer>

        <div class="footer-container">

            <div class="footer-top">

                <div class="footer-logo">

                    <img src="IMAGES/logo1.png" alt="Civic Eye Logo"
                        onerror="this.onerror=null; this.src='https://placehold.co/150x40/111111/FFFFFF?text=CivicEye';" />

                </div>

                <div class="footer-description">

                    Civic Eye: AI-powered traffic violation monitoring using existing CCTV, prioritizing local
                    processing and privacy.

                </div>

                <div class="footer-social">

                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook Profile"><img
                            src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/facebook.svg"
                            alt="Facebook" /></a>

                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram Profile"><img
                            src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/instagram.svg"
                            alt="Instagram" /></a>

                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Profile"><img
                            src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/linkedin.svg"
                            alt="LinkedIn" /></a>

                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="YouTube Profile"><img
                            src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/youtube.svg"
                            alt="YouTube" /></a>

                </div>

            </div>

            <div class="footer-links-section">

                <div class="footer-links-column">

                    <h3>Quick Links</h3>

                    <nav>

                        <a href="index.php">Home</a>

                        <a href="download.php">Download</a>

                        <a href="team.php">Team</a>

                        <a href="contact-us.php">Contact Us</a>

                    </nav>

                </div>

                <div class="footer-links-column">

                    <h3>Resources</h3>

                    <nav>

                        <a href="index.php#features">Features</a>

                        <a href="download.php#requirements">Requirements</a>

                        <a href="#">Documentation</a>

                    </nav>

                </div>

                <div class="footer-links-column">

                    <h3>Contact Info</h3>

                    <p>Mangaluru, Karnataka 575001, India.</p>

                    <p>+91 XXXXX-XXXXX</p>

                    <p>info@civiceye.example.com</p>

                </div>

                <div class="footer-links-column">

                    <h3>Legal</h3>

                    <nav>

                        <a href="#">Privacy Policy</a>

                        <a href="#">Terms & Conditions</a>

                    </nav>

                </div>

            </div>

            <div class="footer-bottom">

                <div>&copy; 2025 Civic Eye. All rights reserved.</div>

                <div class="footer-bottom-links">

                    <a href="#">Privacy</a>

                    <a href="#">Terms</a>

                    <a href="#">Sitemap</a>

                </div>

            </div>

        </div>

    </footer>



    <script>

        document.addEventListener("DOMContentLoaded", () => {

            // --- Initialize Particles.js (Purple/Blue Theme) ---

            if (typeof particlesJS !== 'undefined') {

                particlesJS("particles-js", {

                    "particles": {

                        "number": { "value": 60, "density": { "enable": true, "value_area": 800 } },

                        "color": { "value": ["#8300fe", "#a855f7", "#38bdf8", "#555"] },

                        "shape": { "type": "circle" },

                        "opacity": {

                            "value": 0.5, "random": true,

                            "anim": { "enable": true, "speed": 0.8, "opacity_min": 0.1, "sync": false }

                        },

                        "size": { "value": 2.8, "random": true, "anim": { "enable": false } },

                        "line_linked": {

                            "enable": true, "distance": 140, "color": "#444",

                            "opacity": 0.35, "width": 1

                        },

                        "move": {

                            "enable": true, "speed": 1.6, "direction": "none", "random": true,

                            "straight": false, "out_mode": "out", "bounce": false,

                            "attract": { "enable": true, "rotateX": 700, "rotateY": 1300 }

                        }

                    },

                    "interactivity": {

                        "detect_on": "canvas",

                        "events": {

                            "onhover": { "enable": true, "mode": "grab" },

                            "onclick": { "enable": true, "mode": "push" },

                            "resize": true

                        },

                        "modes": {

                            "grab": { "distance": 150, "line_linked": { "opacity": 0.6 } },

                            "push": { "particles_nb": 3 }

                        }

                    },

                    "retina_detect": true

                });

            } else {

                console.error("particles.js library not loaded.");

            }



            // --- Initialize AOS (Animate On Scroll) ---

            if (typeof AOS !== 'undefined') {

                AOS.init({

                    duration: 900, once: false, offset: 80, easing: 'ease-out-quart',

                });

            } else {

                console.error("AOS library not loaded.");

            }





            // --- Mobile Navigation Toggle Logic (Used for all screen sizes) ---

            const hamburgerBtn = document.querySelector('.hamburger-menu');

            const mobileNav = document.querySelector('.mobile-nav-menu');

            const closeNavBtn = document.querySelector('.close-menu-btn');

            // Select links excluding the logout button link

            const navLinks = mobileNav ? mobileNav.querySelectorAll('a:not(.logout-btn-link)') : [];

            const body = document.body;



            const toggleNav = (event) => {

                if (event) event.stopPropagation();

                if (mobileNav && body && hamburgerBtn) {

                    const isActive = mobileNav.classList.toggle('active');

                    body.classList.toggle('no-scroll', isActive);

                    hamburgerBtn.setAttribute('aria-expanded', isActive);

                    mobileNav.setAttribute('aria-hidden', !isActive);

                } else { console.error("Mobile navigation elements not found."); }

            };



            const closeNav = () => {

                if (mobileNav && mobileNav.classList.contains('active') && body && hamburgerBtn) {

                    mobileNav.classList.remove('active');

                    body.classList.remove('no-scroll');

                    hamburgerBtn.setAttribute('aria-expanded', 'false');

                    mobileNav.setAttribute('aria-hidden', 'true');

                }

            };



            if (hamburgerBtn && mobileNav && closeNavBtn) {

                hamburgerBtn.addEventListener('click', toggleNav);

                closeNavBtn.addEventListener('click', closeNav);

                // Add listener to regular links

                navLinks.forEach(link => {

                    link.addEventListener('click', () => { setTimeout(closeNav, 150); });

                });

                // Add separate listener for logout button if it exists

                const logoutLink = mobileNav.querySelector('a.logout-btn-link');

                if (logoutLink) {

                    logoutLink.addEventListener('click', () => { setTimeout(closeNav, 150); });

                }



                document.addEventListener('click', (event) => {

                    if (mobileNav.classList.contains('active') && !mobileNav.contains(event.target) && !hamburgerBtn.contains(event.target)) {

                        closeNav();

                    }

                });

                mobileNav.addEventListener('click', (event) => { event.stopPropagation(); });

                document.addEventListener('keydown', (event) => {

                    if (event.key === 'Escape' && mobileNav.classList.contains('active')) { closeNav(); }

                });

            } else { console.error("Could not attach mobile navigation event listeners."); }





            // --- Initialize Lucide Icons ---

            if (typeof lucide !== 'undefined') {

                try { lucide.createIcons(); console.log("Lucide icons initialized."); }

                catch (e) { console.error("Lucide icons initialization failed:", e); }

            } else { console.error("Lucide library not loaded."); }



            // --- Dashboard Specific JS: Update Status Bar ---

            const statusBarInner = document.querySelector('.status-bar-inner');

            const statusBarPercentage = document.querySelector('.status-bar-percentage');

            if (statusBarInner && statusBarPercentage) {

                const approvedElement = document.querySelector('.stat-item.approved .stat-value');

                const totalElement = document.querySelector('.stat-item.total .stat-value');



                if (approvedElement && totalElement) {

                    const approved = parseInt(approvedElement.textContent) || 0;

                    const total = parseInt(totalElement.textContent) || 0;

                    const percentage = total > 0 ? Math.round((approved / total) * 100) : 0;



                    requestAnimationFrame(() => {

                        statusBarInner.style.width = percentage + '%';

                        statusBarPercentage.textContent = percentage + '%';

                        if (percentage === 100) { statusBarInner.style.borderRadius = '11px'; }

                        else { statusBarInner.style.borderRadius = '11px 0 0 11px'; }

                    });

                } else { console.error("Could not find stat value elements for status bar calculation."); }

            } else { console.warn("Status bar elements not found on this page."); }



        });

    </script>



</body>

</html>