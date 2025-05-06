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
    // Start session to check login status
    session_start();
    ?>
    <nav class="navbar">
        <a href="index.php" class="navbar-logo">
            <img src="IMAGES/logo1.png" alt="Civic Eye Logo"
                onerror="this.onerror=null; this.src='https://placehold.co/160x45/050507/FFFFFF?text=CivicEye';">
        </a>

        <div class="navbar-links">
            <a href="index.php">Home</a>
            <a href="download.php" class="active">Download</a> <a href="team.php">Team</a>
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

        <button class="menu-toggle" id="menuToggle" aria-label="Open menu" aria-expanded="false">
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
            <p>Get the latest version of CivicEye for your operating system. AI-powered traffic violation detection with
                a user-friendly GUI, supporting local files, webcams, and RTSP streams. Choose between online
                (cloud-synced) and offline (local-only) modes for flexibility and privacy.</p>
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
                <p>CivicEye is an innovative AI-powered software designed to detect and monitor traffic violations (like
                    helmet non-compliance) using standard CCTV cameras, webcams, or video files. Leveraging the advanced
                    YOLOv8 object detection model, it offers a user-friendly graphical interface (GUI) and flexible
                    operation modes.
                </p>
            </section>

            <hr class="section-separator" data-aos="fade-up" data-aos-delay="100" />

            <section id="key-features" class="download-section" data-aos="fade-up" data-aos-delay="150">
                <h2>Key Features</h2>
                <ul>
                    <li><strong>Real-Time Violation Detection</strong>: Employs YOLOv8 to accurately detect 'With
                        Helmet' (green box) and 'Without Helmet' (red box) in various video sources.</li>
                    <li><strong>Multiple Video Sources</strong>: Supports local video files (<code>.mp4</code>,
                        <code>.avi</code>), connected PC webcams, and RTSP streams from CCTV cameras via the GUI.
                    </li>
                    <li><strong>Online & Offline Modes</strong>:
                        <ul>
                            <li><strong>Online Mode:</strong> Requires login (<code>civiceye.my</code> credentials).
                                Saves detection details/frames to a linked database. Remembers login session. Needs
                                internet for login/operation.</li>
                            <li><strong>Offline Mode:</strong> Uses predefined local credentials
                                Email: <code>admin@civiceye</code> Password: <code>civiceye</code> . Saves detection frames
                                locally to <code>Detects/</code> folder. No internet required after setup.
                            </li>
                        </ul>
                    </li>
                    <li><strong>Adjustable Detection Speed</strong>: Balance performance and accuracy with 'Fast',
                        'Balanced' (default), and 'Quality' modes, adjusting frame skipping.</li>
                    <li><strong>User-Friendly GUI</strong>: Intuitive graphical interface (Tkinter/ttkbootstrap) with
                        light/dark themes for easy operation.</li>
                    <li><strong>Secure User Authentication</strong>: Mandatory login screen for both online and offline
                        modes.</li>
                    <li><strong>Automated Setup & Launch</strong>: Includes scripts (<code>.bat</code> for Windows,
                        <code>.sh</code> for Linux) for easy installation and launching.
                    </li>
                    <li><strong>Local Processing Core</strong>: Even in Online Mode, core AI processing happens locally,
                        enhancing privacy. Offline mode is 100% local.</li>
                </ul>
            </section>

            <hr class="section-separator" data-aos="fade-up" data-aos-delay="150" />

            <section id="technical-overview" class="download-section" data-aos="fade-up" data-aos-delay="150">
                <h2>Technical Overview</h2>
                <h4>Programming Language:</h4>
                <p>Built primarily using <strong>Python 3.8+</strong>.</p>

                <h4>Core Libraries:</h4>
                <ol>
                    <li><strong>OpenCV (cv2)</strong>: Video stream handling (files, cameras, RTSP), frame processing,
                        image manipulation, saving detections.</li>
                    <li><strong>Ultralytics YOLOv8</strong>: Core real-time object detection model for helmet usage
                        identification.</li>
                    <li><strong>Tkinter & ttkbootstrap</strong>: GUI creation, widgets, and modern theming (light/dark).
                    </li>
                    <li><strong>Pillow (PIL Fork)</strong>: Image operations, especially for GUI display.</li>
                    <li><strong>Requests</strong>: Used for online authentication and potential communication with the
                        <code>civiceye.my</code> backend (Online Mode).
                    </li>
                    <li><strong>cvzone</strong>: (Potentially used, as in older versions) For drawing bounding boxes and
                        annotations easily.</li>
                    <li><strong>Database Library (Potential)</strong>: e.g., <code>sqlite3</code> or others like
                        <code>psycopg2</code>, depending on the Online Mode database implementation.
                    </li>
                </ol>
            </section>

            <hr class="section-separator" data-aos="fade-up" data-aos-delay="150" />

            <section id="future-enhancements" class="download-section" data-aos="fade-up" data-aos-delay="150">
                <h2>Future Enhancements Roadmap</h2>
                <ul>
                    <li>Develop a standalone executable installer (<code>.msi</code>) for further streamlined Windows
                        deployment.</li>
                    <li>Continuously refine the GUI based on user feedback for improved usability and aesthetics.</li>
                    <li>Expand the range of detectable violations to include "Triple Riding," "Wrong Way Driving," etc.
                    </li>
                    <li>Fine-tune the YOLO model for diverse regional traffic patterns and lighting conditions.</li>
                    <li>Integrate optional real-time alert mechanisms (e.g., email/SMS) for critical violations.</li>
                    <li>Enhance online mode features for aggregated analytics and reporting (user opt-in).</li>
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
                    <h2><i data-lucide="laptop"></i> Windows (Latest Version)</h2>

                    <h3>Installation Guide</h3>
                    <h4 title="Requires Windows 10 (64-bit) or newer. Python 3.8+ must be installed and added to PATH.">
                        System Requirements:</h4>
                    <ul>
                        <li><strong>OS:</strong> Windows 10 or later (64-bit recommended)</li>
                        <li><strong>Processor:</strong> Intel Core i3 (or equivalent AMD) or higher recommended</li>
                        <li><strong>RAM:</strong> 4GB (8GB Recommended for smoother performance)</li>
                        <li><strong>Storage:</strong> Approx. 5GB available disk space (Python, environment, detections)
                        </li>
                        <li><strong>Python:</strong> <a href="https://www.python.org/downloads/" target="_blank"
                                rel="noopener noreferrer">Python 3.8+</a> <strong>must be installed</strong> and
                            <strong>added to the system PATH</strong> during its installation (check "Add Python to
                            PATH").
                        </li>
                        <li><strong>Internet:</strong> Required during setup (<code>setup_civiceye.bat</code>) and for
                            Online Mode operation. Optional for Offline Mode after setup.</li>
                    </ul>

                    <h4>Setup Instructions:</h4>
                    <ol>
                        <li><strong>Download the Latest Release:</strong>
                            <br />Obtain the Windows package (<code>.zip</code> archive) from the <a
                                href="https://github.com/SHADOW2669/CivicEye/releases" target="_blank"
                                rel="noopener noreferrer">CivicEye Releases page</a>.
                            <div class="download-button-container">
                                <a href="https://github.com/SHADOW2669/CivicEye/archive/refs/tags/WINDOWS.zip"
                                    class="hero-btn primary"> <i data-lucide="download"></i>
                                    <span>Download Latest (Windows)</span> </a>
                            </div>
                        </li>
                        <li><strong>Extract the Archive:</strong>
                            <br />Right-click the downloaded <code>.zip</code> file and select "Extract All..." to a
                            suitable location (e.g., <code>C:\CivicEye</code>). Ensure the structure includes
                            <code>setup_civiceye.bat</code>, <code>requirements.txt</code>, and the <code>DATA</code>
                            folder.
                        </li>
                        <li><strong>Run Installation Script:</strong>
                            <br />Navigate into the extracted folder using File Explorer. Double-click the
                            <code>setup_civiceye.bat</code> script.
                            <br />A command prompt will open, check for Python, create a virtual environment
                            (<code>myenv</code>), install dependencies from <code>requirements.txt</code>, create a
                            launcher (<code>run_civiceye.bat</code>), and optionally create a desktop shortcut
                            (<code>CivicEye.lnk</code>). Administrator privileges might be requested.
                            <br />Follow the prompts in the command window (e.g., confirming deletion of setup files).
                        </li>
                        <li><strong>Launch the Application:</strong>
                            <br />Once setup is complete, navigate back to the project directory. Double-click
                            <code>run_civiceye.bat</code> to start the software. You can also use the
                            <code>CivicEye.lnk</code> shortcut if created.
                        </li>
                    </ol>

                    <h3>Software Workflow</h3>
                    <ol>
                        <li><strong>Login Screen</strong>: Launching the app presents the login screen.
                            <ul>
                                <li><strong>Online Mode:</strong> Enter your registered <code>civiceye.my</code> email
                                    and password. Click LOGIN. Requires internet.</li>
                                <li><strong>Offline Mode:</strong> Use Email: <code>admin@civiceye</code>, Password:
                                    <code>civiceye</code>. Click LOGIN. Operates locally.
                                </li>
                                <li><strong>Register:</strong> Opens <code>civiceye.my</code> registration page in
                                    browser.</li>
                            </ul>
                        </li>
                        <li><strong>Main Window & Video Source</strong>: After login, use the GUI buttons:
                            <ul>
                                <li><strong>Browse File:</strong> Select a local video file.</li>
                                <li><strong>Use PC Camera:</strong> Access the default system webcam.</li>
                                <li><strong>Connect CCTV:</strong> Enter an RTSP stream URL.</li>
                            </ul>
                        </li>
                        <li><strong>Side Menu (☰)</strong>: Access settings:
                            <ul>
                                <li><strong>Toggle Theme:</strong> Switch between Light/Dark modes.</li>
                                <li><strong>Detection Speed:</strong> Choose Fast (Skip=15), Balanced (Skip=30), Quality
                                    (Skip=60).</li>
                                <li><strong>Logout:</strong> Return to login screen (clears online session).</li>
                                <li><strong>Exit Application:</strong> Close the program.</li>
                            </ul>
                        </li>
                        <li><strong>Start/Stop Detection</strong>: Use the Green/Red buttons to control the AI
                            processing. The video preview shows detections (Green: Helmet, Red: No Helmet).</li>
                        <li><strong>Violation Logging & Storage</strong>:
                            <ul>
                                <li><strong>Online Mode:</strong> 'Without Helmet' detections saved to your linked
                                    database.</li>
                                <li><strong>Offline Mode:</strong> 'Without Helmet' detection frames saved as
                                    <code>.jpg</code> in the <code>Detects/</code> subfolder within the application
                                    directory.
                                </li>
                            </ul>
                        </li>
                        <li><strong>Status Bar</strong>: Displays current application status at the bottom.</li>
                    </ol>

                    <h3>Version Highlights (Windows Latest)</h3>
                    <ul>
                        <li><strong>Graphical User Interface (GUI)</strong>: Built with Tkinter & ttkbootstrap
                            (Light/Dark themes).</li>
                        <li><strong>Online/Offline Modes</strong>: Flexible operation with distinct authentication and
                            data saving.</li>
                        <li><strong>Multiple Video Sources</strong>: Support for Files, Webcams, and RTSP streams via
                            GUI.</li>
                        <li><strong>Adjustable Detection Speed</strong>: Control performance vs. accuracy trade-off.
                        </li>
                        <li><strong>Online Session Persistence</strong>: Remembers online login.</li>
                        <li><strong>Automated Setup (<code>setup_civiceye.bat</code>)</strong>: Simplifies installation
                            with virtual environment and dependency handling.</li>
                        <li><strong>Easy Launch (<code>run_civiceye.bat</code> / Shortcut)</strong>: Convenient ways to
                            start the application.</li>
                        <li><strong>Uninstaller Script (<code>uninstall_civiceye.bat</code>)</strong>: Provided for
                            component removal.</li>
                    </ul>
                </section>
            </div>

            <div id="linux-section-anchor" class="scroll-anchor"></div>
            <div class="os-container linux-container" data-aos="fade-up" data-aos-delay="200">
                <section id="linux" class="download-section">
                    <h2><i data-lucide="terminal"></i> Linux (Version 1.2)</h2>

                    <h3>Installation Guide</h3>
                    <h4 title="Tested on Debian/Ubuntu, Arch, Fedora. Requires Python 3.8+.">System Requirements:</h4>
                    <ul>
                        <li><strong>OS:</strong> Linux (Debian/Ubuntu, Arch, Fedora derivatives recommended)</li>
                        <li><strong>Processor:</strong> Intel Core i3 (or equivalent AMD) or higher recommended</li>
                        <li><strong>RAM:</strong> 4GB (8GB Recommended)</li>
                        <li><strong>Storage:</strong> Approx. 25GB available disk space (Dependencies, environment,
                            detections)</li>
                        <li><strong>Python:</strong> Python 3.8+ (Setup script installs <code>python3-venv</code>,
                            <code>python3-pip</code>, <code>python3-tk</code>)
                        </li>
                        <li><strong>Internet:</strong> Required during initial setup and for Online Mode operation.
                            Optional for Offline Mode after setup.</li>
                    </ul>

                    <h4>Setup Instructions (Terminal):</h4>
                    <ol>
                        <li><strong>Download or Clone Project:</strong> <br />Open your terminal.
                            <br />Option 1: Clone using Git:
                            <pre><code>git clone https://github.com/SHADOW2669/CivicEye.git</code><button class="copy-btn" aria-label="Copy command"><span class="copy-text">Copy</span><i data-lucide="copy" class="copy-icon"></i><i data-lucide="check" class="check-icon" style="display:none;"></i></button></pre>
                            Option 2: Download the v1.2 source code archive:
                            <div class="download-button-container">
                                <a href="https://github.com/SHADOW2669/CivicEye/archive/refs/tags/V1.2.zip"
                                    class="hero-btn primary"> <i data-lucide="download"></i>
                                    <span>Download v1.2 Source (zip)</span> </a>
                            </div>
                            (If downloaded, extract the archive: <code>unzip v1.2.zip</code>)
                        </li>
                        <li><strong>Navigate to Project Directory:</strong>
                            <pre><code>cd CivicEye # Or the extracted folder name</code><button class="copy-btn" aria-label="Copy command"><span class="copy-text">Copy</span><i data-lucide="copy" class="copy-icon"></i><i data-lucide="check" class="check-icon" style="display:none;"></i></button></pre>
                        </li>
                        <li><strong>Run Setup Script:</strong> <br />Make the setup script executable and run it. It
                            will prompt for <code>sudo</code> password to install system packages.
                            <pre><code class="language-bash">chmod +x setup_civiceye.sh
./setup_civiceye.sh</code><button class="copy-btn" aria-label="Copy command"><span class="copy-text">Copy</span><i data-lucide="copy" class="copy-icon"></i><i data-lucide="check" class="check-icon" style="display:none;"></i></button></pre>
                            The script detects your distro, installs dependencies, creates a virtual environment
                            (<code>myenv</code>), installs Python packages, creates a launcher
                            (<code>civiceye.sh</code>), and sets up desktop integration (<code>civiceye.desktop</code>).
                            <br /><strong>Note:</strong> The script deletes itself and <code>requirements.txt</code>
                            upon successful completion.
                        </li>
                        <li><strong>Launch the Application:</strong>
                            <br />Method 1: Use the Application Menu/Desktop Icon (Look for "CivicEye", may require
                            logout/login first time. Might need to "Trust and Launch").
                            <br />Method 2: Use the terminal launcher script:
                            <pre><code>./civiceye.sh</code><button class="copy-btn" aria-label="Copy command"><span class="copy-text">Copy</span><i data-lucide="copy" class="copy-icon"></i><i data-lucide="check" class="check-icon" style="display:none;"></i></button></pre>
                            (This activates the virtual environment and runs the Python script).
                        </li>
                    </ol>

                    <h3>Software Workflow</h3>
                    <ol>
                        <li><strong>Login Screen</strong>: Launching the app presents the login screen.
                            <ul>
                                <li><strong>Online Mode:</strong> Enter your registered <code>civiceye.my</code> email
                                    and password. Click LOGIN. Requires internet.</li>
                                <li><strong>Offline Mode:</strong> Use Email: <code>admin@civiceye</code>, Password:
                                    <code>civiceye</code>. Click LOGIN. Operates locally.
                                </li>
                                <li><strong>Register:</strong> Opens <code>civiceye.my</code> registration page in
                                    browser.</li>
                            </ul>
                        </li>
                        <li><strong>Main Window & Video Source</strong>: After login, use the GUI buttons:
                            <ul>
                                <li><strong>Browse File:</strong> Select a local video file.</li>
                                <li><strong>Use PC Camera:</strong> Access the default system webcam (e.g.,
                                    <code>/dev/video0</code>).
                                </li>
                                <li><strong>Connect CCTV:</strong> Enter an RTSP stream URL.</li>
                            </ul>
                        </li>
                        <li><strong>Side Menu (☰)</strong>: Access settings:
                            <ul>
                                <li><strong>Toggle Theme:</strong> Switch between Light/Dark modes.</li>
                                <li><strong>Detection Speed:</strong> Choose Fast, Balanced, Quality.</li>
                                <li><strong>Logout:</strong> Return to login screen (clears online session).</li>
                                <li><strong>Exit Application:</strong> Close the program.</li>
                            </ul>
                        </li>
                        <li><strong>Start/Stop Detection</strong>: Use the Green/Red buttons to control the AI
                            processing. The video preview shows detections (Green: Helmet, Red: No Helmet).</li>
                        <li><strong>Violation Logging & Storage</strong>:
                            <ul>
                                <li><strong>Online Mode:</strong> 'Without Helmet' detections saved to your linked
                                    database.</li>
                                <li><strong>Offline Mode:</strong> 'Without Helmet' detection frames saved as
                                    <code>.jpg</code> in the <code>Detects/</code> subfolder within the application
                                    directory.
                                </li>
                            </ul>
                        </li>
                        <li><strong>Status Bar</strong>: Displays current application status at the bottom.</li>
                    </ol>


                    <h3>Version 1.2 Highlights</h3>
                    <ul>
                        <li><strong>Graphical User Interface (GUI)</strong>: First Linux version with GUI
                            (Tkinter/ttkbootstrap), replacing command-line.</li>
                        <li><strong>Online/Offline Modes</strong>: Introduced flexible operation modes with specific
                            credentials.</li>
                        <li><strong>Multiple Video Sources</strong>: Support for Files, Webcams, and RTSP streams via
                            GUI.</li>
                        <li><strong>Adjustable Detection Speed</strong>: Control performance vs. accuracy.</li>
                        <li><strong>Online Session Persistence</strong>: Remembers online login.</li>
                        <li><strong>Enhanced Setup Script (<code>setup_civiceye.sh</code>)</strong>: Improved distro
                            detection, handles GUI dependencies, integrates with desktop environment.</li>
                        <li><strong>Desktop Integration</strong>: Creates <code>.desktop</code> launcher for application
                            menu/desktop.</li>
                        <li><strong>Self-Cleaning Setup</strong>: Setup script removes itself and requirements file
                            after success.</li>
                        <li><strong>Theming</strong>: Light ('litera') and Dark ('darkly') themes available.</li>
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
                    <a href="https://github.com/SHADOW2669/CivicEye" target="_blank" rel="noopener noreferrer"
                        aria-label="GitHub Repository"><img
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
                        <a href="#">Privacy Policy</a> <a href="#">Terms & Conditions</a> <a href="#">License</a>
                    </nav>
                </div>
            </div>
            <div class="footer-bottom">
                <div>&copy; <span id="currentYear"></span> Civic Eye. All rights reserved.</div>
                <div class="footer-bottom-links">
                    <a href="#">Privacy</a> <a href="#">Terms</a> <a href="#">Sitemap</a>
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
                        "color": { "value": ["#8300fe", "#a855f7", "#38bdf8", "#666"] }, // Array of colors
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
                            "enable": true, "speed": 1.8, "direction": "none", "random": true, "straight": false,
                            "out_mode": "out", "bounce": false, "attract": { "enable": true, "rotateX": 800, "rotateY": 1400 }
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
                    // console.log("Lucide icons initialized."); // Optional: uncomment for debugging
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
            const mobileNavLinks = document.querySelectorAll('.mobile-nav a'); // Select all links within mobile nav

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
                    e.stopPropagation(); // Prevent click from closing immediately if overlay is somehow under it
                    openMenu();
                });

                closeMenu.addEventListener('click', closeMenuFunc);
                overlay.addEventListener('click', closeMenuFunc); // Close when clicking overlay

                // Close menu when any mobile nav link is clicked
                mobileNavLinks.forEach(link => {
                    // Only add listener if it's a real link or a button container link
                    if (link.getAttribute('href') || link.classList.contains('login-btn-link')) {
                        link.addEventListener('click', closeMenuFunc);
                    }
                });

                document.addEventListener('keydown', e => {
                    if (e.key === 'Escape' && mobileNav.classList.contains('open')) {
                        closeMenuFunc(); // Close on escape key
                    }
                });

                // Prevent clicks inside the nav panel itself from closing it
                mobileNav.addEventListener('click', e => e.stopPropagation());

            } else {
                console.warn("Mobile navigation elements not found or IDs mismatch.");
            }

            // Smooth Scrolling for Anchor Links (Improved)
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const targetId = this.getAttribute('href');
                    // Ensure it's a valid internal link longer than just "#"
                    if (targetId && targetId.length > 1 && targetId.startsWith('#')) {
                        // Find the target element (could be the section or the anchor)
                        const targetElement = document.getElementById(targetId.substring(1)); // Use ID directly
                        const targetAnchor = document.querySelector(`.scroll-anchor${targetId}-anchor`); // Check for specific anchor class if used

                        const target = targetElement || targetAnchor; // Prefer direct ID match

                        if (target) {
                            e.preventDefault(); // Prevent default jump
                            const navHeight = document.querySelector('.navbar')?.offsetHeight || 70;
                            // Calculate position considering navbar height and a small offset
                            const elementPosition = target.getBoundingClientRect().top;
                            const offsetPosition = elementPosition + window.pageYOffset - navHeight - 20; // 20px extra space

                            window.scrollTo({
                                top: offsetPosition,
                                behavior: "smooth"
                            });
                        } else {
                            console.warn(`Smooth scroll target not found for href: ${targetId}`);
                        }
                    }
                });
            });


            // Clipboard Copy Functionality for Code Blocks
            document.querySelectorAll('.copy-btn').forEach(button => {
                button.addEventListener('click', async () => {
                    const pre = button.closest('pre');
                    const code = pre?.querySelector('code');
                    const textToCopy = code?.textContent || '';

                    // Find elements within this specific button
                    const copyTextSpan = button.querySelector('.copy-text');
                    const copyIcon = button.querySelector('.copy-icon');
                    const checkIcon = button.querySelector('.check-icon');

                    if (!code || !navigator.clipboard) {
                        console.error("Clipboard API not available or code element not found.");
                        if (copyTextSpan) copyTextSpan.textContent = 'Error'; // Provide feedback
                        return;
                    }

                    try {
                        await navigator.clipboard.writeText(textToCopy);

                        // Visual feedback for successful copy
                        if (copyTextSpan) copyTextSpan.style.display = 'none';
                        if (copyIcon) copyIcon.style.display = 'none';
                        if (checkIcon) checkIcon.style.display = 'inline-block'; // Show check
                        button.setAttribute('aria-label', 'Copied!');

                        // Reset button appearance after 2 seconds
                        setTimeout(() => {
                            if (copyTextSpan) copyTextSpan.style.display = 'inline-block'; // Show "Copy" text again
                            if (copyIcon) copyIcon.style.display = 'inline-block'; // Show copy icon again
                            if (checkIcon) checkIcon.style.display = 'none'; // Hide check
                            button.setAttribute('aria-label', 'Copy command'); // Reset aria-label
                        }, 2000);

                    } catch (err) {
                        console.error('Copy failed:', err);
                        if (copyTextSpan) copyTextSpan.textContent = 'Failed'; // Provide feedback
                        // Reset button appearance after 2 seconds
                        setTimeout(() => {
                            if (copyTextSpan) copyTextSpan.textContent = 'Copy';
                            button.setAttribute('aria-label', 'Copy command');
                        }, 2000);
                    }
                });
            });

            // Attempt to prevent browser scroll restoration on page load/refresh
            // This helps ensure the page loads at the top unless an anchor is specified
            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }
            // Scroll to top on initial load (unless there's a hash)
            if (!window.location.hash) {
                window.scrollTo(0, 0);
            }

        }); // End DOMContentLoaded
    </script>
</body>

</html>