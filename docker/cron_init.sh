#!/bin/sh

# CRON Initialization Script
sudo crontab -u www-data /tmp/crontab
/etc/init.d/cron start
#sudo service cron start
