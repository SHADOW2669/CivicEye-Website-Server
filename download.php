<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Civic Eye | Download</title>

    <link rel="shortcut icon" href="IMAGES/ppg.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="download.css" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
            <img src="IMAGES/logo1.png" alt="Civic Eye Logo"
                onerror="this.onerror=null; this.src='https://placehold.co/160x45/050507/FFFFFF?text=CivicEye';">
        </a>

        <div class="navbar-links">
            <a href="index.php">Home</a>
            <a href="download.php" class="active">Download</a>
            <a href="team.php">Team</a>
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

        <a href="index.php">Home</a>
        <a href="download.php">Download</a>
        <a href="team.php">Team</a>
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

    <div class="overlay" id="overlay"></div>


    <main>
        <header class="download-header" data-aos="fade-up">
            <h1>Download CivicEye</h1>
            <p>Get the latest version of CivicEye for your operating system. AI-powered traffic violation detection,
                running locally on your machine for enhanced privacy and efficiency.</p>
            <div class="download-os-links">
                <a href="#windows-section-anchor" class="btn-os-link windows"> <i data-lucide="laptop"></i>
                    <span>Windows</span>
                </a>
                <a href="#linux-section-anchor" class="btn-os-link linux"> <i data-lucide="terminal"></i>
                    <span>Linux</span>
                </a>
            </div>
        </header>

        <div class="download-info-container">
            <section id="introduction" class="download-section" data-aos="fade-up" data-aos-delay="100">
                <h2>Introduction</h2>
                <p>CivicEye is an innovative AI-powered software designed to detect and monitor traffic violations using
                    standard CCTV cameras. Leveraging the advanced YOLOv8 object detection model, it identifies
                    violations like helmet non-compliance in real-time, processing all data locally on the user's
                    machine to ensure maximum privacy and control.</p>
            </section>

            <hr class="section-separator" data-aos="fade-up" data-aos-delay="100" />

            <section id="key-features" class="download-section" data-aos="fade-up" data-aos-delay="150">
                <h2>Key Features</h2>
                <ul>
                    <li><strong>Real-Time Violation Detection</strong>: Employs YOLOv8 to accurately detect traffic
                        violations such as "No Helmet" in live or recorded video streams.</li>
                    <li><strong>Local Processing Focus</strong>: All computation and data handling occur directly on the
                        user's machine, safeguarding privacy and removing reliance on cloud services.</li>
                    <li><strong>Automated Image Capture</strong>: Automatically captures and stores image evidence of
                        detected violations locally for review and record-keeping.</li>
                    <li><strong>Flexible Video Input</strong>: Compatible with both pre-recorded video files and
                        real-time feeds from connected webcams or IP cameras.</li>
                    <li><strong>Secure User Authentication</strong>: Features a robust login system requiring user
                        authentication before accessing the core detection functionalities.</li>
                    <li><strong>Intuitive Graphical Interface</strong>: Offers a simplified and user-friendly GUI
                        (available in Windows v2.0+) for easier operation and configuration.</li>
                </ul>
            </section>

            <hr class="section-separator" data-aos="fade-up" data-aos-delay="150" />

            <section id="technical-overview" class="download-section" data-aos="fade-up" data-aos-delay="150">
                <h2>Technical Overview</h2>
                <h4>Programming Language:</h4>
                <p>Built primarily using <strong>Python 3.8+</strong>, chosen for its extensive libraries in AI, image
                    processing, and automation.</p>

                <h4>Core Libraries:</h4>
                <ol>
                    <li><strong>OpenCV (cv2)</strong>: Essential for video stream handling, frame capture, image
                        manipulation, and saving output.</li>
                    <li><strong>Ultralytics YOLOv8</strong>: The core engine for performing high-performance, real-time
                        object detection to identify helmet violations.</li>
                    <li><strong>cvzone</strong>: Utilized for easily drawing bounding boxes, labels, and other visual
                        annotations on detected objects within the video feed.</li>
                    <li><strong>Pillow (PIL Fork)</strong>: Employed for image format conversions, particularly for
                        displaying processed frames within the GUI.</li>
                    <li><strong>ttkbootstrap</strong>: Provides modern themes and enhanced UI widgets for the graphical
                        interface (Windows v2.0+).</li>
                </ol>
            </section>

            <hr class="section-separator" data-aos="fade-up" data-aos-delay="150" />

            <section id="future-enhancements" class="download-section" data-aos="fade-up" data-aos-delay="150">
                <h2>Future Enhancements Roadmap</h2>
                <ul>
                    <li>Develop a standalone executable installer (<code>.exe</code> / <code>.msi</code>) for
                        streamlined Windows deployment.</li>
                    <li>Continuously refine the Graphical User Interface (GUI) based on user feedback for improved
                        usability and aesthetics.</li>
                    <li>Implement optional centralized reporting capabilities to a secure web server for aggregated
                        analytics (user opt-in).</li>
                    <li>Expand the range of detectable violations to include "Triple Riding," "Wrong Way Driving," and
                        other common infractions.</li>
                    <li>Fine-tune the YOLO detection model specifically for diverse regional traffic patterns and
                        lighting conditions.</li>
                    <li>Integrate optional real-time alert mechanisms via email or SMS notifications for critical
                        violations.</li>
                </ul>
            </section>

            <hr class="section-separator" data-aos="fade-up" data-aos-delay="150" />

            <section id="support" class="download-section" data-aos="fade-up" data-aos-delay="150">
                <h2>Support & Contributions</h2>
                <p>Encountered a bug? Have a feature suggestion? We welcome contributions! Please visit our official
                    GitHub repository to report issues, propose enhancements, or contribute to the project. You can also
                    reach out directly to the development lead, <a href="https://github.com/SHADOW2669" target="_blank"
                        rel="noopener noreferrer">SHADOW</a>.</p>
                <div class="download-button-container">
                    <a href="https://github.com/SHADOW2669/CivicEye/issues" target="_blank" rel="noopener noreferrer"
                        class="hero-btn primary"> <i data-lucide="message-circle-warning"></i>
                        <span>Report an Issue</span> </a>
                </div>
            </section>
        </div>

        <div id="download-os" class="os-download-wrapper">
            <div id="windows-section-anchor" class="scroll-anchor"></div>
            <div class="os-container windows-container" data-aos="fade-up" data-aos-delay="200">
                <section id="windows" class="download-section">
                    <h2><i data-lucide="laptop"></i> Windows</h2>

                    <h3>Installation Guide (v2.0+)</h3>
                    <h4 title="Requires Windows 10 (64-bit) or newer.">System Requirements:</h4>
                    <ul>
                        <li><strong>Operating System:</strong> Windows 10 (64-bit) or Windows 11</li>
                        <li><strong>Processor:</strong> Intel Core i3 (7th Gen+) or AMD Ryzen 3 equivalent</li>
                        <li><strong>RAM:</strong> Minimum 4GB (8GB Recommended for smoother performance)</li>
                        <li><strong>Storage:</strong> 20GB available disk space (SSD Recommended)</li>
                        <li><strong>Graphics:</strong> Integrated graphics sufficient, dedicated GPU beneficial for
                            higher resolution video.</li>
                    </ul>

                    <h4>Setup Instructions:</h4>
                    <ol>
                        <li><strong>Download the Latest Release:</strong>
                            <br />Obtain the Windows package (usually a <code>.zip</code> archive) from the <a
                                href="https://github.com/SHADOW2669/CivicEye/releases" target="_blank"
                                rel="noopener noreferrer">CivicEye Releases page</a> on GitHub.
                            <div class="download-button-container">
                                <a href="https://github.com/SHADOW2669/CivicEye/archive/refs/tags/windows.zip"
                                    class="hero-btn primary"> <i data-lucide="download"></i>
                                    <span>Download Latest (Windows)</span> </a>
                            </div>
                        </li>
                        <li><strong>Extract the Archive:</strong>
                            <br />Right-click the downloaded <code>.zip</code> file and select "Extract All..." to a
                            suitable location (e.g., <code>C:\CivicEye</code>).
                        </li>
                        <li><strong>Run Installation Script:</strong>
                            <br />Navigate into the extracted folder. Double-click the <code>install.bat</code> script.
                            This will automatically set up a virtual environment and install all necessary dependencies.
                            Administrator privileges might be required.
                        </li>
                        <li><strong>Launch the Application:</strong>
                            <br />Once installation is complete, double-click <code>CivicEye.bat</code> (or
                            <code>run.bat</code>) to start the software. A shortcut might also be created on your
                            Desktop if included in the package.
                        </li>
                    </ol>

                    <h3>Software Workflow (Windows v2.0+)</h3>
                    <ol>
                        <li><strong>User Login</strong>: Launching the app presents a login screen. Use default
                            credentials (Username: <code>admin</code>, Password: <code>1234</code>) or credentials
                            provided. Authentication is mandatory.</li>
                        <li><strong>Video Source Selection</strong>: After login, use the GUI to either browse and
                            select a pre-recorded video file (e.g., <code>.mp4</code>, <code>.avi</code>) or choose to
                            use the default system webcam.</li>
                        <li><strong>Real-Time Detection</strong>: The software starts processing the video feed. YOLOv8
                            identifies "Without Helmet" violations, drawing bounding boxes and labels directly onto the
                            displayed video stream.</li>
                        <li><strong>Violation Logging & Storage</strong>: Images of confirmed violations are
                            automatically saved in the <code>Detects</code> subfolder within the application directory.
                        </li>
                        <li><strong>Monitoring & Control</strong>: Observe the processed video feed in real-time. Use
                            the GUI controls to stop the detection or exit the application. Pressing the 'q' key might
                            also work as a fallback exit method in the video window.</li>
                    </ol>

                    <h3 title="Includes GUI, improved detection, and login system.">Version 2.0 Highlights</h3>
                    <ul>
                        <li><strong>Native Windows Support</strong>: First official release with dedicated Windows
                            compatibility and setup scripts (<code>.bat</code>).</li>
                        <li><strong>Graphical User Interface (GUI)</strong>: Introduces an intuitive interface built
                            with ttkbootstrap for easier operation compared to command-line versions.</li>
                        <li><strong>Refined Detection Logic</strong>: Improved object tracking and more reliable
                            violation confirmation before saving images.</li>
                        <li><strong>Mandatory Secure Login</strong>: Enhances security by requiring user authentication
                            before accessing features.</li>
                        <li><strong>Continued Local Processing</strong>: Maintains the core principle of processing data
                            locally for user privacy and control.</li>
                    </ul>
                </section>
            </div>

            <div id="linux-section-anchor" class="scroll-anchor"></div>
            <div class="os-container linux-container" data-aos="fade-up" data-aos-delay="200">
                <section id="linux" class="download-section">
                    <h2><i data-lucide="terminal"></i> Linux</h2>

                    <h3>Installation Guide (v1.2+)</h3>
                    <h4 title="Tested on Ubuntu, Debian, Arch, Fedora. Requires Python 3.8+.">System Requirements:</h4>
                    <ul>
                        <li><strong>Operating System:</strong> Linux (Tested on Ubuntu 20.04+, Debian 11+, Arch Linux,
                            Fedora 35+)</li>
                        <li><strong>Processor:</strong> Intel Core i3 (7th Gen+) or AMD Ryzen 3 equivalent</li>
                        <li><strong>RAM:</strong> Minimum 4GB (8GB Recommended)</li>
                        <li><strong>Storage:</strong> 20GB available disk space</li>
                        <li><strong>Dependencies:</strong> Python 3.8+, Pip, Git, potentially
                            build-essentials/equivalent for OpenCV compilation.</li>
                    </ul>

                    <h4>Setup Instructions (Terminal):</h4>
                    <ol>
                        <li><strong>Clone Repository or Download:</strong> <br />Open your terminal and clone the
                            project using Git:
                            <pre><code>git clone https://github.com/SHADOW2669/CivicEye.git</code><button class="copy-btn" aria-label="Copy command"><span class="copy-text">Copy</span><i data-lucide="copy" class="copy-icon"></i><i data-lucide="check" class="check-icon" style="display:none;"></i></button></pre>
                            Alternatively, download the source code <code>.zip</code> or <code>.tar.gz</code> from the
                            <a href="https://github.com/SHADOW2669/CivicEye/releases" target="_blank"
                                rel="noopener noreferrer">Releases page</a>.
                            <div class="download-button-container">
                                <a href="https://github.com/SHADOW2669/CivicEye/archive/refs/tags/v1.2.zip"
                                    class="hero-btn primary"> <i data-lucide="download"></i>
                                    <span>Download Latest (Linux)</span> </a>
                            </div>
                        </li>
                        <li><strong>Navigate to Project Directory:</strong>
                            <pre><code>cd CivicEye</code><button class="copy-btn" aria-label="Copy command"><span class="copy-text">Copy</span><i data-lucide="copy" class="copy-icon"></i><i data-lucide="check" class="check-icon" style="display:none;"></i></button></pre>
                        </li>
                        <li><strong>Run Setup Script:</strong> <br />Make the setup script executable and run it. This
                            script handles virtual environment creation and dependency installation.
                            <pre><code class="language-bash">chmod +x setup_civiceye.sh
./setup_civiceye.sh</code><button class="copy-btn" aria-label="Copy command"><span class="copy-text">Copy</span><i data-lucide="copy" class="copy-icon"></i><i data-lucide="check" class="check-icon" style="display:none;"></i></button></pre>
                        </li>
                        <li><strong>Run the Application:</strong> <br />Make the run script executable and launch the
                            software:
                            <pre><code class="language-bash">chmod +x run.sh
./run.sh</code><button class="copy-btn" aria-label="Copy command"><span class="copy-text">Copy</span><i data-lucide="copy" class="copy-icon"></i><i data-lucide="check" class="check-icon" style="display:none;"></i></button></pre>
                        </li>
                    </ol>


                    <h3>Software Workflow (Linux v1.2+)</h3>
                    <ol>
                        <li><strong>User Login (Terminal)</strong>: Upon running <code>./run.sh</code>, the script
                            prompts for username and password in the terminal. Enter default credentials
                            (<code>admin</code> / <code>1234</code>) or provided ones.</li>
                        <li><strong>Video Source Input (Terminal)</strong>: The script will ask for the path to a video
                            file. Enter the full path or press Enter to use the default webcam (usually
                            <code>/dev/video0</code>).
                        </li>
                        <li><strong>Violation Detection & Display</strong>: An OpenCV window opens, showing the video
                            feed. YOLOv8 processes frames, highlighting "Without Helmet" violations with bounding boxes.
                        </li>
                        <li><strong>Data Logging & Storage</strong>: Images capturing detected violations are saved into
                            the <code>Detects</code> directory within the project folder.</li>
                        <li><strong>Monitoring & Exit</strong>: Watch the real-time processed feed. To stop the
                            detection and close the application, ensure the OpenCV window is active and press the 'q'
                            key on your keyboard.</li>
                    </ol>

                    <h3 title="Improved setup script, run script, and detection workflow.">Version 1.2 Highlights</h3>
                    <ul>
                        <li><strong>Cross-Distribution Setup Script</strong>: Enhanced <code>setup_civiceye.sh</code>
                            attempts to detect the package manager (apt, pacman, dnf) for broader Linux compatibility.
                        </li>
                        <li><strong>Dedicated Run Script</strong>: Introduced <code>run.sh</code> to simplify launching
                            the application after setup.</li>
                        <li><strong>Streamlined Detection Workflow</strong>: Improved logic for tracking objects and
                            confirming violations before saving evidence.</li>
                        <li><strong>Flexible Input Options</strong>: Clear prompts for choosing between a video file
                            path or the default webcam input.</li>
                        <li><strong>Mandatory Secure Login</strong>: Integrated terminal-based authentication for
                            security.</li>
                        <li><strong>Reliable Local Processing</strong>: Continues to prioritize on-device processing for
                            privacy.</li>
                    </ul>
                </section>
            </div>

        </div>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-logo">
                    <img src="IMAGES/logo1.png" alt="Civic Eye Logo"
                        onerror="this.onerror=null; this.src='https://placehold.co/160x45/050507/FFFFFF?text=CivicEye';" />
                </div>
                <div class="footer-description">
                    Civic Eye: Leveraging AI for smarter traffic violation monitoring using existing CCTV
                    infrastructure, prioritizing local processing, data privacy, and community safety.
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
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="GitHub Repository"><img
                            src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/github.svg" alt="GitHub" /></a>
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
                        <a href="login.php">Login / Signup</a>
                    </nav>
                </div>
                <div class="footer-links-column">
                    <h3>Resources</h3>
                    <nav>
                        <a href="index.php#features">Features</a>
                        <a href="#windows-section-anchor">Windows Guide</a>
                        <a href="#linux-section-anchor">Linux Guide</a>
                        <a href="https://github.com/SHADOW2669/CivicEye" target="_blank"
                            rel="noopener noreferrer">Documentation (GitHub)</a>
                    </nav>
                </div>
                <div class="footer-links-column">
                    <h3>Contact Info</h3>
                    <p><i data-lucide="map-pin"
                            style="width: 1em; height: 1em; vertical-align: -0.125em; margin-right: 0.5em;"></i>Mangaluru,
                        KA 575001, India</p>
                    <p><i data-lucide="phone"
                            style="width: 1em; height: 1em; vertical-align: -0.125em; margin-right: 0.5em;"></i>+91
                        XXXXX-XXXXX</p>
                    <p><i data-lucide="mail"
                            style="width: 1em; height: 1em; vertical-align: -0.125em; margin-right: 0.5em;"></i>info@civiceye.example.com
                    </p>
                </div>
                <div class="footer-links-column">
                    <h3>Legal</h3>
                    <nav>
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms & Conditions</a>
                        <a href="#">License</a>
                    </nav>
                </div>
            </div>
            <div class="footer-bottom">
                <div>&copy; <span id="currentYear"></span> Civic Eye. All rights reserved.</div>
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
            // Initialize Particles.js
            if (typeof particlesJS !== 'undefined') {
                particlesJS("particles-js", {
                    "particles": {
                        "number": { "value": 70, "density": { "enable": true, "value_area": 900 } },
                        "color": { "value": ["#8300fe", "#a855f7", "#38bdf8", "#666"] },
                        "shape": { "type": "circle" },
                        "opacity": {
                            "value": 0.6, "random": true,
                            "anim": { "enable": true, "speed": 0.9, "opacity_min": 0.15, "sync": false }
                        },
                        "size": { "value": 3.0, "random": true },
                        "line_linked": {
                            "enable": true, "distance": 150,
                            "color": "#555", "opacity": 0.4, "width": 1
                        },
                        "move": {
                            "enable": true, "speed": 1.8, "random": true,
                            "out_mode": "out", "attract": { "enable": true, "rotateX": 800, "rotateY": 1400 }
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
                            "grab": { "distance": 160, "line_linked": { "opacity": 0.7 } },
                            "push": { "particles_nb": 4 }
                        }
                    },
                    "retina_detect": true
                });
            } else {
                console.error("particles.js not loaded");
            }

            // Initialize AOS (Animate On Scroll)
            if (typeof AOS !== 'undefined') {
                AOS.init({ duration: 700, once: true, offset: 80, easing: 'ease-out-cubic' });
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
                    document.body.classList.add('no-scroll'); // Prevent body scroll
                    menuToggle.setAttribute('aria-expanded', 'true');
                };

                const closeMenuFunc = () => {
                    mobileNav.classList.remove('open');
                    overlay.classList.remove('open');
                    document.body.classList.remove('no-scroll'); // Allow body scroll
                    menuToggle.setAttribute('aria-expanded', 'false');
                };

                menuToggle.addEventListener('click', e => {
                    e.stopPropagation(); // Prevent click from closing immediately
                    openMenu();
                });

                closeMenu.addEventListener('click', closeMenuFunc);
                overlay.addEventListener('click', closeMenuFunc); // Close when clicking overlay
                mobileNavLinks.forEach(link => link.addEventListener('click', closeMenuFunc)); // Close when clicking a link
                document.addEventListener('keydown', e => {
                    if (e.key === 'Escape' && mobileNav.classList.contains('open')) {
                        closeMenuFunc(); // Close on escape key
                    }
                });

                mobileNav.addEventListener('click', e => e.stopPropagation()); // Prevent clicks inside nav from closing it
            } else {
                console.warn("Mobile navigation elements not found or IDs mismatch.");
            }

            // Smooth Scrolling for Anchor Links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const targetId = this.getAttribute('href');
                    if (targetId && targetId.length > 1 && targetId.startsWith('#')) {
                        const target = document.querySelector(targetId);
                        if (target) {
                            e.preventDefault();
                            const navHeight = document.querySelector('.navbar')?.offsetHeight || 70;
                            // Calculate position considering navbar height and a small offset
                            const topPos = target.getBoundingClientRect().top + window.pageYOffset - navHeight - 20;
                            window.scrollTo({ top: topPos, behavior: "smooth" });
                        }
                    }
                });
            });

            // Clipboard Copy Functionality for Code Blocks
            document.querySelectorAll('.copy-btn').forEach(button => {
                button.addEventListener('click', async () => {
                    const pre = button.closest('pre');
                    const code = pre?.querySelector('code');
                    const text = code?.textContent || '';
                    const copyText = button.querySelector('.copy-text'); // Assumes span with this class exists for "Copy" text
                    const copyIcon = button.querySelector('.copy-icon'); // Assumes i tag with this class for copy icon
                    const checkIcon = button.querySelector('.check-icon'); // Assumes i tag with this class for check icon

                    if (!code || !navigator.clipboard) {
                        console.error("Clipboard API not available or code element not found.");
                        if (copyText) copyText.textContent = 'Error'; // Provide feedback
                        return;
                    }

                    try {
                        await navigator.clipboard.writeText(text);
                        // Visual feedback for successful copy
                        if (copyText) copyText.style.display = 'none';
                        if (copyIcon) copyIcon.style.display = 'none';
                        if (checkIcon) checkIcon.style.display = 'inline-block';
                        button.setAttribute('aria-label', 'Copied!');

                        // Reset button appearance after 2 seconds
                        setTimeout(() => {
                            if (copyText) copyText.style.display = 'inline-block';
                            if (copyIcon) copyIcon.style.display = 'inline-block';
                            if (checkIcon) checkIcon.style.display = 'none';
                            button.setAttribute('aria-label', 'Copy command');
                        }, 2000);
                    } catch (err) {
                        console.error('Copy failed:', err);
                        if (copyText) copyText.textContent = 'Failed'; // Provide feedback
                        // Reset button appearance after 2 seconds
                        setTimeout(() => { if (copyText) copyText.textContent = 'Copy'; }, 2000);
                    }
                });
            });

            // Try to prevent browser scroll restoration on page load/refresh
            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }
        });

    </script>
</body>

</html>