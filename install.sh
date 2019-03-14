#!/bin/sh

# FRUXEPI DOCKER installation
echo 'Starting FruxePi Installation'

# To get the latest package lists
echo 'Getting Latest Updates...'
sudo apt-get update 
sudo apt-get -y upgrade

# Install required packages
echo 'Installing required packages..'
sudo apt-get install -y python python-pip

# Get the Docker signing key for packages
curl -fsSL https://download.docker.com/linux/$(. /etc/os-release; echo "$ID")/gpg | sudo apt-key add -

# Add the Docker official repos
echo "deb [arch=armhf] https://download.docker.com/linux/$(. /etc/os-release; echo "$ID") \
   $(lsb_release -cs) stable" | \
   sudo tee /etc/apt/sources.list.d/docker.list

# Install Docker
echo 'Installing Docker...'
sudo apt-get update
sudo apt-get -y install docker-ce

# Install Docker Compose from pip
pip install docker-compose

# Create FruxePi Docker containers
echo 'Creating Docker containers...'
cd docker/
sudo docker-compose up -d

echo 'Setting container permissions...'
sudo docker exec -it frxpi-APACHE /bin/bash -c 'chmod +x /var/www/html/actions/fruxepi.py;'
sudo docker exec -it frxpi-APACHE /bin/bash -c 'chmod 777 /var/www/html/assets/tmp/crontab.txt;'

echo 'Importing database schema...'
sudo docker exec -it frxpi-MYSQL /bin/bash -c 'mysql -u root -pfruxefarms frx_db < /docker-entrypoint-initdb.d/frx_db.sql;'

echo 'Scheduling cron tasks...'
sudo docker exec -it frxpi-APACHE /bin/bash -c 'bash /tmp/cron_init.sh;'

echo "-----"
echo 'Installation complete! Visit http://<your-raspi-ip-address>:80/ to view'