# FruxePi OPEN-PROTOTYPE v0.1-BETA
A browser-based dashboard to monitor and automate indoor agriculture using the Raspberry Pi.


[fruxe.co/project](http://fruxe.co/project)

![FruxePi Dashboard](https://github.com/fruxefarms/FruxePi/blob/master/screenshot-frame.png)


***NOTE:** This version of the FruxePi is still under development and in prototype. Our goal is to make this application effortless to deploy and run on your Raspberry Pi. However, until we get all the bugs worked out, this project may require the knowledge of an advanced Pi user. Nonetheless, if you are keen on this project and are having issues deploying FruxePi, please create an issue explaining your problem or contact <hello@fruxe.co>.*

---

## Getting Started

These instructions will help you get the FruxePi application running on your Raspberry Pi. Further instructions on how to install, configure and connect the various sensors/relays to your Raspberry Pi have been published [here](http://fruxe.co/project).

### The General Idea

In a nutshell, the FruxePi is a web application running on a LAMP stack (Linux, Apache, MySQL, PHP) which can be accessed from the browser on your local network. The application collects grow data from a variety of sensors and controls various operations such as lighting, ventilation and watering, using relay modules.

### What can it do?

Using the browser-based dashboard, users can easily monitor the status of their growing environment and automate certain tasks. 

The basic functionalies of the FruxePi include:

- Monitor growing climate (Temperature and Humidity).
- Chart visualizations for historical data.
- Manage crops by tracking progress and time to harvest.
- Monitor soil moisture.
- Camera monitoring and manual photo capture.
- Lighting control.
- Fan control both manually and exception based (Temperature or Humidity thresholds).
- Watering pump control and daily automation.
- User management

### What do I need?

The FruxePi runs on the RaspberryPi using several sensors and relays. All sensors and relays are not necessary for basic operation, however, the Climate sensor (DHT22- Temperature\Humidity) is considered a compulsory component and key to the operation of the application.

#### Raspberry Pi
The FruxePi has been tested and runs well on the following models running Raspian: 
- Raspberry Pi 3 Model B+
- Raspberry Pi Model Zero W

#### Sensors and Relays
The following sensors and relays connect to the Raspberry Pi GPIO board. Although many of these accessories are optional, to get the full experience of the FruxePi application, the Climate Sensor (DHT22) is compulsory. 

Sensors and relays can be activated or deactivated easily and at anytime using the dashboard.n

- **Climate Sensor**
</br>The DHT22 is a basic digital temperature and humidity sensor. It uses a capacitive humidity sensor and a thermistor to measure the surrounding air, and spits out a digital signal on the data pin, no analog input pins needed.

- **Moisture Probe** 
</br>The TE215 moisture probe is sensitive to ambient humidity and is used to detect the moisture content of the soil or growing medium. The module outputs a HIGH or LOW value when the the soil humidity exceeds a set threshold value.

- **5V Relay Modules**
</br>5V Relay Modules are a great way to control high current and high voltage devices directly from the Raspberry Pi.

- **Raspberry Pi Camera**
</br>The Raspberry Pi Camera Module is the official camera product from the Raspberry Pi Foundation. The FruxePi has been tested using the 8MP Camera Module v2 (2016).

---

### Connecting Sensors and Relays to GPIO pins
Please be aware that there are multiple ways of referring to the pins on the Raspberry Pi GPIO board. When connecting peripherals to the Raspberry Pi please refer to the pins by their GPIO names, this is known as BCM naming (Broadcom Pin Number). A handy reference for pin numbering can be accessed on the Raspberry Pi by opening a terminal window and running the command `pinout` or check out [pinout.xyz](https://pinout.xyz/) which is another great visual tool.

You may connect the peripherals using any configuration you wish, however, the FruxePi application uses these pins as default. Pins can easily be changed from the dashboard when enabling or disabling peripherals. 

#### Climate Sensor

Connect the DHT22 sensor using the following GPIO pin configuration.
- 3v3 Power (Physical pin 1)
- Ground (Physical pin 6)
- Data (Physical pin 3)  

#### Moisture Probe

Connect the TE215 moisture probe using the following GPIO pin configuration.
- 3v3 Power (Physical pin 1)
- Ground (Physical pin 6)
- Data (Physical pin 13)

#### Relays

The FruxePi uses a 5V 3-channel relay to control the lights, fans and water pump, which are connected to their respective AC power plug. Relays can be connected in any configuration (1/2/3 channel).    

For many, this is step arguably the trickiest part of setting up the FruxePi. A power strip controlled by the Raspberry Pi is a common project found online and many tutorials are available which can offer guidance on how to wire a relay power outlet appropriately. A few tutorials we found particularly helpful were:

- [Web Controlled 8-Channel Powerstrip](https://www.instructables.com/id/Web-Controlled-8-Channel-Powerstrip/)

> It goes without saying, but for some reason we still have it say it. Please be careful and exercise the utmost caution when working with high voltage electricity. Err on the side of caution and get some help if you're confused or lost in the process. Let's all be safe people! 

**Lights**
</br>Connect the fan relay using the following GPIO pin configuration.
- 3v3 Power (Physical pin 1)
- Ground (Physical pin 6)
- Data (Physical pin 13)

**Fans**
</br>Connect the fan relay using the following GPIO pin configuration.
- 3v3 Power (Physical pin 1)
- Ground (Physical pin 6)
- Data (Physical pin 13)

**Pump**
</br>Connect the pump relay using the following GPIO pin configuration.
- 3v3 Power (Physical pin 1)
- Ground (Physical pin 6)
- Data (Physical pin 13)

---

### Installation
These instructions will assist you to install the application and configure the LAMP stack (Apache, PHP, and MySQL) on your Raspberry Pi:

First, update your package repositories.
```
sudo apt-get update
sudo apt-get upgrade -y
```

Install Apache
```
sudo apt-get install apache2 -y
sudo a2enmod rewrite
sudo service apache2 restart
```

Install PHP
```
sudo apt-get install php libapache2-mod-php -y
```

Install MYSQL
```
sudo apt-get install mysql-server php-mysql -y
```

Install PHPMYADMIN
```
sudo apt-get install phpmyadmin -y
```
Install additional dependencies and libraries.
```
sudo apt-get install -y cron nano unzip
```

Download and unzip the FruxePi application to your `/var/www/html` directory.
```
wget https://github.com/fruxefarms/FruxePi/archive/master.zip
sudo unzip -d /var/www/html master.zip
```
Log in to MySQL as the root user. You will be prompted to enter the MySQL root password.
```
mysql -u root -p
```
To create a database user, type the following command. Replace `password` with your own.
```
GRANT ALL PRIVILEGES ON *.* TO 'frxpi'@'localhost' IDENTIFIED BY 'password';
```
Enter `\q` to exit the MySQL prompt.

To create a database, type the following command.
```
CREATE DATABASE frx_db;
```
Import the database using the following command.
```
mysql -u frxpi -p frx_db < /var/www/html/db/frx_db.sql
```
Lastly, reboot your Raspberry Pi
```
sudo reboot
```

---

### Configuration

Once the application has been installed please check that the following settings have been set appropriately.

#### Configure Database

Ensure that these database credentials match your MYSQL user authorization. 

**Codeigniter Config**
</br>Open the Codeigniter `database.php` config file in the `/frx-pi/application/config/` folder and make sure that the following fields are set properly with your MYSQL database credentials.

```
'hostname' => 'localhost:3306',
'username' => 'frxpi',
'password' => 'password',
'database' => 'frx_db',
```
**FruxePi CLI Python Script**
</br>Open the FruxePi CLI Python file `fruxepi.py` in the `/frx-pi/actions/` folder and make sure that the following fields are set properly with your MYSQL database credentials.

```
host = "localhost"
user = "frxpi"
password = "password"
database = "frx_db"
```

---

### Dashboard Login

If the installation and configuration process was successful, visit `http://<your-raspi-ip-address>:8080/` in your browser and login using the default credentials:

```
Username: hello@fruxe.com 
Password: password
```
You may change the password upon login in User settings. Additional users can also be added.

> **How do I find my Pi's IP address?**
<br>[Check out the following link](https://learn.adafruit.com/adafruits-raspberry-pi-lesson-3-network-setup/finding-your-pis-ip-address)


#### Enable Sensors & Relays

Enabling and disabling sensors is easy from the dashboard using the slide toggle. You may also run the diagnostics function to test if the peripherals are connected properly.

---

## Built With
This project was built with the assistance of the following libraries and tools:

### Back-End

* [Codeigniter](https://codeigniter.com/) - PHP web framework.
* [Docker](https://www.docker.com/) - Containerized LAMP stack development environment.

### Front-End
* [Bootstrap](https://getbootstrap.com/) - The world's most popular HTML, CSS, and JS front-end component library.
* [Bootstrap Datepicker](https://github.com/uxsolutions/bootstrap-datepicker) - A flexible datepicker widget in the Bootstrap style.
* [jQuery Timepicker](https://jonthornton.github.com/jquery-timepicker/) - A lightweight, customizable javascript timepicker plugin.
* [Chart.js](http://www.chartjs.org/) - Simple yet flexible JavaScript charting for designers & developers.

---

## Versioning frx-dev-v0.1-beta

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

---

## License

This project is released under GPL 3.0 - see the [LICENSE.md](LICENSE.md) file for more details. You are free to use, copy, distribute and transmit this software for non-commercial purposes.

---

## Acknowledgments

* The seed of thought. Thanks to the **RaspiViv Project** for the inspiration and early confidence in making this project work. 
* Big thanks to all the master growers for sharing their earthly wisdom.
* Finally, a humble bow to the Raspberry Pi community. We owe a huge thank you to anyone who tinkered, tweaked or destroyed their Pi and were kind enough to share their story.