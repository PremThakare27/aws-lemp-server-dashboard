#!/bin/bash
# Project: Cloud-Hosted LEMP Infrastructure Deployment
# Description: Automates the installation of Nginx, MySQL, and PHP 8.3 on Ubuntu 24.04

# 1. Update System
echo "Updating system..."
sudo apt update && sudo apt upgrade -y

# 2. Install Nginx
echo "Installing Nginx..."
sudo apt install nginx -y

# 3. Install MySQL
echo "Installing MySQL..."
sudo apt install mysql-server -y

# 4. Install PHP & FPM (The Processor)
echo "Installing PHP 8.3 FPM..."
sudo apt install php8.3-fpm php-mysql -y

# 5. Configure Nginx (The "Magic" Step)
# This overwrites the default config with the correct PHP settings
echo "Configuring Nginx..."
sudo cat > /etc/nginx/sites-available/default <<EOF
server {
    listen 80 default_server;
    listen [::]:80 default_server;

    root /var/www/html;
    index index.php index.html index.htm index.nginx-debian.html;

    server_name _;

    location / {
        try_files \$uri \$uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
    }
}
EOF

# 6. Restart Nginx to apply changes
echo "Restarting Nginx..."
sudo systemctl reload nginx

echo "LEMP Stack Installation Complete!"