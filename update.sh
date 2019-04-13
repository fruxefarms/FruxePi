#!/bin/sh

# FRUXEPI DOCKER update

# Arguments
args=$1

# Remove Previous FruxePi Version
echo -e "\e[35mRemoving Previous Version...\e[0m"

# Remove old Docker containers
if [ "$(docker ps -q -f name=frxpi-APACHE)" ] && [ "$(docker ps -q -f name=frxpi-MYSQL)" ]; then
    sudo docker rm -f frxpi-APACHE frxpi-PHPMYADMIN frxpi-MYSQL
    sudo docker system prune -a --volumes
fi

# Fetch updates
sudo git pull

# Show terminal log
if [ "$args" == "-log" ]; then
    sudo bash install.sh -log
else
    {
    sudo bash install.sh
    } &> /dev/null
fi