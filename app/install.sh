# FruxePi (frx-dev-v0.1)

# RaspberryPi Deployment Script
echo "FruxePi (frx-dev-v0.1)"
echo "Deploying..."

# Update Repositories
echo "Updating Repositories..."
sudo apt-get update
sudo apt-get upgrade

# Installing Dependencies
echo "Installing Dependencies..."
sudo apt-get install zip

# Install Docker
echo "Installing Docker..."
# Manual: curl -sSL https://get.docker.com | sh
# Remove Docker: sudo apt-get purge docker-ce

curl -fsSL get.docker.com -o get-docker.sh && sh get-docker.sh

# Add Docker to sudo group - This may already exist.
sudo groupadd docker

# Add the connected user “$USER” to the docker group.
sudo gpasswd -a $USER docker

# Install Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/download/1.22.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose


#sudo usermod -a -G gpio www-data

# sudo visudo
# www-data ALL=(root) NOPASSWD: /var/www/frx-dev/actions/fruxepi.py


# Reboot RaspberryPi
echo "Installation Complete!"
echo "Rebooting"
sudo reboot