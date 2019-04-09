# FRXPI Dockerfile
FROM balenalib/raspberrypi3-python:3.6-jessie-build

LABEL maintainer="dev@fruxe.co"

# Install Dependencies
RUN apt-get update && \
    apt-get install -y apache2 libapache2-mod-php5 mysql-server php5-mysql pwgen php-apc php5-mcrypt cron nano git unzip && \
    apt-get install -y python python-dev python-pip && \
    pip install --upgrade pip setuptools wheel && \
    pip install Adafruit_DHT pymysql RPi.GPIO

# Configure Apache
RUN a2enmod rewrite
ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# Configure MySQL
ADD mysqld.cnf /etc/mysql/mysql.conf.d/mysqld.cnf

# Sudo access for www-data user
RUN apt-get install -y sudo && \
    usermod -a -G sudo www-data && \
    echo "www-data ALL=(root) NOPASSWD: /var/www/html/actions/fruxepi.py" > /etc/sudoers.d/www-data && \
    chmod 0440 /etc/sudoers.d/www-data

# WiringPi Install
RUN git clone git://git.drogon.net/wiringPi && \
    cd wiringPi && \
    ./build

# CRON Setup
ADD crontab /tmp/crontab
ADD cron_init.sh /tmp/cron_init.sh

# Start Apache
# CMD ["apachectl", "-D", "FOREGROUND"]
COPY start.sh /start.sh
CMD ["./start.sh"]