#!/bin/sh

# CRON Initialization Script
sudo crontab -u www-data /tmp/crontab
sudo service cron start