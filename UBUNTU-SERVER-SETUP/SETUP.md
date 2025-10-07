This guide provides the step-by-step commands to set up a web server on a Debian-based Linux distribution (like Ubuntu). The setup includes installing a LAMP stack (Apache, MySQL, PHP), configuring a firewall, deploying the CivicEye website from a GitHub repository, and installing Webmin for server management.

## 🚀 Installation Steps

Follow these steps in order to configure your server.

### 1\. Configure Automatic Security Updates

First, ensure your system automatically installs security updates to keep it secure.

```bash
# Install the necessary packages
sudo apt update
sudo apt install unattended-upgrades update-notifier-common -y

# Configure unattended-upgrades (optional, but recommended)
# This command opens a configuration file. You can enable automatic reboots if needed.
sudo nano /etc/apt/apt.conf.d/50unattended-upgrades

# Enable automatic updates by creating/editing this file
sudo nano /etc/apt/apt.conf.d/20auto-upgrades
```

In the `20auto-upgrades` file, add the following content to enable daily updates and auto-cleaning of old packages:

```
APT::Periodic::Update-Package-Lists "1";
APT::Periodic::Unattended-Upgrade "1";
APT::Periodic::AutocleanInterval "7";
```

### 2\. Install Web Server and PHP

Install Apache2 (the web server) and PHP to process the website's code.

```bash
# Install Apache2 web server
sudo apt install apache2 -y

# Install PHP and its common modules
sudo apt install php libapache2-mod-php php-mysql -y
```

### 3\. Install and Configure Firewall (UFW)

Set up the Uncomplicated Firewall (UFW) to secure your server by blocking unwanted traffic.

```bash
# Install UFW
sudo apt install ufw -y

# Set default policies: allow all outgoing, deny all incoming
sudo ufw default allow outgoing
sudo ufw default deny incoming

# Allow essential services
sudo ufw allow OpenSSH       # For SSH access (Port 22)
sudo ufw allow http          # For the website (Port 80)
sudo ufw allow 10000/tcp     # For Webmin access

# Enable the firewall
sudo ufw enable

# Check the status to ensure rules are active
sudo ufw status
```

### 4\. Deploy the CivicEye Website

Clone the website files from the GitHub repository into the web server's root directory.

```bash
# Navigate to the web server's public directory
cd /var/www/html/

# Clone the repository
git clone https://github.com/SHADOW2669/CivicEye-Website-Server.git
```

**Note:** This will place the website in `/var/www/html/CivicEye-Website-Server/`. You may need to move the files into `/var/www/html/` or configure Apache to point to this subdirectory.

### 5\. Install and Secure MySQL Database

Install the MySQL database server to store website data and secure the installation.

```bash
# Install the MySQL server package
sudo apt install mysql-server -y

# Log in to MySQL to set the root password
sudo mysql
```

Inside the MySQL prompt, run the following command. **Replace `'your_strong_password_here'` with a secure password.**

```sql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'your_strong_password_here';
EXIT;
```

Now, run the secure installation script to remove insecure defaults.

```bash
# Run the security script and follow the on-screen prompts
sudo mysql_secure_installation
```

### 6\. Install Database Management Tools (Optional)

Install phpMyAdmin for web-based database management and Webmin for server administration.

```bash
# Install phpMyAdmin
sudo apt install phpmyadmin -y

# Download the Webmin setup script
curl -o webmin-setup-repo.sh https://raw.githubusercontent.com/webmin/webmin/master/webmin-setup-repo.sh

# Run the script
sh webmin-setup-repo.sh

# Install Webmin
sudo apt install webmin --install-recommends
```

### 7\. Finalize Setup

Restart the Apache web server to apply all changes.

```bash
sudo systemctl restart apache2.service
```

-----

## ✅ Accessing Your Services

  * **Website**: Open a web browser and navigate to your server's IP address (`http://192.168.0./`).
  * **phpMyAdmin**: Navigate to `http://192.168.0./phpmyadmin`.
  * **Webmin**: Navigate to `https://192.168.0.:10000`.
