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
} &> /dev/null

# Install Docker and Docker Compose
if [ ! -x "$(command -v docker)" ]; then
   echo "Installing docker"
   # Get the Docker signing key for packages
   curl -fsSL https://download.docker.com/linux/$(. /etc/os-release; echo "$ID")/gpg | sudo apt-key add -

   # Add the Docker official repos
   echo "deb [arch=armhf] https://download.docker.com/linux/$(. /etc/os-release; echo "$ID") \
      $(lsb_release -cs) stable" | \
      sudo tee /etc/apt/sources.list.d/docker.list

   sudo apt-get update
   sudo apt-get -y install docker-ce
   pip install docker-compose
fi

# Create FruxePi Docker containers
echo 'Building Docker containers... This will take several minutes.'

cd docker/
sudo docker-compose up -d

# Check if containers were created
echo 'Configuring Docker containers...'
if [ "$(docker ps -q -f name=frxpi-APACHE)" ] && [ "$(docker ps -q -f name=frxpi-MYSQL)" ]; then
   sudo docker exec -it frxpi-APACHE /bin/bash -c 'chmod +x /var/www/html/actions/fruxepi.py;'
   sudo docker exec -it frxpi-APACHE /bin/bash -c 'chmod 777 /var/www/html/assets/tmp/crontab.txt;'
   sudo docker exec -it frxpi-MYSQL /bin/bash -c 'mysql -u root -pfruxefarms frx_db < /docker-entrypoint-initdb.d/frx_db.sql;'
   sudo docker exec -it frxpi-APACHE /bin/bash -c 'bash /tmp/cron_init.sh;'
else
   echo "Error! Unable to configure Docker images."
   exit 1
fi

echo 'Checking installation...'
if [ "$(docker ps -q -f name=frxpi-APACHE)" ] && [ "$(docker ps -q -f name=frxpi-MYSQL)" ]; then
   echo "-----"
   # Get Raspberry Pi local network IP address
   rpi_ip="$(ip addr | grep 'wlan0' | grep -o '[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}' | head -1)"
   msg="Visit http://${rpi_ip} on your local network to access the FruxePi Dashboard."
   echo "Installation complete!"
   echo $msg
else
   echo "Error! Installation process encountered errors and is incomplete."
   exit 1
fi
