#!/bin/sh

# CRON Initialization Script
sudo crontab -u www-data /tmp/crontab
# sudo /etc/init.d/cron restart
# update-rc.d cron enable
sudo service cron start
