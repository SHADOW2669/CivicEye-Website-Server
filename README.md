# Civic Eye Website - Server Edition

The **Civic Eye Website** is the official frontend for **Civic Eye**, an AI-powered helmet violation detection system. This server-side edition offers authentication, app downloads, team bios, contact features, and detection result storage — all connected to a backend powered by PHP and MySQL.


## Table of Contents

1. [Introduction](#introduction)
2. [Features](#features)
3. [Technologies Used](#technologies-used)
4. [Installation](#installation)
5. [Configuration](#configuration)
6. [Database Setup](#database-setup)
7. [How Login System Works](#how-login-system-works)
8. [Insert Admin to Database](#insert-admin-to-database)
9. [API Endpoints](#api-endpoints)
10. [User Dashboard](#user-dashboard)
11. [Admin Panel](#admin-panel)
12. [Usage](#usage)
13. [Session Handling](#session-handling)
14. [Contributing](#contributing)
15. [License](#license)
16. [Notes](#notes)

## Introduction

The **Civic Eye Web Interface** acts as the central hub to manage authentication, display detection results, and interact with users via contact forms. Detection happens locally; this server interface focuses purely on session management, UI rendering, and MySQL data handling.

## Features

- Responsive multi-page frontend:
  - Home
  - Download
  - Team
  - Contact Us
  - Login/Register
- Clean authentication system (login + register with session)
- Admin panel (`user_page.php`) for contact form logs and detection moderation
- Detection upload API with image saving and metadata logging
- Beautiful dark mode with **glassmorphism**
- GitHub download integration
- Animated backgrounds (Particles.js, AOS)
- Custom-styled with `login.css` & `style.css`

## Technologies Used

| Layer        | Tech                         |
|--------------|------------------------------|
| Frontend     | HTML5, CSS3, JavaScript      |
| Backend      | PHP (session, form handling) |
| Database     | MySQL (auth, contact, detects)|
| Styling      | `login.css`, `style.css`     |
| JS Libraries | AOS, Particles.js, Lucide    |

## Installation

### Prerequisites

- PHP 7.4+ server (XAMPP, MAMP, WAMP)
- MySQL Server
- Git (optional for clone)

### Steps

```bash
git clone https://github.com/SHADOW2669/CivicEye-Website-Server.git
mv CivicEye-Website-Server /path/to/htdocs/
```

Then open:
```
http://localhost/CivicEye-Website-Server/index.php
```

## Configuration

### `config.php`

```php
$host = "localhost";
$username = "root";
$password = "";
$database = "civiceye";
```

Update based on your DB server credentials.

## Database Setup

### 1. Create the database

```sql
CREATE DATABASE civiceye;
```

### 2. Create tables

#### `users`
```sql
CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role VARCHAR(50) DEFAULT 'user'
);
```

#### `contacts`
```sql
CREATE TABLE contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  message TEXT,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### `detections`
```sql
CREATE TABLE detections (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  timestamp DATETIME NOT NULL,
  frame_number INT NOT NULL,
  helmet_status VARCHAR(20) NOT NULL,
  status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
  image LONGBLOB,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## How Login System Works

The login system is built using PHP sessions. When a user logs in via `login.php`:

1. PHP checks the email and password against the `users` table.
2. If valid, a `$_SESSION` is created storing `user_id` and `role`.
3. The session persists across pages until logout or browser close.

### User vs Admin Access

- **User**: Can view personal detections via `user_page.php`.
- **Admin**: Can view all detections, approve/reject entries, and see all contact messages.

## Insert Admin to Database

To insert an admin manually:

1. Generate a hashed password using PHP:

```php
<?php echo password_hash("yourpassword", PASSWORD_DEFAULT); ?>
```

2. Insert the user:

```sql
INSERT INTO users (name, email, password, role)
VALUES ('Admin', 'admin@example.com', 'HASHED_PASSWORD_HERE', 'admin');
```

## API Endpoints

### 1. `api/login.php` — User Login

**Method**: `POST`  
**Content-Type**: `application/json`

**Request Body**:
```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

**Response**:
```json
{
  "status": "success",
  "user": {
    "id": 1,
    "name": "User",
    "role": "user"
  }
}
```

---

### 2. `api/upload.php` — Upload Detection

**Method**: `POST`  
**Form Data**:
- `timestamp`
- `frame`
- `helmet`
- `user_id`
- `image` (binary file)

**Response**:
```json
{ "status": "success" }
```

## User Dashboard

After login, users are redirected to `user_page.php` which displays:

- Personal information (name, email)
- Uploaded detection records (filtered by their `user_id`)
- Logout option

All views are session-restricted using `$_SESSION['role'] === 'user'`

## Admin Panel

Admins logging in via `login.php` and accessing `user_page.php` see:

- All detection entries from all users
- Approve / Reject buttons for each detection
- Contact form message log
- Enhanced view based on `$_SESSION['role'] === 'admin'`

## Usage

Navigate through:

- `index.php` → Homepage
- `download.php` → GitHub & OS setup
- `team.php` → Team members
- `contact-us.php` → Form → stored in MySQL
- `login.php` → Login/Register form
- `user_page.php` → User/Admin dashboard

## Session Handling

- Login creates `$_SESSION['user_id']` and `$_SESSION['role']`
- Session is destroyed on logout or browser close
- Access to user/admin views is protected by session roles

## Contributing

We welcome all contributions that help improve the Civic Eye Website!

If you have suggestions, bug fixes, design improvements, or feature additions, feel free to fork the repository and submit a pull request.

- Found an issue? [Open a GitHub Issue](https://github.com/SHADOW2669/CivicEye-Website-Server/issues)
- Want to enhance something? We'd love your contributions!

> 🙌 Feel free to use this project in your own work — but if you make improvements, please consider contributing them back to the community!

## License

Licensed under the **MIT License**.  
See the [LICENSE](https://github.com/SHADOW2669/CivicEye-Website-Server/blob/main/LICENSE).

## Notes

- Always run PHP files from a server (`http://localhost/...`) not from `file://`
- Ensure MySQL is running before launching the site
- Run the Python detection  [`civiceye.py`](https://github.com/SHADOW2669/CivicEye/blob/main/civiceye.py) locally on your system.
