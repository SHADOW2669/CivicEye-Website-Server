<?php
// --- Start: Updated PHP code for fetching data with pagination ---
require_once 'auth.php'; // Existing authentication check
protect('user'); // Only users allowed

// Include database configuration (NEW dependency)
require_once 'config.php'; // Assumes this file sets up a $conn variable (mysqli or PDO)

// Start session if not already started (needed for $_SESSION)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// --- Configuration ---
$limit = 8; // Number of items to load per page/request
$offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0; // Get offset from query param, default 0 for initial load
$is_ajax = isset($_GET['ajax']) && $_GET['ajax'] === 'true'; // Check if it's an AJAX request

// --- Initialization ---
$detections = []; // Initialize as empty array for fetched items
$user_id = null;
$total_detections_for_user = 0; // Total count for the logged-in user
$pending_detections = 0;       // Stats based on total
$approved_detections = 0;      // Stats based on total
$rejected_detections = 0;      // Stats based on total
$approval_percentage = 0;      // Stats based on total

// --- Get User ID ---
if (isset($_SESSION['email'])) {
    $user_email = $_SESSION['email'];
    $stmt_user = $conn->prepare("SELECT id FROM users WHERE email = ?");
    if ($stmt_user) {
        $stmt_user->bind_param("s", $user_email);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();
        if ($result_user->num_rows > 0) {
            $user_id = $result_user->fetch_assoc()['id'];
        }
        $stmt_user->close();
    } else {
        error_log("Error preparing user statement: " . $conn->error);
    }
} else {
    error_log("User email not found in session.");
    // Redirect to login or show error (outside this snippet)
}

// --- Fetch Data if User ID is valid ---
if ($user_id !== null) {

    // 1. Get TOTAL count for the user (needed for stats and Load More logic)
    $stmt_count = $conn->prepare("SELECT COUNT(*) as total FROM detections WHERE user_id = ?");
    if ($stmt_count) {
        $stmt_count->bind_param("i", $user_id);
        $stmt_count->execute();
        $result_count = $stmt_count->get_result();
        $total_detections_for_user = $result_count->fetch_assoc()['total'] ?? 0;
        $stmt_count->close();
    } else {
        error_log("Error preparing count statement: " . $conn->error);
    }

    // 2. Fetch the required SUBSET of detections (paginated)
    $stmt_detections = $conn->prepare("SELECT * FROM detections WHERE user_id = ? ORDER BY timestamp DESC LIMIT ? OFFSET ?");
    if ($stmt_detections) {
        $stmt_detections->bind_param("iii", $user_id, $limit, $offset);
        $stmt_detections->execute();
        $result_detections = $stmt_detections->get_result();
        while ($row = $result_detections->fetch_assoc()) {
            // Prepare image data *only* for AJAX requests to avoid sending large blobs unnecessarily
            if ($is_ajax && !empty($row['image'])) {
                // Base64 encode for JSON transport
                $row['image_base64'] = base64_encode($row['image']);
                unset($row['image']); // Remove raw blob data from JSON payload
            }
            // For non-AJAX (initial load), keep the raw 'image' field for direct embedding
            $detections[] = $row;
        }
        $stmt_detections->close();
    } else {
        error_log("Error preparing paginated detections statement: " . $conn->error);
    }

    // 3. Calculate Stats based on TOTAL counts (only needed for initial load display)
    if (!$is_ajax) {
        // Query for counts by status (more efficient than looping through all results)
        $stmt_stats = $conn->prepare("SELECT status, COUNT(*) as count FROM detections WHERE user_id = ? GROUP BY status");
        if ($stmt_stats) {
            $stmt_stats->bind_param("i", $user_id);
            $stmt_stats->execute();
            $result_stats = $stmt_stats->get_result();
            while ($stat_row = $result_stats->fetch_assoc()) {
                switch (strtolower($stat_row['status'] ?? 'pending')) { // Ensure status is lowercased and handle potential null
                    case 'approved':
                        $approved_detections = (int) $stat_row['count'];
                        break;
                    case 'rejected':
                        $rejected_detections = (int) $stat_row['count'];
                        break;
                    case 'pending':
                        $pending_detections += (int) $stat_row['count']; // Add to pending
                        break;
                    default:
                        // Count any other unknown status as pending for simplicity
                        $pending_detections += (int) $stat_row['count'];
                        break;
                }
            }
            $stmt_stats->close();

            // Recalculate total based on summed stats to ensure consistency if GROUP BY missed some statuses (unlikely but safe)
            // $total_detections = $approved_detections + $rejected_detections + $pending_detections;
            // Use the direct total count for accuracy:
            $total_detections = $total_detections_for_user;


            // Calculate approval percentage using the accurate total
            $approval_percentage = ($total_detections > 0) ? round(((float) $approved_detections / $total_detections) * 100) : 0;

        } else {
            error_log("Error preparing stats statement: " . $conn->error);
            // Fallback or error display might be needed here
            // Set stats based on the initial limited fetch (less accurate) only as a last resort
            $total_detections = count($detections); // Inaccurate if more pages exist
            // Recalculate stats based on the limited $detections array (inaccurate)
            // This logic should ideally not be reached if the stats query works.
            foreach ($detections as $row) {
                switch (strtolower($row['status'] ?? 'pending')) {
                    case 'approved':
                        $approved_detections++;
                        break;
                    case 'rejected':
                        $rejected_detections++;
                        break;
                    default:
                        $pending_detections++;
                        break;
                }
            }
            $approval_percentage = ($total_detections > 0) ? round(((float) $approved_detections / $total_detections) * 100) : 0;
        }
    }
} // End if ($user_id !== null)

// --- Output ---
if ($is_ajax) {
    // Return JSON for AJAX requests
    header('Content-Type: application/json');
    echo json_encode([
        'detections' => $detections,
        // Determine if there are more items to load after this batch
        'has_more' => ($offset + count($detections)) < $total_detections_for_user
    ]);

    // Close the database connection for AJAX request
    if (isset($conn) && (is_object($conn) || is_resource($conn)) && method_exists($conn, 'close')) {
        $conn->close();
    }
    exit; // IMPORTANT: Stop script execution after sending JSON
}

// --- Close DB connection for standard page load before rendering HTML ---
if (isset($conn) && (is_object($conn) || is_resource($conn)) && method_exists($conn, 'close')) {
    $conn->close();
}

// --- End: Updated PHP code ---
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Civic Eye | User Detections</title>
    <link rel="shortcut icon" href="IMAGES/ppg.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.396.0/dist/umd/lucide.min.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>

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
                <rect width="100" height="12" rx="6" fill="currentColor"></rect>
                <rect y="34" width="100" height="12" rx="6" fill="currentColor"></rect>
                <rect y="68" width="100" height="12" rx="6" fill="currentColor"></rect>
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
            <header class="dashboard-header" data-aos="fade-down">
                <h1>Detected Violations</h1>
            </header>

            <section class="stats-section" data-aos="fade-up">
                <div class="stats-numbers">
                    <div class="stat-item total">
                        <span class="stat-value"><?php echo $total_detections_for_user; ?></span>
                        <span class="stat-label">Total Detections</span>
                    </div>
                    <div class="stat-item pending">
                        <span class="stat-value"><?php echo $pending_detections; ?></span>
                        <span class="stat-label">Pending Review</span>
                    </div>
                    <div class="stat-item approved">
                        <span class="stat-value"><?php echo $approved_detections; ?></span>
                        <span class="stat-label">Approved Violations</span>
                    </div>
                    <div class="stat-item rejected">
                        <span class="stat-value"><?php echo $rejected_detections; ?></span>
                        <span class="stat-label">Rejected / False</span>
                    </div>
                </div>
                <div class="status-bar-container">
                    <div class="status-bar-label-text">Approval Rate (Approved / Total)</div>
                    <div class="status-bar-outer">
                        <div class="status-bar-inner" style="width: 0%;"
                            data-percentage="<?php echo $approval_percentage; ?>"></div>
                        <span class="status-bar-percentage">0%</span>
                    </div>
                </div>
            </section>

            <div class="violations-grid" id="violationsGrid" data-aos="fade-up" data-aos-delay="100">
                <?php if (!empty($detections)): ?>
                    <?php foreach ($detections as $row): ?>
                        <div class="violation-card">
                            <?php // Use raw image blob for initial load ?>
                            <?php if (!empty($row['image'])): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>"
                                    alt="Detection Image (Timestamp: <?php echo htmlspecialchars($row['timestamp']); ?>)"
                                    onerror="this.style.backgroundColor='#333'; this.alt='Image load error'; this.src='https://placehold.co/400x220/333333/cccccc?text=Error+Loading';">
                            <?php else: // Display placeholder if no image data ?>
                                <img src="https://placehold.co/400x220/111827/666666?text=No+Image+Available"
                                    alt="No Image Available (Timestamp: <?php echo htmlspecialchars($row['timestamp']); ?>)"
                                    style="background-color: #222;">
                            <?php endif; ?>
                            <div class="violation-details">
                                <h4>Violation:
                                    <?php echo !empty($row['helmet_status']) ? htmlspecialchars(ucfirst($row['helmet_status'])) : 'Unknown Type'; ?>
                                </h4>
                                <p><strong>Date:</strong> <?php echo date('Y-m-d', strtotime($row['timestamp'])); ?></p>
                                <p><strong>Time:</strong> <?php echo date('H:i:s', strtotime($row['timestamp'])); ?></p>
                                <p><strong>Status:</strong>
                                    <?php
                                    // Determine status color and text
                                    $status = strtolower($row['status'] ?? 'pending');
                                    $status_text = ucfirst($status);
                                    $status_color = '#ffb74d'; // Default: Pending (Orange)
                                    if ($status == 'approved') {
                                        $status_color = '#4db6ac'; // Teal
                                    } elseif ($status == 'rejected') {
                                        $status_color = '#ef5350'; // Red
                                    }
                                    echo '<span style="color: ' . $status_color . ';">' . htmlspecialchars($status_text) . '</span>';
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php elseif ($total_detections_for_user === 0): // Show message only if total is truly 0 ?>
                    <p class="no-violations-message">No violations detected for your account yet.</p>
                <?php endif; ?>
                <?php // Note: The 'else' for the initial load might seem empty if total > 0 but offset >= total ?>
            </div>

            <div id="loadMoreContainer" data-aos="fade-up">
                <?php
                // Show button container initially only if the total count is greater than the number initially loaded
                if ($total_detections_for_user > count($detections)):
                    ?>
                    <button id="loadMoreBtn" class="btn-base btn-nav-action">
                        <i data-lucide="rotate-cw"></i>
                        <span>Load More</span>
                    </button>
                    <p id="loadingIndicator" style="display: none;">Loading...</p>
                    <p id="loadError" style="display: none;">Could not load more items.</p>
                <?php endif; ?>
                <?php // If total detections is 0, this container won't render, which is correct. ?>
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
                        <a href="#">Privacy Policy</a> <a href="#">Terms & Conditions</a>
                    </nav>
                </div>
            </div>
            <div class="footer-bottom">
                <div>&copy; 2025 Civic Eye. All rights reserved.</div>
                <div class="footer-bottom-links">
                    <a href="#">Privacy</a> <a href="#">Terms</a>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // --- Initialize Particles.js ---
            if (typeof particlesJS !== 'undefined') {
                particlesJS("particles-js", { /* Your particles config */
                    "particles": {
                        "number": { "value": 60, "density": { "enable": true, "value_area": 800 } },
                        "color": { "value": ["#8300fe", "#a855f7", "#38bdf8", "#555555"] },
                        "shape": { "type": "circle" },
                        "opacity": { "value": 0.5, "random": true, "anim": { "enable": true, "speed": 0.8, "opacity_min": 0.1, "sync": false } },
                        "size": { "value": 2.8, "random": true, "anim": { "enable": false } },
                        "line_linked": { "enable": true, "distance": 140, "color": "#444444", "opacity": 0.35, "width": 1 },
                        "move": { "enable": true, "speed": 1.6, "direction": "none", "random": true, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": true, "rotateX": 700, "rotateY": 1300 } }
                    },
                    "interactivity": {
                        "detect_on": "canvas",
                        "events": { "onhover": { "enable": true, "mode": "grab" }, "onclick": { "enable": true, "mode": "push" }, "resize": true },
                        "modes": { "grab": { "distance": 150, "line_linked": { "opacity": 0.6 } }, "push": { "particles_nb": 3 } }
                    },
                    "retina_detect": true
                });
            } else { console.error("particles.js library not loaded."); }

            // --- Initialize AOS (Animate On Scroll) ---
            if (typeof AOS !== 'undefined') {
                AOS.init({ duration: 900, once: false, offset: 80, easing: 'ease-out-quart' });
            } else { console.error("AOS library not loaded."); }

            // --- Mobile Navigation Toggle Logic ---
            const hamburgerBtn = document.querySelector('.hamburger-menu');
            const mobileNav = document.querySelector('.mobile-nav-menu');
            const closeNavBtn = document.querySelector('.close-menu-btn');
            const allNavLinks = mobileNav ? mobileNav.querySelectorAll('a') : [];
            const body = document.body;

            const toggleNav = (event) => {
                if (event) event.stopPropagation();
                if (mobileNav && body && hamburgerBtn) {
                    const isActive = mobileNav.classList.toggle('active');
                    body.classList.toggle('no-scroll', isActive);
                    hamburgerBtn.setAttribute('aria-expanded', isActive.toString());
                    mobileNav.setAttribute('aria-hidden', (!isActive).toString());
                } else { console.error("Mobile navigation elements not found for toggle."); }
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
                allNavLinks.forEach(link => { link.addEventListener('click', () => { setTimeout(closeNav, 150); }); });
                document.addEventListener('click', (event) => { if (mobileNav.classList.contains('active') && !mobileNav.contains(event.target) && !hamburgerBtn.contains(event.target)) { closeNav(); } });
                mobileNav.addEventListener('click', (event) => { event.stopPropagation(); });
                document.addEventListener('keydown', (event) => { if (event.key === 'Escape' && mobileNav.classList.contains('active')) { closeNav(); } });
            } else { console.error("Could not attach mobile navigation event listeners."); }

            // --- Initialize Lucide Icons ---
            if (typeof lucide !== 'undefined') {
                try { lucide.createIcons(); } catch (e) { console.error("Lucide icons initialization failed:", e); }
            } else { console.error("Lucide library not loaded."); }

            // --- Dashboard Specific JS: Update Status Bar ---
            const statusBarInner = document.querySelector('.status-bar-inner');
            const statusBarPercentageText = document.querySelector('.status-bar-percentage');
            if (statusBarInner && statusBarPercentageText) {
                const percentage = parseInt(statusBarInner.getAttribute('data-percentage'), 10) || 0;
                requestAnimationFrame(() => {
                    statusBarInner.style.width = percentage + '%';
                    statusBarPercentageText.textContent = percentage + '%';
                    if (percentage === 100) { statusBarInner.style.borderRadius = '11px'; statusBarInner.style.background = 'linear-gradient(90deg, #8300fe, #a855f7)'; }
                    else if (percentage === 0) { statusBarInner.style.borderRadius = '11px 0 0 11px'; statusBarInner.style.background = 'none'; }
                    else { statusBarInner.style.borderRadius = '11px 0 0 11px'; statusBarInner.style.background = 'linear-gradient(90deg, #8300fe, #a855f7)'; }
                });
            } else { console.warn("Status bar elements not found."); }


            // --- NEW: Load More Functionality ---
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const violationsGrid = document.getElementById('violationsGrid');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const loadError = document.getElementById('loadError');
            const loadMoreContainer = document.getElementById('loadMoreContainer'); // Container for button and indicators

            // Initial offset starts after the first batch loaded by PHP
            let currentOffset = <?php echo count($detections); ?>;
            const itemsPerLoad = <?php echo $limit; ?>; // Use the same limit as PHP

            // Simple HTML escaping function (important for security)
            const escapeHtml = (unsafe) => {
                if (typeof unsafe !== 'string') return '';
                return unsafe
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }

            // Function to create a violation card HTML string from JSON data
            const createViolationCard = (detection) => {
                // Default values and parsing
                const timestamp = detection.timestamp ? new Date(detection.timestamp) : new Date(); // Handle potential null timestamp
                const date = timestamp.toLocaleDateString('en-CA'); // YYYY-MM-DD format
                const time = timestamp.toLocaleTimeString('en-GB'); // HH:MM:SS format

                let status = (detection.status || 'pending').toLowerCase();
                let statusText = status.charAt(0).toUpperCase() + status.slice(1);
                let statusColor = '#ffb74d'; // Default: Pending (Orange)
                if (status === 'approved') { statusColor = '#4db6ac'; } // Teal
                else if (status === 'rejected') { statusColor = '#ef5350'; } // Red

                const helmetStatus = detection.helmet_status ? (detection.helmet_status.charAt(0).toUpperCase() + detection.helmet_status.slice(1)) : 'Unknown Type';

                // Use image_base64 which was prepared in PHP for AJAX JSON response
                const imageSrc = detection.image_base64
                    ? `data:image/jpeg;base64,${detection.image_base64}`
                    : 'https://placehold.co/400x220/111827/666666?text=No+Image+Available';
                const imageAlt = `Detection Image (Timestamp: ${escapeHtml(detection.timestamp || 'N/A')})`;
                const imageErrorScript = `this.style.backgroundColor='#333'; this.alt='Image load error'; this.src='https://placehold.co/400x220/333333/cccccc?text=Error+Loading';`;

                // Return the HTML structure for a single card
                // Added data-aos="fade-up" to animate newly loaded cards
                return `
                    <div class="violation-card" data-aos="fade-up">
                        <img src="${imageSrc}"
                             alt="${escapeHtml(imageAlt)}"
                             onerror="${imageErrorScript}"
                             style="${!detection.image_base64 ? 'background-color: #222;' : ''}">
                        <div class="violation-details">
                            <h4>Violation: ${escapeHtml(helmetStatus)}</h4>
                            <p><strong>Date:</strong> ${escapeHtml(date)}</p>
                            <p><strong>Time:</strong> ${escapeHtml(time)}</p>
                            <p><strong>Status:</strong> <span style="color: ${statusColor};">${escapeHtml(statusText)}</span></p>
                        </div>
                    </div>
                `;
            };

            // Attach event listener ONLY if the button exists on the page
            if (loadMoreBtn && violationsGrid && loadingIndicator && loadError && loadMoreContainer) {
                loadMoreBtn.addEventListener('click', async () => {
                    // --- UI Updates: Show Loading State ---
                    loadMoreBtn.style.display = 'none'; // Hide button
                    loadError.style.display = 'none';   // Hide previous error
                    loadingIndicator.style.display = 'block'; // Show loading text

                    try {
                        // --- Fetch Data ---
                        // Construct the URL to fetch the next batch
                        // It calls the *same* PHP page but adds query parameters
                        const url = `?offset=${currentOffset}&ajax=true&limit=${itemsPerLoad}`; // Use current file path
                        const response = await fetch(url);

                        if (!response.ok) {
                            // Handle HTTP errors (like 404, 500)
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }

                        const data = await response.json(); // Parse the JSON response from PHP

                        // --- Process Response ---
                        if (data.detections && data.detections.length > 0) {
                            // Create a document fragment to batch DOM updates (more efficient)
                            const fragment = document.createDocumentFragment();
                            data.detections.forEach(detection => {
                                const cardHtml = createViolationCard(detection);
                                // Create a temporary element to safely parse the HTML string
                                const tempDiv = document.createElement('div');
                                tempDiv.innerHTML = cardHtml.trim();
                                // Append the actual card element (the first child of the temp div)
                                if (tempDiv.firstChild) {
                                    fragment.appendChild(tempDiv.firstChild);
                                }
                            });
                            // Append all new cards to the grid at once
                            violationsGrid.appendChild(fragment);

                            // Update the offset for the *next* request
                            currentOffset += data.detections.length;

                            // --- Post-Load Actions ---
                            // Re-initialize Lucide icons if any were added in the new cards (unlikely here, but good practice)
                            if (typeof lucide !== 'undefined') {
                                lucide.createIcons();
                            }
                            // Refresh AOS to detect and animate the newly added elements
                            if (typeof AOS !== 'undefined') {
                                AOS.refreshHard(); // Use refreshHard for dynamically added content
                            }
                        }

                        // --- Update UI: Handle "No More Items" or Reset Button ---
                        if (!data.has_more) {
                            // If the server indicates no more items, hide the entire container
                            loadMoreContainer.style.display = 'none';
                        } else {
                            // If there are potentially more items, show the button again
                            loadMoreBtn.style.display = 'inline-flex';
                        }

                    } catch (error) {
                        // --- Handle Errors ---
                        console.error('Error loading more detections:', error);
                        loadError.textContent = `Error: ${error.message || 'Could not load items.'}`; // Show specific error if possible
                        loadError.style.display = 'block'; // Show error message
                        loadMoreBtn.style.display = 'inline-flex'; // Show button again so user can retry
                    } finally {
                        // --- UI Cleanup: Hide Loading Indicator ---
                        loadingIndicator.style.display = 'none'; // Always hide loading text
                    }
                }); // End button click listener

            } else {
                // This is normal if there were fewer than 'limit' items initially, or 0 items.
                // console.log("Load more button or related elements not found, skipping load more setup.");
            }

        }); // End DOMContentLoaded
    </script>

</body>

</html>