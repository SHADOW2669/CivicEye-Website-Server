# Exposing a Local Web Server with Cloudflare Tunnel

This guide provides step-by-step instructions on how to use Cloudflare Tunnel to expose a local web server (e.g., running on `localhost:80`) to the internet through a custom domain. This is achieved by running the `cloudflared` daemon on your Linux machine, which creates a secure, outbound-only connection to the Cloudflare network.

## Prerequisites

  * A **Cloudflare account**.
  * A **domain name** added to your Cloudflare account.
  * A local web application or service running and accessible (e.g., `http://localhost:80`).
  * A Linux server (the example uses Ubuntu 24.04 LTS).

-----

## Step 1: Install `cloudflared`

First, download the latest `cloudflared` package for your system architecture (the example uses `amd64`) and install it using `dpkg`.

```bash
# Download the .deb package
wget https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-amd64.deb

# Install the package
sudo dpkg -i cloudflared-linux-amd64.deb
```

-----

## Step 2: Authenticate `cloudflared`

Next, you need to log in to your Cloudflare account. This command will open a browser window asking you to authorize the tunnel.

```bash
cloudflared tunnel login
```

After logging in successfully, a certificate file (`cert.pem`) will be created in your home directory at `~/.cloudflared/`.

-----

## Step 3: Create a Tunnel

Create a named tunnel. This will register the tunnel with Cloudflare and generate a credentials file (`.json`) for it. Replace `civiceye-tunnel` with your desired tunnel name.

```bash
cloudflared tunnel create civiceye-tunnel
```

This command will output the tunnel's UUID and the location of the credentials file, which is crucial for the next step.
**Example Output:**

```
Created tunnel civiceye-tunnel with id 3942ca3b-a67a-472a-b356-3de59086902
Tunnel credentials written to /home/shadow269/.cloudflared/3942ca3b-a67a-472a-b356-3de59086902.json
```

**Keep this credentials file safe\!**

-----

## Step 4: Configure the Tunnel

To configure the tunnel, you need to create a `config.yml` file. This file tells `cloudflared` which tunnel to run and how to route incoming traffic.

1.  **Create the configuration directory:**
    It's best practice to place the configuration and credentials in `/etc/cloudflared/` so the service can run on system startup.

    ```bash
    sudo mkdir -p /etc/cloudflared/
    ```

2.  **Move the credentials file:**
    Copy the `.json` credentials file from your home directory to the new system directory.

    ```bash
    # Replace the UUID with your own
    sudo cp ~/.cloudflared/<UUID>.json /etc/cloudflared/
    ```

3.  **Create the configuration file:**
    Create and edit the `config.yml` file in the new directory.

    ```bash
    sudo nano /etc/cloudflared/config.yml
    ```

    Add the following content to the file. **Make sure to update the `tunnel` UUID, `credentials-file` path, and `hostname`**.

    ```yaml
    # The tunnel UUID. This is your tunnel's unique ID.
    tunnel: <UUID>
    # The path to your credentials file.
    credentials-file: /etc/cloudflared/<UUID>.json

    # This section defines the routing rules for incoming traffic.
    ingress:
      # Rule 1: Point a public hostname to a local service.
      # CHANGE the hostname to a domain or subdomain you control in Cloudflare.
      - hostname: civiceye.my
        # CHANGE the service to the address of your local application.
        service: http://localhost:80

      # This is a required catch-all rule to end the ingress rules.
      - service: http_status:404
    ```

-----

## Step 5: Route DNS to the Tunnel

Now, create a DNS `CNAME` record in your Cloudflare account to point your desired hostname to your tunnel.

```bash
# Syntax: cloudflared tunnel route dns <TUNNEL_NAME> <HOSTNAME>
cloudflared tunnel route dns civiceye-tunnel civiceye.my
```

This automatically creates the DNS record in your Cloudflare dashboard.

-----

## Step 6: Run `cloudflared` as a Service

To ensure the tunnel runs persistently and automatically restarts on boot, install it as a `systemd` service.

1.  **Install the service:**
    This command reads the configuration from `/etc/cloudflared/config.yml` and creates a systemd service file.

    ```bash
    sudo cloudflared service install
    ```

2.  **Enable and Start the service:**

    ```bash
    # Enable the service to start on boot
    sudo systemctl enable cloudflared

    # Start the service immediately
    sudo systemctl start cloudflared
    ```

3.  **Check the service status:**
    You can verify that the service is running correctly.

    ```bash
    sudo systemctl status cloudflared
    ```

    You should see an `active (running)` status, and the logs should show successful connections to Cloudflare locations.

Your local service at `http://localhost:80` is now securely accessible at `https://civiceye.my`\! 🚀
