<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Civic Eye - AI Traffic Monitoring</title>

    <link rel="shortcut icon" href="IMAGES/ppg.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css" />

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
        <a href="#hero-page" class="navbar-logo">
            <img src="IMAGES/logo1.png"
                onerror="this.onerror=null; this.src='https://placehold.co/150x40/111111/FFFFFF?text=CivicEye';"
                alt="Civic Eye Logo">
        </a>

        <div class="navbar-links">
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

    <main>
        <header id="hero-page" class="hero centered-hero">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="100">
                <p class="tagline">The Eye That Sees It All</p>
                <h1>Civic Eye</h1>
                <p class="info">
                    <span class="typed-text"></span><span class="cursor">&nbsp;</span>
                </p>
                <div class="hero-buttons" data-aos="fade-up" data-aos-delay="300">
                    <a href="download.php" class="hero-btn primary"><span>Get Started</span></a>
                    <a href="#features" class="hero-btn secondary">
                        <span>Learn More</span>
                        <i data-lucide="arrow-right"></i>
                    </a>
                </div>
                <div class="micro-features" data-aos="fade-up" data-aos-delay="500">
                    <span class="badge"><i data-lucide="zap"></i> Real-Time Detection</span>
                    <span class="badge"><i data-lucide="shield-check"></i> Local Privacy</span>
                    <span class="badge"><i data-lucide="database"></i> Evidence Logs</span>
                </div>
            </div>
            <a href="#features" class="hero-scroll-down" aria-label="Scroll to Features">
                <i data-lucide="arrow-down-circle"></i>
            </a>
        </header>

        <section id="features" class="content-section">
            <div class="section-heading" data-aos="fade-up">
                <h2 class="orange-heading">Features & Objectives</h2>
                <p class="subtitle">What makes Civic Eye powerful?</p>
            </div>
            <div class="info-grid">
                <div class="info-card purple" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon"><i data-lucide="scan-face"></i></div>
                    <h4>AI Detection</h4>
                    <p>Utilizes the powerful YOLOv8 model to accurately identify common traffic violations like 'No
                        Helmet' usage.</p>
                    <p class="benefit-caption">🎯 Pinpoint Accuracy</p>
                </div>
                <div class="info-card orange" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon"><i data-lucide="video"></i></div>
                    <h4>Real-Time Detection</h4>
                    <p>Analyzes live CCTV or video streams to automatically detect and classify traffic violations as
                        they happen.</p>
                    <p class="benefit-caption">⏱️ Zero Lag Detection</p>
                </div>
                <div class="info-card purple" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon"><i data-lucide="file-check"></i></div>
                    <h4>Evidence & Reporting</h4>
                    <p>Automatically captures clear images/clips of detected violations with crucial metadata, stored
                        locally.</p>
                    <p class="benefit-caption">🔍 Crystal-Clear Proof</p>
                </div>
                <div class="info-card orange" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon"><i data-lucide="server"></i></div>
                    <h4>Local Processing</h4>
                    <p>Performs all AI inference directly on the user's machine, enhancing data privacy and reducing
                        latency.</p>
                    <p class="benefit-caption">✅ Built for Local Privacy</p>
                </div>
                <div class="info-card purple" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon"><i data-lucide="database"></i></div>
                    <h4>Centralized Management</h4>
                    <p>Offers a secure web dashboard (optional) allowing authorized users to efficiently manage
                        violation data.</p>
                    <p class="benefit-caption">📊 Effortless Oversight</p>
                </div>
                <div class="info-card orange" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon"><i data-lucide="camera"></i></div>
                    <h4>Automated Evidence</h4>
                    <p>Generates reliable evidence by capturing high-resolution images and metadata for each violation.
                    </p>
                    <p class="benefit-caption">📸 Tamper-Proof Records</p>
                </div>
            </div>
            <div class="features-cta" data-aos="fade-up">
                <a href="#detection-workflow" class="hero-btn primary"> See How It Works
                    <i data-lucide="arrow-right" style="filter: invert(1); margin-left: 0.5em;"></i>
                </a>
            </div>
        </section>

        <hr class="section-separator" />

        <section id="detection-workflow" class="content-section">
            <div class="workflow-content-wrapper">
                <div class="workflow-header" data-aos="fade-up" data-aos-delay="100">
                    <h2>Detection Workflow</h2>
                    <p class="subtitle">A 5-step breakdown of how Civic Eye detects and logs traffic violations using AI
                        and local systems.</p>
                </div>
                <div class="workflow-grid-container">
                    <div class="workflow-visual-panel" data-aos="fade-right" data-aos-delay="300">
                        <img src="https://placehold.co/600x400/1f2937/c084fc?text=Workflow+Animation+(Camera+%E2%86%92+AI+%E2%86%92+Alert)"
                            onerror="this.onerror=null; this.src='https://placehold.co/600x400/1f2937/c084fc?text=Workflow+Visualization';"
                            alt="CivicEye Workflow Diagram">
                    </div>
                    <div class="workflow-steps-panel" data-aos="fade-left" data-aos-delay="400">
                        <ol class="workflow-steps-list">
                            <li class="step-card" data-aos="fade-up" data-aos-delay="500">
                                <div class="step-number-icon"><span>1</span><i data-lucide="camera"></i></div>
                                <div class="step-content">
                                    <h4>Configure Source</h4>
                                    <p>Easily connect existing CCTV cameras or select local video files as input.</p>
                                </div>
                            </li>
                            <li class="step-card" data-aos="fade-up" data-aos-delay="600">
                                <div class="step-number-icon"><span>2</span><i data-lucide="server"></i></div>
                                <div class="step-content">
                                    <h4>Run Local Detection</h4>
                                    <p>Initiate the AI detection process securely on your local machine, ensuring
                                        privacy.</p>
                                </div>
                            </li>
                            <li class="step-card" data-aos="fade-up" data-aos-delay="700">
                                <div class="step-number-icon"><span>3</span><i data-lucide="brain-circuit"></i></div>
                                <div class="step-content">
                                    <h4>AI Processing</h4>
                                    <p>The integrated YOLOv8 model analyzes the feed in real-time to identify
                                        violations.</p>
                                </div>
                            </li>
                            <li class="step-card" data-aos="fade-up" data-aos-delay="800">
                                <div class="step-number-icon"><span>4</span><i data-lucide="clapperboard"></i></div>
                                <div class="step-content">
                                    <h4>Evidence Capture</h4>
                                    <p>Violations trigger automatic capture of image/clip evidence with timestamp
                                        metadata.</p>
                                </div>
                            </li>
                            <li class="step-card" data-aos="fade-up" data-aos-delay="900">
                                <div class="step-number-icon"><span>5</span><i data-lucide="monitor-check"></i></div>
                                <div class="step-content">
                                    <h4>Monitor & Review</h4>
                                    <p>Access violation logs and evidence locally or via the optional central dashboard.
                                    </p>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="workflow-demo-button-container" data-aos="fade-up" data-aos-delay="1000">
                    <a href="#tech-details" class="hero-btn secondary">
                        <i data-lucide="play"></i>
                        <span>Start Demo</span>
                    </a>
                </div>
            </div>
        </section>

        <hr class="section-separator" />

        <section id="tech-details" class="content-section">
            <div class="tech-layout-container">
                <div class="tech-text-content" data-aos="fade-right" data-aos-delay="100">
                    <h3 class="orange-heading">Technical Details</h3>
                    <p>Built with standard, powerful tools for efficient local processing on accessible hardware.</p>
                    <ul class="tech-specs-grid">
                        <li class="tech-spec-item" data-aos="fade-up" data-aos-delay="200">
                            <i data-lucide="monitor-smartphone" class="icon"></i>
                            <span><strong>OS:</strong> Windows 10+ or Linux</span>
                        </li>
                        <li class="tech-spec-item" data-aos="fade-up" data-aos-delay="250">
                            <i data-lucide="cpu" class="icon"></i>
                            <span><strong>Processor:</strong> Intel i3+ / AMD Ryzen 3+</span>
                        </li>
                        <li class="tech-spec-item" data-aos="fade-up" data-aos-delay="300">
                            <i data-lucide="memory-stick" class="icon"></i>
                            <span><strong>RAM:</strong> 4GB+ (8GB Recommended)</span>
                        </li>
                        <li class="tech-spec-item" data-aos="fade-up" data-aos-delay="350">
                            <i data-lucide="hard-drive" class="icon"></i>
                            <span><strong>Storage:</strong> 5GB Free Space</span>
                        </li>
                        <li class="tech-spec-item" data-aos="fade-up" data-aos-delay="400">
                            <i data-lucide="code-2" class="icon"></i>
                            <span><strong>Language:</strong> Python 3.8+</span>
                        </li>
                        <li class="tech-spec-item" data-aos="fade-up" data-aos-delay="450">
                            <i data-lucide="image" class="icon"></i>
                            <span><strong>Core Lib:</strong> OpenCV</span>
                        </li>
                        <li class="tech-spec-item" data-aos="fade-up" data-aos-delay="500">
                            <i data-lucide="brain-circuit" class="icon"></i>
                            <span><strong>AI Model:</strong> YOLOv8</span>
                        </li>
                        <li class="tech-spec-item" data-aos="fade-up" data-aos-delay="550">
                            <i data-lucide="gpu" class="icon"></i> <span><strong>GPU:</strong> Optional
                                (CUDA/ROCm)</span>
                        </li>
                    </ul>
                </div>
                <div class="code-block-container" data-aos="fade-left" data-aos-delay="200">
                    <div class="code-title-bar">
                        <div class="window-buttons">
                            <span class="close"></span><span class="minimize"></span><span class="maximize"></span>
                        </div>
                        <span class="code-filename">civiceye.py</span>
                        <button id="copy-code-btn" title="Copy Code">
                            <i data-lucide="clipboard"></i>
                        </button>
                    </div>
                    <pre><code class="language-python" id="code-to-copy">
<span class="code-comment"># Import necessary libraries</span>
<span class="code-keyword">import</span> <span class="code-variable">cv2</span>
<span class="code-keyword">import</span> <span class="code-variable">math</span>
<span class="code-keyword">import</span> <span class="code-variable">cvzone</span>
<span class="code-keyword">import</span> <span class="code-variable">os</span>
<span class="code-keyword">from</span> <span class="code-variable">ultralytics</span> <span class="code-keyword">import</span> <span class="code-variable">YOLO</span>

<span class="code-comment"># Get media input (camera or video file)</span>
<span class="code-variable">media_input</span> = <span class="code-builtin">input</span>(<span class="code-string">"Enter video path or leave blank for camera: "</span>).strip()
<span class="code-keyword">if</span> <span class="code-keyword">not</span> <span class="code-variable">media_input</span>:
    <span class="code-variable">cap</span> = cv2.VideoCapture(<span class="code-number">0</span>) <span class="code-comment"># Default camera</span>
<span class="code-keyword">else</span>:
    <span class="code-variable">cap</span> = cv2.VideoCapture(<span class="code-variable">media_input</span>) <span class="code-comment"># Video file</span>

<span class="code-comment"># Load the pre-trained YOLOv8 model</span>
<span class="code-variable">model</span> = YOLO(<span class="code-string">"Weights/best.pt"</span>)

<span class="code-comment"># Define class names for detection</span>
<span class="code-variable">classNames</span> = [<span class="code-string">'With Helmet'</span>, <span class="code-string">'Without Helmet'</span>]

<span class="code-comment"># Setup directory for saving violation images</span>
<span class="code-variable">save_dir</span> = <span class="code-string">"Detects"</span>
os.makedirs(<span class="code-variable">save_dir</span>, exist_ok=<span class="code-boolean">True</span>)

<span class="code-variable">violating_ids</span> = {} <span class="code-comment"># Track saved violations to avoid duplicates per run</span>
<span class="code-variable">frame_count</span> = <span class="code-number">0</span>

<span class="code-comment"># Main detection loop</span>
<span class="code-keyword">while</span> <span class="code-boolean">True</span>:
    <span class="code-variable">success</span>, <span class="code-variable">img</span> = <span class="code-variable">cap</span>.<span class="code-method">read</span>()
    <span class="code-keyword">if</span> <span class="code-keyword">not</span> <span class="code-variable">success</span>:
        <span class="code-keyword">break</span> <span class="code-comment"># End of video or camera error</span>

    <span class="code-comment"># Run YOLO model on the current frame</span>
    <span class="code-variable">results</span> = <span class="code-variable">model</span>(<span class="code-variable">img</span>, stream=<span class="code-boolean">True</span>)
    <span class="code-variable">frame_has_violation</span> = <span class="code-boolean">False</span>

    <span class="code-comment"># Process detection results</span>
    <span class="code-keyword">for</span> <span class="code-variable">r</span> <span class="code-keyword">in</span> <span class="code-variable">results</span>:
        <span class="code-variable">boxes</span> = <span class="code-variable">r</span>.<span class="code-variable">boxes</span>
        <span class="code-keyword">for</span> <span class="code-variable">box</span> <span class="code-keyword">in</span> <span class="code-variable">boxes</span>:
            <span class="code-comment"># Extract bounding box coordinates</span>
            <span class="code-variable">x1</span>, <span class="code-variable">y1</span>, <span class="code-variable">x2</span>, <span class="code-variable">y2</span> = <span class="code-builtin">map</span>(<span class="code-builtin">int</span>, <span class="code-variable">box</span>.<span class="code-variable">xyxy</span>[<span class="code-number">0</span>])
            <span class="code-comment"># Get confidence score and class ID</span>
            <span class="code-variable">conf</span> = math.ceil((<span class="code-variable">box</span>.<span class="code-variable">conf</span>[<span class="code-number">0</span>] * <span class="code-number">100</span>)) / <span class="code-number">100</span>
            <span class="code-variable">cls</span> = <span class="code-builtin">int</span>(<span class="code-variable">box</span>.<span class="code-variable">cls</span>[<span class="code-number">0</span>])
            <span class="code-variable">currentClass</span> = <span class="code-variable">classNames</span>[<span class="code-variable">cls</span>]

            <span class="code-comment"># Draw bounding box and label</span>
            cvzone.cornerRect(<span class="code-variable">img</span>, (<span class="code-variable">x1</span>, <span class="code-variable">y1</span>, <span class="code-variable">x2</span> - <span class="code-variable">x1</span>, <span class="code-variable">y2</span> - <span class="code-variable">y1</span>))
            cvzone.putTextRect(<span class="code-variable">img</span>, <span class="code-string">f'{currentClass} {conf}'</span>,
                               (<span class="code-builtin">max</span>(<span class="code-number">0</span>, <span class="code-variable">x1</span>), <span class="code-builtin">max</span>(<span class="code-number">35</span>, <span class="code-variable">y1</span>)),
                               scale=<span class="code-number">1</span>, thickness=<span class="code-number">1</span>)

            <span class="code-comment"># Check if the detected class is a violation</span>
            <span class="code-keyword">if</span> <span class="code-variable">currentClass</span> == <span class="code-string">"Without Helmet"</span>:
                <span class="code-variable">frame_has_violation</span> = <span class="code-boolean">True</span>

    <span class="code-comment"># Save the frame if a violation was detected in it</span>
    <span class="code-keyword">if</span> <span class="code-variable">frame_has_violation</span>:
        <span class="code-variable">img_filename</span> = <span class="code-string">f"violation_{frame_count:04d}.jpg"</span> <span class="code-comment"># Padded frame number</span>
        <span class="code-comment"># Simple check to avoid saving the exact same frame number repeatedly</span>
        <span class="code-keyword">if</span> <span class="code-variable">img_filename</span> <span class="code-keyword">not</span> <span class="code-keyword">in</span> <span class="code-variable">violating_ids</span>:
            <span class="code-variable">save_path</span> = os.path.join(<span class="code-variable">save_dir</span>, <span class="code-variable">img_filename</span>)
            cv2.imwrite(<span class="code-variable">save_path</span>, <span class="code-variable">img</span>)
            <span class="code-variable">violating_ids</span>[<span class="code-variable">img_filename</span>] = <span class="code-boolean">True</span>
            <span class="code-builtin">print</span>(<span class="code-string">f"Violation detected! Saved: {save_path}"</span>)

    <span class="code-variable">frame_count</span> += <span class="code-number">1</span>

    <span class="code-comment"># Display the processed frame</span>
    cv2.imshow(<span class="code-string">"Civic Eye Detection"</span>, <span class="code-variable">img</span>)
    <span class="code-comment"># Exit loop if 'q' is pressed</span>
    <span class="code-keyword">if</span> cv2.waitKey(<span class="code-number">1</span>) & <span class="code-number">0xFF</span> == <span class="code-builtin">ord</span>(<span class="code-string">'q'</span>):
        <span class="code-keyword">break</span>

<span class="code-comment"># Release resources</span>
<span class="code-variable">cap</span>.<span class="code-method">release</span>()
cv2.destroyAllWindows()
                    </code></pre>
                </div>
            </div>
        </section>

        <hr class="section-separator" />

        <section id="cta-section" class="content-section cta-section">
            <div class="cta-content" data-aos="fade-up" data-aos-delay="100">
                <h2>Get Started with <span class="pulse-text">CivicEye</span></h2>
                <p data-aos="fade-up" data-aos-delay="200">Download the latest version for your operating system and
                    start improving traffic safety today. Access real-time violation detection powered by AI, right on
                    your local machine.</p>
                <div class="hero-buttons" data-aos="fade-up" data-aos-delay="300">
                    <a href="download.php" class="hero-btn primary">
                        <span>Download Now</span>
                        <i data-lucide="download" class="lucide-download"></i>
                    </a>
                    <a href="contact-us.php" class="hero-btn secondary"><span>Contact Us</span></a>
                </div>
            </div>
        </section>
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
                    <a href="#" target="_blank" aria-label="Facebook Profile"><img
                            src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/facebook.svg"
                            alt="Facebook" /></a>
                    <a href="#" target="_blank" aria-label="Instagram Profile"><img
                            src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/instagram.svg"
                            alt="Instagram" /></a>
                    <a href="#" target="_blank" aria-label="LinkedIn Profile"><img
                            src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/linkedin.svg"
                            alt="LinkedIn" /></a>
                    <a href="#" target="_blank" aria-label="YouTube Profile"><img
                            src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/youtube.svg"
                            alt="YouTube" /></a>
                </div>
            </div>
            <div class="footer-links-section">
                <div class="footer-links-column">
                    <h3>Quick Links</h3>
                    <nav>
                        <a href="#hero-page">Home</a>
                        <a href="#features">Features</a>
                        <a href="#detection-workflow">Workflow</a>
                        <a href="#tech-details">Tech</a>
                    </nav>
                </div>
                <div class="footer-links-column">
                    <h3>Resources</h3>
                    <nav>
                        <a href="download.php">Download</a>
                        <a href="#">Documentation</a>
                        <a href="#tech-details">Requirements</a>
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

            if (typeof particlesJS !== 'undefined') {
                particlesJS("particles-js", {
                    "particles": {
                        "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
                        "color": { "value": ["#8300fe", "#38bdf8", "#555"] },
                        "shape": { "type": "circle" },
                        "opacity": {
                            "value": 0.6, "random": true,
                            "anim": { "enable": true, "speed": 0.6, "opacity_min": 0.15, "sync": false }
                        },
                        "size": {
                            "value": 2.5, "random": true,
                            "anim": { "enable": false }
                        },
                        "line_linked": {
                            "enable": true, "distance": 130, "color": "#555",
                            "opacity": 0.5, "width": 1
                        },
                        "move": {
                            "enable": true, "speed": 1.5, "direction": "none", "random": true,
                            "straight": false, "out_mode": "out", "bounce": false,
                            "attract": { "enable": true, "rotateX": 600, "rotateY": 1200 }
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
                            "grab": { "distance": 140, "line_linked": { "opacity": 0.7 } },
                            "push": { "particles_nb": 4 }
                        }
                    },
                    "retina_detect": true
                });
            } else {
                console.error("particles.js library not loaded.");
            }

            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    once: false,
                    offset: 50,
                    easing: 'ease-out-cubic',
                });
            } else {
                console.error("AOS library not loaded.");
            }

            const infoElement = document.querySelector('.hero-content .info .typed-text');
            const cursorElement = document.querySelector('.hero-content .info .cursor');
            const textToType = "Advanced AI detects traffic violations like helmet usage from CCTV feeds in real-time. Local processing ensures privacy.";
            let charIndex = 0;

            function typeText() {
                if (infoElement && charIndex < textToType.length) {
                    infoElement.textContent += textToType.charAt(charIndex);
                    charIndex++;
                    setTimeout(typeText, 40);
                } else if (cursorElement) {
                    cursorElement.style.animation = 'blinkCursor 0.7s infinite';
                    cursorElement.style.opacity = '1';
                }
            }

            if (infoElement && cursorElement) {
                infoElement.textContent = '';
                cursorElement.style.opacity = '1';
                setTimeout(typeText, 800);
            }

            const copyButton = document.getElementById('copy-code-btn');
            const codeToCopyElement = document.getElementById('code-to-copy');

            if (copyButton && codeToCopyElement) {
                copyButton.addEventListener('click', () => {
                    const codeText = codeToCopyElement.textContent || codeToCopyElement.innerText;
                    navigator.clipboard.writeText(codeText).then(() => {
                        copyButton.title = 'Copied!';
                        copyButton.innerHTML = '<i data-lucide="check" style="width: 16px; height: 16px; vertical-align: middle; color: #28c940;"></i>';
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                        setTimeout(() => {
                            copyButton.title = 'Copy Code';
                            copyButton.innerHTML = '<i data-lucide="clipboard" style="width: 16px; height: 16px; vertical-align: middle;"></i>';
                            if (typeof lucide !== 'undefined') lucide.createIcons();
                        }, 2000);
                    }).catch(err => {
                        console.error('Failed to copy code: ', err);
                        copyButton.title = 'Failed to copy';
                        copyButton.innerHTML = '<i data-lucide="x-circle" style="width: 16px; height: 16px; vertical-align: middle; color: #ff5f57;"></i>';
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                        setTimeout(() => {
                            copyButton.title = 'Copy Code';
                            copyButton.innerHTML = '<i data-lucide="clipboard" style="width: 16px; height: 16px; vertical-align: middle;"></i>';
                            if (typeof lucide !== 'undefined') lucide.createIcons();
                        }, 2000);
                    });
                });
            }

            const hamburgerBtn = document.querySelector('.hamburger-menu');
            const mobileNav = document.querySelector('.mobile-nav-menu');
            const closeNavBtn = document.querySelector('.close-menu-btn');

            if (hamburgerBtn && mobileNav && closeNavBtn) {
                const navLinks = mobileNav.querySelectorAll('a');

                const toggleNav = (event) => {
                    if (event) event.stopPropagation();
                    const isActive = mobileNav.classList.toggle('active');
                    document.body.classList.toggle('no-scroll', isActive);
                };

                const closeNav = () => {
                    if (mobileNav.classList.contains('active')) {
                        mobileNav.classList.remove('active');
                        document.body.classList.remove('no-scroll');
                    }
                };

                hamburgerBtn.addEventListener('click', toggleNav);
                closeNavBtn.addEventListener('click', closeNav);

                navLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        setTimeout(closeNav, 100);
                    });
                });

                document.addEventListener('click', (event) => {
                    if (mobileNav.classList.contains('active') &&
                        !mobileNav.contains(event.target) &&
                        !hamburgerBtn.contains(event.target)) {
                        closeNav();
                    }
                });

                mobileNav.addEventListener('click', (event) => {
                    event.stopPropagation();
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape' && mobileNav.classList.contains('active')) {
                        closeNav();
                    }
                });
            }

            if (typeof lucide !== 'undefined') {
                try {
                    lucide.createIcons();
                    console.log("Lucide icons initialized.");
                } catch (e) {
                    console.error("Lucide icons initialization failed:", e);
                }
            } else {
                console.error("Lucide library not loaded.");
            }

        });
    </script>
</body>

</html>