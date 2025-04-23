<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Civic Eye | Team</title>
    <link rel="shortcut icon" href="IMAGES/ppg.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="team.css" />
    
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.396.0/dist/umd/lucide.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<body>
    <div id="particles-js"></div>

    <?php
session_start();
?>
    <nav class="navbar">
        <a href="index.php" class="navbar-logo">
            <img src="IMAGES/logo1.png" alt="Civic Eye Logo">
        </a>

        <div class="navbar-links">
            <a href="index.php">Home</a>
            <a href="download.php">Download</a>
            <a href="team.php" class="active">Team</a>
            <a href="contact-us.php">Contact Us</a>
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
        <header class="hero">
            <h1>Meet Our Team</h1>
            <p class="info">The minds behind Civic Eye — passionate, innovative, and tech-savvy.</p>
        </header>

        <section class="team-section">

            <div class="team-card" data-aos="fade-up" data-aos-delay="100">
                <div class="avatar-social-column">
                    <img class="avatar" src="https://avatars.githubusercontent.com/u/112880525?v=4" alt="Sathwik Avatar"
                        onerror="this.onerror=null; this.src='https://placehold.co/120x120/222222/888888?text=S';" />
                    <div class="connect-links">
                        <a href="https://github.com/Sathwik656" target="_blank" rel="noopener noreferrer"
                            aria-label="GitHub Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/github.svg"
                                alt="GitHub" />
                        </a>
                        <a href="https://linkedin.com/in/sathwik-k-39b950323" target="_blank" rel="noopener noreferrer"
                            aria-label="LinkedIn Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/linkedin.svg"
                                alt="LinkedIn" />
                        </a>
                        <a href="https://www.instagram.com/_xavy.___/" target="_blank" rel="noopener noreferrer"
                            aria-label="Instagram Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/instagram.svg"
                                alt="Instagram" />
                        </a>
                    </div>
                </div>
                <div class="text-content-column">
                    <h3>Sathwik</h3>
                    <p class="role">Lead Developer</p>
                    <p class="description">Responsible for Web Development And Team Leading</p>
                    <div class="skills-section">
                        <h6>Tools Used:</h6>
                        <div class="skills-icons">
                            <img src="https://skillicons.dev/icons?i=html,css,javascript,php,mysql&theme=dark"
                                alt="HTML, CSS, JavaScript, PHP skills, Mysql" />
                        </div>
                    </div>
                    <div class="repos-section">
                        <h6>GitHub Repository:</h6>
                        <div class="repo-links">
                            <a href="https://github.com/Sathwik656/CIVIC-EYE-2.0" target="_blank">
                                <img src="https://github-readme-stats.vercel.app/api/pin/?username=Sathwik656&repo=CIVIC-EYE-2.0&theme=dark&show_owner=true"
                                    alt="Sathwik656/CIVIC-EYE-2.0 Repo Card" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="team-card" data-aos="fade-up" data-aos-delay="200">
                <div class="avatar-social-column">
                    <img class="avatar" src="https://avatars.githubusercontent.com/u/197274423?v=4" alt="Shadow Avatar"
                        onerror="this.onerror=null; this.src='https://placehold.co/120x120/222222/888888?text=S';" />
                    <div class="connect-links">
                        <a href="https://github.com/SHADOW2669" target="_blank" rel="noopener noreferrer"
                            aria-label="GitHub Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/github.svg"
                                alt="GitHub" />
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/linkedin.svg"
                                alt="LinkedIn" />
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/instagram.svg"
                                alt="Instagram" />
                        </a>
                    </div>
                </div>
                <div class="text-content-column">
                    <h3>Shadow</h3>
                    <p class="role">Backend Engineer</p>
                    <p class="description">Responsible for YOLOv8 and Backend Connectivity</p>
                    <div class="skills-section">
                        <h6>Tools Used:</h6>
                        <div class="skills-icons">
                            <img src="https://skillicons.dev/icons?i=html,css,javascript,php,mysql,python,ubuntu,cloudflare&theme=dark"
                                alt="HTML, CSS, JavaScript, PHP, Mysql, Python, Ubuntu, Cloudflare skills" />
                        </div>
                    </div>
                    <div class="repos-section">
                        <h6>GitHub Repositories:</h6>
                        <div class="repo-links">

                            <a href="https://github.com/SHADOW2669/CivicEye" target="_blank">
                                <img src="https://github-readme-stats.vercel.app/api/pin/?username=SHADOW2669&repo=CivicEye&theme=dark&show_owner=true"
                                    alt="SHADOW2669/CivicEye Repo Card" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="team-card" data-aos="fade-up" data-aos-delay="300">
                <div class="avatar-social-column">
                    <img class="avatar" src="https://avatars.githubusercontent.com/u/198428564?v=4"
                        alt="Deekshith Avatar"
                        onerror="this.onerror=null; this.src='https://placehold.co/120x120/222222/888888?text=D';" />
                    <div class="connect-links">
                        <a href="https://github.com/Deekshith-O2" target="_blank" rel="noopener noreferrer"
                            aria-label="GitHub Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/github.svg"
                                alt="GitHub" />
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/linkedin.svg"
                                alt="LinkedIn" />
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/instagram.svg"
                                alt="Instagram" />
                        </a>
                    </div>
                </div>
                <div class="text-content-column">
                    <h3>Deekshith</h3>
                    <p class="role">UI/UX Designer</p>
                    <p class="description">Designs intuitive interfaces and ensures user-centered experience</p>
                    <div class="skills-section">
                        <h6>Tools Used:</h6>
                        <div class="skills-icons">
                            <img src="https://skillicons.dev/icons?i=html,css&theme=dark" alt="HTML, CSS skills" />
                        </div>
                    </div>
                    <div class="repos-section">
                        <h6>GitHub Repository:</h6>
                        <div class="repo-links">
                            <a href="https://github.com/Deekshith-O2/Deekshith-coder" target="_blank">
                                <img src="https://github-readme-stats.vercel.app/api/pin/?username=Deekshith-O2&repo=Deekshith-coder&theme=dark&show_owner=true"
                                    alt="Deekshith-O2/Deekshith-coder Repo Card" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="team-card" data-aos="fade-up" data-aos-delay="400">
                <div class="avatar-social-column">
                    <img class="avatar" src="https://avatars.githubusercontent.com/u/184252677?v=4"
                        alt="Pratyaksh Avatar"
                        onerror="this.onerror=null; this.src='https://placehold.co/120x120/222222/888888?text=P';" />
                    <div class="connect-links">
                        <a href="https://github.com/pratyaksh585" target="_blank" rel="noopener noreferrer"
                            aria-label="GitHub Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/github.svg"
                                alt="GitHub" />
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/linkedin.svg"
                                alt="LinkedIn" />
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram Profile">
                            <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/instagram.svg"
                                alt="Instagram" />
                        </a>
                    </div>
                </div>
                <div class="text-content-column">
                    <h3>Pratyaksh</h3>
                    <p class="role">Backend Engineer</p>
                    <p class="description">Manages database architecture and API development</p>
                    <div class="skills-section">
                        <h6>Tools Used:</h6>
                        <div class="skills-icons">
                            <img src="https://skillicons.dev/icons?i=python&theme=dark" alt="Python skills" />
                        </div>
                    </div>
                    <div class="repos-section">
                        <h6>GitHub Repository:</h6>
                        <div class="repo-links">
                            <a href="https://github.com/pratyaksh585/pratyaksh585" target="_blank">
                                <img src="https://github-readme-stats.vercel.app/api/pin/?username=pratyaksh585&repo=pratyaksh585&theme=dark&show_owner=true"
                                    alt="pratyaksh585/pratyaksh585 Repo Card" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
        document.addEventListener("DOMContentLoaded", () => {
            // Initialize Particles.js
            if (typeof particlesJS !== 'undefined') {
                particlesJS("particles-js", {
                    "particles": { "number": { "value": 80, "density": { "enable": true, "value_area": 800 } }, "color": { "value": ["#8300FE", "#a855f7", "#38bdf8"] }, "shape": { "type": "circle" }, "opacity": { "value": 0.5, "random": true, "anim": { "enable": true, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": 3, "random": true, "anim": { "enable": false } }, "line_linked": { "enable": true, "distance": 150, "color": "#555", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 2, "direction": "none", "random": true, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": true, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "grab" }, "onclick": { "enable": false }, "resize": true }, "modes": { "grab": { "distance": 140, "line_linked": { "opacity": 0.7 } } } }, "retina_detect": true
                });
            } else { console.error("particles.js not loaded"); }

            // Initialize AOS (Animate On Scroll)
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 700,
                    once: true, // Animate elements only once
                    offset: 80, // Trigger animations slightly early
                    easing: 'ease-out-cubic',
                });
            } else {
                console.error("AOS not loaded");
            }

            // Initialize Lucide Icons
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

            // Update Footer Year
            const yearSpan = document.getElementById('currentYear');
            if (yearSpan) {
                yearSpan.textContent = new Date().getFullYear();
            }

            // Mobile Navigation Logic
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
                    link.addEventListener('click', closeMenuFunc); // Close menu when a link is clicked
                });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && mobileNav.classList.contains('open')) {
                        closeMenuFunc(); // Close menu on escape key press
                    }
                });

                // Prevent clicks inside the menu from closing it
                mobileNav.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
            } else {
                // Warn if any mobile menu element is missing
                console.warn("Mobile menu elements not found:");
                if (!menuToggle) console.warn("- #menuToggle missing");
                if (!mobileNav) console.warn("- #mobileNav missing");
                if (!closeMenu) console.warn("- #closeMenu missing");
                if (!overlay) console.warn("- #overlay missing");
            }

        });
    </script>
</body>

</html>