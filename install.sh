#!/bin/sh

# FRUXEPI DOCKER installation
echo ""
echo -e "\e[1m\e[45mFruxePi v0.3-BETA Install\e[0m"
echo -e "\e[1mversion:\e[0m \e[37mfrx-pi-v0.3-BETA\e[0m"
echo -e "\e[1mweb:\e[0m \e[37mdocs.fruxe.co\e[0m"
echo ""

# Arguments
args=$1

# To get the latest package lists
echo -e "\e[35mGetting Latest Updates...\e[0m"
{
   sudo apt-get update
} &> /dev/null

# Install required packages
echo -e "\e[35mInstalling required packages..\e[0m"
{
sudo apt-get install -y python python-pip
} &> /dev/null

# Install Docker Function
install_docker()
{
   echo "Installing docker"
   sudo apt-get -y install \
      apt-transport-https \
      ca-certificates \
      curl \
      gnupg2 \
      software-properties-common

   # Get the Docker signing key for packages
   curl -fsSL https://download.docker.com/linux/raspbian/gpg | sudo apt-key add -

   # Add the Docker official repos
   echo "deb [arch=armhf] https://download.docker.com/linux/raspbian $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list

   sudo apt-get update
   sudo apt-get -y install docker-ce containerd.io
   
   sudo usermod -a -G docker $USER
   
   pip install docker-compose

   if [ ! -x "$(command -v docker)" ]; then
      echo "Docker install successful!"
   else
      echo -e "\e[91mDocker install failed! Please try and install Docker manually and try again.\e[0m"
      exit 1
   fi

}

# Install Docker and Docker Compose if missing
if [  -x "$(command -v docker)" ]; then
   echo -e "\e[91mDocker is missing!\e[0m"
   
   while true; do
      read -p "Would you also like to install Docker and Docker-Compose (y/n): "  answer

      if [ $answer == "y" ]; then
            install_docker
            break
      elif [ $answer == "n" ]; then
            echo -e "\e[91mDocker and Docker-Compose are required. Please manually install and run this script again.\e[0m"
            exit 1
      else
            echo "Invalid response!"
      fi
   done
fi

# Create FruxePi Docker containers
echo -e "\e[35mBuilding Docker containers...\e[0m \e[5mThis will take several minutes.\e[0m" 

# Build Docker function
build_docker()
{
   cd docker/$1/
   sudo docker-compose up -d
}

# Determine RaspberryPi build architecture
build_containers()
{
   if cat /proc/cpuinfo | grep -q '9000c1' || cat /proc/cpuinfo | grep -q '900092' || cat /proc/cpuinfo | grep -q '900093'; then
      echo "Deploying Raspberry Pi Zero (ARMv6) compatible containers..."
      # Enable Logging
      if [ "$args" == "-log" ]; then
         build_docker "armv6"   
      else
         {
         build_docker "armv6"
         } &> /dev/null
      fi
   else
      echo "Deploying Raspberry Pi 3 (ARMv7) compatible containers..."
      # Enable Logging
      if [ "$args" == "-log" ]; then
         build_docker "armv7"   
      else
         {
         build_docker "armv7"
         } &> /dev/null
      fi
   fi
}

# Build Containers
build_containers

# Configure Docker Function
configure_docker()
{
   sudo docker exec -it frxpi-APACHE /bin/bash -c 'chmod +x /var/www/html/actions/fruxepi.py;'
   sudo docker exec -it frxpi-APACHE /bin/bash -c 'chmod 777 /var/www/html/assets/tmp/crontab.txt;'
   sudo docker exec -it frxpi-MYSQL /bin/bash -c 'mysql -u root -pfruxefarms frx_db < /docker-entrypoint-initdb.d/frx_db.sql;'
   sudo docker exec -it frxpi-APACHE /bin/bash -c 'bash /tmp/cron_init.sh;'
}

# Check if containers were created
echo -e "\e[35mConfiguring Docker containers...\e[0m"
if [ "$(docker ps -q -f name=frxpi-APACHE)" ] && [ "$(docker ps -q -f name=frxpi-MYSQL)" ]; then
   # Show terminal log
   if [ "$args" == "-log" ]; then
      configure_docker
   else
      {
      configure_docker
      } &> /dev/null
   fi
else
   echo -e "\e[91mError! Unable to configure Docker images.\e[0m"
   exit 1
fi

# Check if Docker containers deployed are running
echo -e "\e[35mChecking installation...\e[0m"
if docker inspect -f '{{.State.Running}}' 'frxpi-APACHE' | grep -q 'true' && docker inspect -f '{{.State.Running}}' 'frxpi-MYSQL' | grep -q 'true' ; then
   echo ""
   # Get Raspberry Pi local network IP address
   rpi_ip="$(ip addr | grep 'wlan0' | grep -o '[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}' | head -1)"
   msg="Visit \e[1mhttp://${rpi_ip}/\e[0m on your local network to access the FruxePi Dashboard."
   echo -e "\e[45mInstallation complete!\e[0m"
   echo -e $msg
   echo ""
else
   echo -e "\e[91mError! Installation process encountered errors and is incomplete.\e[0m"
   exit 1
fi
