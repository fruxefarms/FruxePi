#!/bin/sh

#FRXPI Container Startup Script

# Start CRON
service cron start

# Start Apache
apachectl -D FOREGROUND


