<?php
// Start session *before* any output
session_start();
// Include database configuration (Ensure this file exists and sets up $conn)
require_once 'config.php';

// --- Authorization Check ---
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// --- Handle Approve/Reject Actions (BEFORE any other output/logic) ---
if (isset($_GET['action'], $_GET['id']) && !isset($_GET['ajax'])) { // Ensure this doesn't run for AJAX requests
    $id = intval($_GET['id']);
    $action = $_GET['action'];
    $status = '';

    if ($action === 'approve') {
        $status = 'approved';
    } elseif ($action === 'reject') {
        $status = 'rejected';
    }

    if (!empty($status) && $id > 0) {
        $stmt = $conn->prepare("UPDATE detections SET status=? WHERE id=?");
        if ($stmt) {
            $stmt->bind_param("si", $status, $id);
            $stmt->execute();
            $stmt->close();
            // Redirect to the same page to show updated status and prevent resubmission
            // Preserve filter if it was set (optional, more complex)
            header("Location: admin.php");
            exit();
        } else {
            error_log("Error preparing update statement: " . $conn->error);
            // Optionally show an error message before redirecting or exiting
            $_SESSION['error_message'] = "Failed to update status for ID: " . $id; // Store error in session
            header("Location: admin.php");
            exit();
        }
    } else {
         // Invalid action or ID, redirect back
         header("Location: admin.php");
         exit();
    }
}

// --- Configuration for Pagination ---
$limit = 8; // Number of items per page/request
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$is_ajax = isset($_GET['ajax']) && $_GET['ajax'] === 'true';

// --- Initialization ---
$detections = []; // For fetched items
$total_detections_count = 0; // Total count for pagination logic
$stats = ['total' => 0, 'pending' => 0, 'approved' => 0, 'rejected' => 0]; // For header stats

// --- Fetch Total Count (Needed for pagination) ---
$countResult = $conn->query("SELECT COUNT(*) as total FROM detections");
if ($countResult) {
    $total_detections_count = $countResult->fetch_assoc()['total'] ?? 0;
    $countResult->free();
} else {
    error_log("Error fetching total count: " . $conn->error);
    // Handle error, maybe set total count to 0 or show an error message
}


// --- Fetch Paginated Data for Display ---
// Join with users table to get the name
$sql = "SELECT d.id, d.user_id, d.timestamp, d.status, d.image, u.name
        FROM detections d
        JOIN users u ON d.user_id = u.id
        ORDER BY d.timestamp DESC
        LIMIT ? OFFSET ?";

$stmt_detections = $conn->prepare($sql);
if ($stmt_detections) {
    $stmt_detections->bind_param("ii", $limit, $offset);
    $stmt_detections->execute();
    $result_detections = $stmt_detections->get_result();

    while ($row = $result_detections->fetch_assoc()) {
        // Prepare image data *only* for AJAX requests
        if ($is_ajax && !empty($row['image'])) {
            $row['image_base64'] = base64_encode($row['image']);
            unset($row['image']); // Remove raw blob for JSON
        }
        $detections[] = $row;
    }
    $stmt_detections->close();
} else {
    error_log("Error preparing paginated detections statement: " . $conn->error);
    // Handle error appropriately
    if ($is_ajax) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch detections.']);
        exit;
    } else {
        // Show error on the page for initial load
        die("Error loading detection data. Please try again later.");
    }
}

// --- Calculate Overall Stats (Only for initial page load) ---
if (!$is_ajax) {
    $statsResult = $conn->query("SELECT status, COUNT(*) as count FROM detections GROUP BY status");
    if ($statsResult) {
        $current_total = 0; // Recalculate total from groups for accuracy
        while ($statRow = $statsResult->fetch_assoc()) {
            $status_key = strtolower($statRow['status'] ?? 'pending'); // Ensure lowercase and handle null
            if (array_key_exists($status_key, $stats)) {
                $stats[$status_key] = (int)$statRow['count'];
            } else {
                 // If an unexpected status exists, count it as pending or log it
                 $stats['pending'] += (int)$statRow['count'];
                 error_log("Unexpected status found in stats query: " . $statRow['status']);
            }
            $current_total += (int)$statRow['count'];
        }
        $stats['total'] = $current_total; // Assign the accurate total calculated from groups
        $statsResult->free();
    } else {
        error_log("Error fetching stats: " . $conn->error);
        // Stats will remain 0, might want to show an error
    }
}


// --- Output ---
if ($is_ajax) {
    // Return JSON for AJAX requests
    header('Content-Type: application/json');
    echo json_encode([
        'detections' => $detections,
        'has_more' => ($offset + count($detections)) < $total_detections_count
    ]);

    // Close DB connection for AJAX
    if (isset($conn) && (is_object($conn) || is_resource($conn)) && method_exists($conn, 'close')) {
        $conn->close();
    }
    exit; // Stop script execution after sending JSON
}

// --- Close DB connection for standard page load before rendering HTML ---
if (isset($conn) && (is_object($conn) || is_resource($conn)) && method_exists($conn, 'close')) {
    $conn->close();
}

// --- Display Session Error Message (if any from action handling) ---
$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Clear the message after displaying
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Civic Eye | Admin Review</title> <link rel="shortcut icon" href="IMAGES/ppg.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.396.0/dist/umd/lucide.min.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>

    <link rel="stylesheet" href="admin.css">

</head>

<body>
    <nav class="navbar">
        <a href="index.php" class="navbar-logo"> <img src="IMAGES/logo1.png"
                onerror="this.onerror=null; this.src='https://placehold.co/150x40/0a0a0a/ffffff?text=Civic+Eye';"
                alt="Civic Eye Logo">
        </a>
        <div class="navbar-links"></div> <button class="hamburger-menu" aria-label="Open navigation menu" aria-expanded="false"
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
            <a href="logout.php" class="logout-btn-link">
                <button class="logout-btn">LOGOUT</button>
            </a>
        <?php endif; ?>
    </div>

    <div id="particles-js"></div>

    <main>
        <div class="admin-container">
            <header class="admin-header" data-aos="fade-down">
                <h1>Violation Review Panel</h1>
                <p>Review pending violations and approve or reject them.</p>
            </header>

             <?php if (!empty($error_message)): ?>
                <div class="session-error-message" data-aos="fade-down" data-aos-delay="50">
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>


            <section class="stats-section" data-aos="fade-up">
                <div class="stats-numbers">
                    <div class="stat-item total" data-stat="total">
                        <span class="stat-value"><?= $stats['total'] ?></span>
                        <span class="stat-label">Total Detections</span>
                    </div>
                    <div class="stat-item pending" data-stat="pending">
                        <span class="stat-value"><?= $stats['pending'] ?></span>
                        <span class="stat-label">Pending Review</span>
                    </div>
                    <div class="stat-item approved" data-stat="approved">
                        <span class="stat-value"><?= $stats['approved'] ?></span>
                        <span class="stat-label">Approved Violations</span>
                    </div>
                    <div class="stat-item rejected" data-stat="rejected">
                        <span class="stat-value"><?= $stats['rejected'] ?></span>
                        <span class="stat-label">Rejected / False</span>
                    </div>
                </div>
            </section>

            <section class="filter-section" data-aos="fade-up" data-aos-delay="100">
                <h3>Filter Violations</h3>
                <div class="filter-buttons">
                    <button data-filter="all" class="active">Show All</button>
                    <button data-filter="pending">Pending</button>
                    <button data-filter="approved">Approved</button>
                    <button data-filter="rejected">Rejected</button>
                </div>
            </section>

            <div class="violations-grid" id="violationsGrid" data-aos="fade-up" data-aos-delay="200">
                <?php if (!empty($detections)): ?>
                    <?php foreach ($detections as $row): ?>
                        <?php
                        // Prepare data for the card (same logic as before)
                        $status_class = htmlspecialchars(strtolower($row['status'] ?? 'pending'));
                        $status_text = ucfirst($status_class);
                        $is_pending = ($status_class === 'pending');
                        // Use raw image blob for initial load
                        $image_src = (!empty($row['image'])) ? 'data:image/jpeg;base64,' . base64_encode($row['image']) : 'https://placehold.co/400x220/333333/cccccc?text=No+Image';
                        $image_alt = "Detection ID: " . $row['id'] . " by " . htmlspecialchars($row['name'] ?? 'Unknown User');
                        // Format timestamp safely
                        try {
                            $timestamp_obj = new DateTime($row['timestamp'] ?? 'now'); // Default to now if null
                            $date_formatted = $timestamp_obj->format('Y-m-d');
                            $time_formatted = $timestamp_obj->format('H:i:s');
                        } catch (Exception $e) {
                            $date_formatted = 'Invalid Date'; $time_formatted = 'Invalid Time';
                            error_log("Error parsing timestamp for detection ID " . $row['id'] . ": " . $e->getMessage());
                        }
                        ?>
                        <div class="violation-card" data-status="<?= $status_class ?>" data-id="<?= $row['id'] ?>">
                            <img class="violation-image" src="<?= $image_src ?>" alt="<?= $image_alt ?>"
                                onerror="this.onerror=null; this.src='https://placehold.co/400x220/333333/cccccc?text=Error'; this.alt='Image load error';">
                            <div class="violation-details">
                                <h4>Violation: No Helmet</h4> <p><strong>User:</strong> <?= htmlspecialchars($row['name'] ?? 'Unknown User') ?></p>
                                <p><strong>Date:</strong> <?= $date_formatted ?></p>
                                <p><strong>Time:</strong> <?= $time_formatted ?></p>
                                <p><strong>Status:</strong> <span
                                        class="violation-status status-<?= $status_class ?>"><?= $status_text ?></span></p>
                            </div>
                            <div class="violation-actions">
                                <a href="admin.php?action=approve&id=<?= $row['id'] ?>"
                                    class="btn-base btn-approve <?= !$is_pending ? 'disabled' : '' ?>"
                                    aria-label="Approve detection <?= $row['id'] ?>">
                                    <i data-lucide="check-circle"></i> Approve
                                </a>
                                <a href="admin.php?action=reject&id=<?= $row['id'] ?>"
                                    class="btn-base btn-reject <?= !$is_pending ? 'disabled' : '' ?>"
                                    aria-label="Reject detection <?= $row['id'] ?>">
                                    <i data-lucide="x-circle"></i> Reject
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php elseif ($total_detections_count === 0): ?>
                     <p style="grid-column: 1 / -1; text-align: center; color: #aaa;">No detections found in the system.</p>
                <?php endif; ?>
                 <?php // Note: If total > 0 but initial fetch is empty (e.g., offset too high), no message is shown here, handled by JS potentially ?>
            </div>

            <div id="loadMoreContainer" data-aos="fade-up">
                 <?php
                 // Show button container initially only if the total count is greater than the number initially loaded
                 if ($total_detections_count > count($detections)):
                 ?>
                    <button id="loadMoreBtn" class="btn-base">
                        <i data-lucide="rotate-cw"></i>
                        <span>Load More</span>
                    </button>
                    <p id="loadingIndicator" style="display: none;">Loading...</p>
                    <p id="loadError" style="display: none;">Could not load more items.</p>
                 <?php endif; ?>
                 <?php // If total detections is 0 or less than limit, this container won't render. ?>
            </div>

        </div> </main>

    <footer>
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-logo"><img src="IMAGES/logo1.png" alt="Civic Eye Logo"
                        onerror="this.onerror=null; this.src='https://placehold.co/150x35/030305/ffffff?text=Civic+Eye';" />
                </div>
                <div class="footer-description">Civic Eye: AI-powered traffic violation monitoring using existing CCTV,
                    prioritizing local processing and privacy.</div>
                <div class="footer-social">
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook Profile"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                        </svg></a>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram Profile"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919A11.97 11.97 0 0 1 7.151 2.23 11.9 11.9 0 0 1 12 2.163zm0 1.802c-3.115 0-3.486.01-4.706.066-2.666.122-3.989 1.45-4.11 4.11-.057 1.22-.066 1.59-.066 4.697s.01 3.476.066 4.696c.12 2.662 1.443 3.99 4.11 4.11 1.22.056 1.59.066 4.705.066 3.117 0 3.487-.01 4.706-.066 2.664-.12 3.99-1.448 4.11-4.11.056-1.22.066-1.59.066-4.696 0-3.108-.01-3.477-.066-4.697-.12-2.66-1.446-3.988-4.11-4.11A12.015 12.015 0 0 0 16.706 4.03 11.89 11.89 0 0 0 12 3.965zm0 2.972a5.063 5.063 0 1 0 0 10.125 5.063 5.063 0 0 0 0-10.125zm0 1.802a3.26 3.26 0 1 1 0 6.52 3.26 3.26 0 0 1 0-6.52zm4.938-3.71a1.2 1.2 0 1 0 0 2.4 1.2 1.2 0 0 0 0-2.4z" />
                        </svg></a>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Profile"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14zm-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-3.18v8.37h3.18v-4.75a1.92 1.92 0 0 1 1.92-1.92c.99 0 1.92.77 1.92 1.92v4.75h3.18zM6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68zm1.39 9.94v-8.37H5.5v8.37h2.77z" />
                        </svg></a>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="YouTube Profile"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M10 15l5.19-3L10 9v6m11.56-7.83c.13.47.22 1.1.28 1.9c.07.8.1 1.49.1 2.09L22 12c0 2.19-.16 3.8-.44 5.83c-.25 1.84-.9 3.08-1.81 3.79c-.97.73-2.36 1.09-4.1 1.09c-1.96 0-3.8-.21-5.4-.61c-1.6-.4-2.94-.93-3.98-1.54c-.98-.58-1.7-1.34-2.14-2.23C2.2 16.74 2 15.24 2 13.3V11c0-1.94.16-3.44.43-4.67c.27-1.23.78-2.2 1.52-2.87c.74-.67 1.7-1.14 2.82-1.4c1.13-.27 2.5-.4 4.06-.4h.1c.6 0 1.17.02 1.7.05c.53.03 1.03.08 1.49.14c.9.12 1.63.36 2.17.73c.54.36.95.84 1.2 1.41c.25.57.4 1.26.46 2.06Z" />
                        </svg></a>
                </div>
            </div>
            <div class="footer-links-section">
                <div class="footer-links-column">
                    <h3>Quick Links</h3>
                    <nav><a href="index.php">Home</a><a href="download.php">Download</a><a href="team.php">Team</a><a href="contact-us.php">Contact Us</a>
                    </nav>
                </div>
                <div class="footer-links-column">
                    <h3>Resources</h3>
                    <nav><a href="index.php#features">Features</a><a href="download.php#requirements">Requirements</a><a href="#">Documentation</a></nav>
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
                <div>&copy; <?php echo date("Y"); ?> Civic Eye. All rights reserved.</div>
                <div class="footer-bottom-links"><a href="#">Privacy</a><a href="#">Terms</a><a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <div id="imageModal" class="modal">
        <span class="close-modal" aria-label="Close image preview">&times;</span>
        <img class="modal-content" id="modalImage" alt="Zoomed Violation Image">
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // --- Initialize Libraries (Particles, AOS, Lucide) ---
            if (typeof particlesJS !== 'undefined') { particlesJS("particles-js", { /* config */ "particles": { "number": { "value": 60, "density": { "enable": true, "value_area": 800 } }, "color": { "value": ["#8300fe", "#a855f7", "#38bdf8", "#555"] }, "shape": { "type": "circle" }, "opacity": { "value": 0.5, "random": true, "anim": { "enable": true, "speed": 0.8, "opacity_min": 0.1, "sync": false } }, "size": { "value": 2.8, "random": true, "anim": { "enable": false } }, "line_linked": { "enable": true, "distance": 140, "color": "#444", "opacity": 0.35, "width": 1 }, "move": { "enable": true, "speed": 1.6, "direction": "none", "random": true, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": true, "rotateX": 700, "rotateY": 1300 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "grab" }, "onclick": { "enable": true, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 150, "line_linked": { "opacity": 0.6 } }, "push": { "particles_nb": 3 } } }, "retina_detect": true }); } else { console.error("particles.js library not loaded."); }
            if (typeof AOS !== 'undefined') { AOS.init({ duration: 900, once: false, offset: 80, easing: 'ease-out-quart' }); } else { console.error("AOS library not loaded."); }
            if (typeof lucide !== 'undefined') { try { lucide.createIcons(); } catch (e) { console.error("Lucide icons initialization failed:", e); } } else { console.error("Lucide library not loaded."); }

            // --- Mobile Navigation Logic ---
            const hamburgerBtn = document.querySelector('.hamburger-menu');
            const mobileNav = document.querySelector('.mobile-nav-menu');
            const closeNavBtn = document.querySelector('.close-menu-btn');
            const body = document.body;
            const toggleNav = (event) => { if (event) event.stopPropagation(); if (mobileNav && body && hamburgerBtn) { const isActive = mobileNav.classList.toggle('active'); body.classList.toggle('modal-open', isActive || (document.getElementById('imageModal')?.style.display === 'block')); hamburgerBtn.setAttribute('aria-expanded', isActive); mobileNav.setAttribute('aria-hidden', !isActive); } };
            const closeNav = () => { if (mobileNav && mobileNav.classList.contains('active') && body && hamburgerBtn) { mobileNav.classList.remove('active'); if (document.getElementById('imageModal')?.style.display !== 'block') { body.classList.remove('modal-open'); } hamburgerBtn.setAttribute('aria-expanded', 'false'); mobileNav.setAttribute('aria-hidden', 'true'); } };
            if (hamburgerBtn && mobileNav && closeNavBtn) { hamburgerBtn.addEventListener('click', toggleNav); closeNavBtn.addEventListener('click', closeNav); mobileNav.querySelectorAll('a').forEach(link => { link.addEventListener('click', () => setTimeout(closeNav, 150)); }); document.addEventListener('click', (event) => { if (mobileNav.classList.contains('active') && !mobileNav.contains(event.target) && !hamburgerBtn.contains(event.target)) { closeNav(); } }); mobileNav.addEventListener('click', (event) => { event.stopPropagation(); }); document.addEventListener('keydown', (event) => { if (event.key === 'Escape' && mobileNav.classList.contains('active')) { closeNav(); } }); } else { console.error("Could not attach mobile navigation event listeners."); }


            // --- Image Modal Logic ---
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("modalImage");
            const closeModalBtn = document.querySelector(".close-modal");
            const violationsGrid = document.getElementById('violationsGrid');

            const openImageModal = (imgElement) => { if (modal && modalImg && imgElement) { modal.style.display = "block"; modalImg.src = imgElement.src; modalImg.alt = imgElement.alt; body.classList.add('modal-open'); } };
            const closeImageModal = () => { if (modal) { modal.style.display = "none"; if (!mobileNav || !mobileNav.classList.contains('active')) { body.classList.remove('modal-open'); } } };

            if (violationsGrid) { violationsGrid.addEventListener('click', (event) => { if (event.target.tagName === 'IMG' && event.target.classList.contains('violation-image')) { openImageModal(event.target); } }); } else { console.error("Violations grid not found for image click listener."); }
            if (closeModalBtn) { closeModalBtn.addEventListener('click', closeImageModal); }
            if (modal) { modal.addEventListener('click', (event) => { if (event.target === modal) { closeImageModal(); } }); }
            document.addEventListener('keydown', (event) => { if (event.key === 'Escape' && modal && modal.style.display === "block") { closeImageModal(); } });


            // --- Filtering Logic ---
            const filterButtonsContainer = document.querySelector('.filter-buttons');
            let currentFilter = 'all'; // Keep track of the active filter

            const applyFilter = () => {
                if (!violationsGrid) return;
                const allCards = violationsGrid.querySelectorAll('.violation-card');
                let hasVisibleItems = false;

                allCards.forEach(card => {
                    const cardStatus = card.dataset.status;
                    const shouldShow = (currentFilter === 'all' || cardStatus === currentFilter);
                    // Use classList.toggle for cleaner show/hide based on filter
                    card.classList.toggle('hidden', !shouldShow);
                    if (shouldShow) hasVisibleItems = true;
                });

                 // Optionally show a message if no items match the filter
                 const noMatchMessage = document.getElementById('noMatchMessage');
                 if (!hasVisibleItems && allCards.length > 0) {
                     if (!noMatchMessage) {
                         const p = document.createElement('p');
                         p.id = 'noMatchMessage';
                         p.textContent = `No violations found matching the "${currentFilter}" filter.`;
                         p.style.gridColumn = '1 / -1';
                         p.style.textAlign = 'center';
                         p.style.color = '#aaa';
                         p.style.marginTop = '1rem';
                         violationsGrid.appendChild(p);
                     } else {
                         noMatchMessage.style.display = 'block';
                         noMatchMessage.textContent = `No violations found matching the "${currentFilter}" filter.`;
                     }
                 } else if (noMatchMessage) {
                     noMatchMessage.style.display = 'none'; // Hide if items are visible
                 }


                // Refresh AOS after filtering
                if (typeof AOS !== 'undefined') { AOS.refresh(); }
            };

            const handleFilterClick = (event) => {
                const filterButton = event.target.closest('button[data-filter]');
                if (!filterButton) return;

                currentFilter = filterButton.dataset.filter; // Update the current filter

                // Update active button style
                if (filterButtonsContainer) {
                    filterButtonsContainer.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
                    filterButton.classList.add('active');
                }
                applyFilter(); // Apply the filter to the grid
            };

            if (filterButtonsContainer) {
                filterButtonsContainer.addEventListener('click', handleFilterClick);
            } else { console.error("Filter buttons container not found."); }


            // --- NEW: Load More Functionality ---
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const loadError = document.getElementById('loadError');
            const loadMoreContainer = document.getElementById('loadMoreContainer');

            // Initial offset starts after the first batch loaded by PHP
            let currentOffset = <?php echo count($detections); ?>;
            const itemsPerLoad = <?php echo $limit; ?>;

            // Simple HTML escaping function
            const escapeHtml = (unsafe) => {
                if (typeof unsafe !== 'string') return String(unsafe); // Convert non-strings
                return unsafe
                     .replace(/&/g, "&amp;")
                     .replace(/</g, "&lt;")
                     .replace(/>/g, "&gt;")
                     .replace(/"/g, "&quot;")
                     .replace(/'/g, "&#039;");
            }

            // Function to create an admin violation card HTML string from JSON data
            const createAdminViolationCard = (detection) => {
                // Default values and parsing
                const detectionId = escapeHtml(detection.id || 'N/A');
                const timestamp = detection.timestamp ? new Date(detection.timestamp) : new Date();
                const date = timestamp.toLocaleDateString('en-CA'); // YYYY-MM-DD
                const time = timestamp.toLocaleTimeString('en-GB'); // HH:MM:SS

                let status = (detection.status || 'pending').toLowerCase();
                let statusText = status.charAt(0).toUpperCase() + status.slice(1);
                let isPending = (status === 'pending');

                const userName = escapeHtml(detection.name || 'Unknown User');
                const violationType = 'No Helmet'; // Assuming fixed type for now

                // Use image_base64 from AJAX JSON response
                const imageSrc = detection.image_base64
                    ? `data:image/jpeg;base64,${detection.image_base64}`
                    : 'https://placehold.co/400x220/333333/cccccc?text=No+Image';
                const imageAlt = `Detection ID: ${detectionId} by ${userName}`;
                const imageErrorScript = `this.onerror=null; this.src='https://placehold.co/400x220/333333/cccccc?text=Error'; this.alt='Image load error';`;

                // Determine if the card should be hidden based on the current filter
                const isHidden = (currentFilter !== 'all' && status !== currentFilter);

                // Return the HTML structure for a single card
                return `
                    <div class="violation-card ${isHidden ? 'hidden' : ''}" data-status="${escapeHtml(status)}" data-id="${detectionId}" data-aos="fade-up">
                        <img class="violation-image" src="${imageSrc}"
                             alt="${escapeHtml(imageAlt)}"
                             onerror="${imageErrorScript}">
                        <div class="violation-details">
                            <h4>Violation: ${escapeHtml(violationType)}</h4>
                            <p><strong>User:</strong> ${userName}</p>
                            <p><strong>Date:</strong> ${escapeHtml(date)}</p>
                            <p><strong>Time:</strong> ${escapeHtml(time)}</p>
                            <p><strong>Status:</strong> <span class="violation-status status-${escapeHtml(status)}">${escapeHtml(statusText)}</span></p>
                        </div>
                        <div class="violation-actions">
                            <a href="admin.php?action=approve&id=${detectionId}"
                                class="btn-base btn-approve ${!isPending ? 'disabled' : ''}"
                                aria-label="Approve detection ${detectionId}">
                                <i data-lucide="check-circle"></i> Approve
                            </a>
                            <a href="admin.php?action=reject&id=${detectionId}"
                                class="btn-base btn-reject ${!isPending ? 'disabled' : ''}"
                                aria-label="Reject detection ${detectionId}">
                                <i data-lucide="x-circle"></i> Reject
                            </a>
                        </div>
                    </div>
                `;
            };

            // Attach event listener ONLY if the button exists
            if (loadMoreBtn && violationsGrid && loadingIndicator && loadError && loadMoreContainer) {
                loadMoreBtn.addEventListener('click', async () => {
                    // --- UI Updates: Show Loading State ---
                    loadMoreBtn.style.display = 'none';
                    loadError.style.display = 'none';
                    loadingIndicator.style.display = 'block';

                    try {
                        // --- Fetch Data ---
                        const url = `?offset=${currentOffset}&ajax=true&limit=${itemsPerLoad}`; // Use current file path
                        const response = await fetch(url);

                        if (!response.ok) { throw new Error(`HTTP error! Status: ${response.status}`); }

                        const data = await response.json();

                        // --- Process Response ---
                        if (data.detections && data.detections.length > 0) {
                            const fragment = document.createDocumentFragment();
                            data.detections.forEach(detection => {
                                const cardHtml = createAdminViolationCard(detection);
                                const tempDiv = document.createElement('div');
                                tempDiv.innerHTML = cardHtml.trim();
                                if (tempDiv.firstChild) {
                                    fragment.appendChild(tempDiv.firstChild);
                                }
                            });
                            violationsGrid.appendChild(fragment);

                            // Update offset for the *next* request
                            currentOffset += data.detections.length;

                            // --- Post-Load Actions ---
                            // Re-initialize Lucide icons for new buttons
                            if (typeof lucide !== 'undefined') { lucide.createIcons(); }
                            // Refresh AOS for new cards
                            if (typeof AOS !== 'undefined') { AOS.refreshHard(); }
                            // Re-apply filter in case some new items should be hidden
                            // applyFilter(); // Apply filter to potentially hide new items immediately
                        }

                         // --- Update UI: Handle "No More Items" or Reset Button ---
                        if (!data.has_more) {
                            loadMoreContainer.style.display = 'none'; // Hide container if no more items
                        } else {
                            loadMoreBtn.style.display = 'inline-flex'; // Show button again
                        }

                    } catch (error) {
                        // --- Handle Errors ---
                        console.error('Error loading more detections:', error);
                        loadError.textContent = `Error: ${error.message || 'Could not load items.'}`;
                        loadError.style.display = 'block';
                        loadMoreBtn.style.display = 'inline-flex'; // Show button again to retry
                    } finally {
                        // --- UI Cleanup: Hide Loading Indicator ---
                        loadingIndicator.style.display = 'none';
                    }
                }); // End button click listener

            } else {
                 // This is normal if there were fewer than 'limit' items initially, or 0 items.
                 // console.log("Load more button or related elements not found, skipping load more setup.");
            }

            // --- Disable Link Clicks for Disabled Buttons (Event Delegation) ---
            // This listener handles both initially loaded and dynamically loaded buttons
            if (violationsGrid) {
                violationsGrid.addEventListener('click', (event) => {
                    // Check if the click target or its parent is a disabled link within violation-actions
                    const link = event.target.closest('.violation-actions a.disabled');
                    if (link) {
                        event.preventDefault(); // Prevent navigation if the link is disabled
                        console.log('Prevented click on disabled action link.'); // Optional debug log
                    }
                });
            }


        }); // End DOMContentLoaded
    </script>

</body>
</html>