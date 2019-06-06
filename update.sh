#!/bin/sh

# FRUXEPI DOCKER update
echo ""
echo -e "\e[1m\e[45mFruxePi Update Script\e[0m"
echo -e "\e[1mlatest version:\e[0m \e[37mfrx-pi-v0.3-BETA\e[0m"
echo -e "\e[1mweb:\e[0m \e[37mdocs.fruxe.co\e[0m"
echo ""

# Script arguments
args=$1

# Detect RPi model function
detect_rpi_model()
{
   if cat /proc/cpuinfo | grep -q '9000c1' || cat /proc/cpuinfo | grep -q '900092' || cat /proc/cpuinfo | grep -q '900093'; then
      rpi_model="armv6"
   else
      rpi_model="armv7"
   fi
}

detect_rpi_model

# Check if git installed function
check_for_git() {
   echo "Checking for Git installation..."
   git --version
   GIT_IS_AVAILABLE=$?
 
   if [ ! $GIT_IS_AVAILABLE -eq 0 ]; then
         echo "Installing Git"
         sudo apt-get install git
   fi
}


# Build Docker function
build_docker()
{
   cd docker/$1/
   sudo docker-compose up -d --force-recreate
}

# Determine RaspberryPi build architecture
build_containers()
{
   if cat /proc/cpuinfo | grep -q '9000c1' || cat /proc/cpuinfo | grep -q '900092' || cat /proc/cpuinfo | grep -q '900093'; then
      echo "Deploying Raspberry Pi Zero (ARMv6) compatible containers..."
      # Enable Logging
      if [ "$args" == "-log" ]; then
         build_docker $rpi_model   
      else
         {
         build_docker $rpi_model
         } &> /dev/null
      fi
   else
      echo "Deploying Raspberry Pi 3 (ARMv7) compatible containers..."
      # Enable Logging
      if [ "$args" == "-log" ]; then
         build_docker $rpi_model   
      else
         {
         build_docker $rpi_model
         } &> /dev/null
      fi
   fi
}


# Hard reset function
hard_reset() {

    # Remove previous version
    echo -e "\e[35mRemoving Previous Version...\e[0m"
    sudo docker rm -f frxpi-APACHE frxpi-PHPMYADMIN frxpi-MYSQL
    sudo docker system prune -a --volumes

    # Run fresh installation script
    sudo bash install.sh -log
}

# Run Update Check
update_check() {
    # Check if Docker containers deployed are running
    echo -e "\e[35mChecking installation...\e[0m"
    if docker inspect -f '{{.State.Running}}' 'frxpi-APACHE' | grep -q 'true' && docker inspect -f '{{.State.Running}}' 'frxpi-MYSQL' | grep -q 'true' ; then
        echo ""
        # Get Raspberry Pi local network IP address
        rpi_ip="$(ip addr | grep 'wlan0' | grep -o '[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}' | head -1)"
        msg="Visit \e[1mhttp://${rpi_ip}/\e[0m on your local network to access the FruxePi Dashboard."
        echo -e "\e[45mUpgrade complete!\e[0m"
        echo -e $msg
        echo ""
        exit 0
    else
        echo -e "\e[91mError! Upgrade process encountered errors and is incomplete.\e[0m"
        exit 1
    fi
}


# Run updates function
run_update() {

    echo -e "\e[35mRunning update...\e[0m"

    # Fetch updates
    check_for_git
    sudo git fetch --all
    git reset --hard origin/master

    # Rebuild docker containers
    build_containers

    # Check update
    update_check

}


# Run Hard Reset update
if [ "$args" == "-reset" ]; then
    hard_reset
    exit 0
fi

# Run normal update]
run_update

