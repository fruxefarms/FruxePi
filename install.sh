#!/bin/sh

# FRUXEPI DOCKER installation
echo 'Starting FruxePi Installation'

# To get the latest package lists
echo 'Getting Latest Updates...'
{
   sudo apt-get update
} &> /dev/null

# Install required packages
echo 'Installing required packages..'
{
sudo apt-get install -y python python-pip

# Get the Docker signing key for packages
curl -fsSL https://download.docker.com/linux/$(. /etc/os-release; echo "$ID")/gpg | sudo apt-key add -

# Add the Docker official repos
echo "deb [arch=armhf] https://download.docker.com/linux/$(. /etc/os-release; echo "$ID") \
   $(lsb_release -cs) stable" | \
   sudo tee /etc/apt/sources.list.d/docker.list

# Install Docker and Docker Compose
sudo apt-get update
sudo apt-get -y install docker-ce
pip install docker-compose
} &> /dev/null

# Create FruxePi Docker containers
echo 'Building Docker containers... This may take several minutes.'
{
cd docker/
sudo docker-compose up -d
} &> /dev/null

echo 'Configuring Docker containers...'
{
sudo docker exec -it frxpi-APACHE /bin/bash -c 'chmod +x /var/www/html/actions/fruxepi.py;'
sudo docker exec -it frxpi-APACHE /bin/bash -c 'chmod +x /var/www/html/actions/fruxepi-chart.py;'
sudo docker exec -it frxpi-APACHE /bin/bash -c 'chmod 777 /var/www/html/assets/tmp/crontab.txt;'
sudo docker exec -it frxpi-MYSQL /bin/bash -c 'mysql -u root -pfruxefarms frx_db < /docker-entrypoint-initdb.d/frx_db.sql;'
sudo docker exec -it frxpi-APACHE /bin/bash -c 'bash /tmp/cron_init.sh;'
} &> /dev/null

echo "-----"
echo 'Installation complete! Visit http://<your-raspi-ip-address>:80/ to view.'