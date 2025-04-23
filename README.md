# Civic Eye Website [Server Files]

This repository contains the source code for the official informational website for **Civic Eye**, an AI-powered traffic violation detection software. The website serves as a central hub for users to learn about the Civic Eye application, download the software, meet the team, find contact information, and register/login.

The website is built using standard web technologies (PHP, HTML, CSS, JavaScript) and features a dark, modern aesthetic consistent with the Civic Eye brand identity.

---

## ✨ Website Features

- **Multi-Page Structure:**  
  Includes dedicated pages for Home, Download, Team, Contact Us, and Login/Registration.

- **Responsive Design:**  
  Adapts layout for optimal viewing on desktops, tablets, and mobiles using CSS media queries.

- **Animated Background:**  
  Utilizes `Particles.js` for dynamic visual effects.

- **Themed Styling:**  
  Dark theme with purple and orange accents, typography using Orbitron, Roboto Mono, and IBM Plex Sans. Glassmorphism-inspired UI elements.

- **Interactive Elements:**  
  - Scroll animations via AOS  
  - Mobile navigation  
  - Hover/active state buttons  
  - Form handling with PHP

- **Informational Content:**  
  Includes Civic Eye features, system requirements, installation guides (Windows & Linux), technical overview, and future roadmap.

---

## 📄 Pages

- **Home (`index.php`)**  
  Landing page with app intro, objectives, features, workflow, and CTAs.

- **Download (`download.php`)**  
  Detailed instructions, system requirements, technical info, and links to GitHub Releases.

- **Team (`team.php`)**  
  Meet the development team with roles, bios, repositories, and social links.

- **Contact Us (`contact-us.php`)**  
  Contact details and a form that redirects messages as GitHub issues.

- **Login/Register (`login.php`)**  
  Animated switching interface for user login/registration with backend session handling.

---

## 🛠️ Tech Stack

- **PHP:** Server-side scripting for sessions, form handling, and conditional rendering.  
- **HTML5:** Structure and semantic content.  
- **CSS3:** Styling, responsive layouts, Flexbox/Grid, animations, dark mode.  
- **JavaScript (ES6+):**  
  - DOM manipulation  
  - Event handling  
  - Library initialization  
  - Clipboard API

- **Libraries Used:**  
  - `Particles.js`: Background particle effects  
  - `AOS`: Animate on scroll  
  - `Lucide Icons`: SVG icon set via JavaScript

---

## 🚀 Running Locally

### Prerequisites
You need a local web server with PHP support (e.g., XAMPP, MAMP, WAMP, Laragon, or PHP's built-in server).

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/SHADOW2669/CivicEye-Website-Server.git
   ```

2. **Navigate to the directory**
   ```bash
   cd CivicEye-Website-Server
   ```

3. **Place in your server directory**  
   Move or copy the folder into your server’s document root:
   - XAMPP/MAMP: `htdocs`
   - WAMP: `www`

4. **Start your server**  
   Ensure Apache/Nginx and PHP are running.

5. **Access via browser**  
   Navigate to:
   ```
   http://localhost/CivicEye-Website-Server/
   ```
   Or specific pages like:
   ```
   http://localhost/CivicEye-Website-Server/login.php
   http://localhost/CivicEye-Website-Server/download.php
   ```

> ⚠️ Note: Do not open `.php` files directly in the browser file system (e.g., `file://`), as PHP needs a server to execute.

---

## 🤝 Contributing 

Contributions are welcome! If you find issues or have suggestions for improvements, feel free to open an issue or submit a pull request on [GitHub](https://github.com/SHADOW2669/CivicEye-Website-Server).

---

## 📜 License 

This project is licensed under the MIT License. See the [LICENSE.md](https://github.com/SHADOW2669/CivicEye-Website-Server/blob/main/LICENSE) file for details.

---