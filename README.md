# FruxePi OPEN-PROTOTYPE v0.1-BETA
A browser-based dashboard to monitor and automate indoor agriculture using the Raspberry Pi.

![FruxePi Dashboard](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/screenshot-frame.png)


***PLEASE NOTE:** This version of the FruxePi is still under development and in prototype. Our goal is to make this application effortless to deploy and run on your Raspberry Pi. However, until we get all the bugs worked out, this project may require the knowledge of an advanced Pi user. Nonetheless, if you are keen on this project and are having issues deploying FruxePi, please create an issue explaining your problem or contact <hello@fruxe.co>.*

---

## Quick Install
Quickly deploy the FruxePi application using Docker and the installation script. 

### Clone Project
Clone the FruxePi repository to your Raspberry Pi.

```
git clone https://github.com/fruxefarms/FruxePi.git
cd FruxePi
```

### Run Installation Script
Run the `install.sh` script to quickly install Docker, Docker Compose and some other installation dependencies.

```
sudo bash install.sh
```

>**Manual Installation:** The FruxePi can also be manually installed and configured by following these [instructions](#manual-installation).

### Launch App
Visit `http://<your-raspi-ip-address>:80/` in your browser to launch the FruxePi dashboard.

**Default Login**

```
Username: hello@fruxe.co 
Password: password
``` 

---

## FruxePi Overview

The FruxePi is a web application running on a LAMP stack (Linux, Apache, MySQL, PHP) which can be accessed from the browser on your local network. The application collects grow data from a variety of sensors and controls various operations such as lighting, ventilation and watering, using relay modules.

### Demo
**URL:**  https://demo.fruxe.co/
</br>**User:**  demo@fruxe.co
</br>**Pass:**  password


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
- Raspberry Pi 3 Model B
- Raspberry Pi Model Zero W

#### Sensors and Relays
The following sensors and relays connect to the Raspberry Pi GPIO board. Although many of these accessories are optional, to get the full experience of the FruxePi application, the Climate Sensor (DHT22) is compulsory. 

Sensors and relays can be activated or deactivated easily and at anytime using the dashboard.n

- **Climate Sensor**
</br>The DHT22 is a basic digital temperature and humidity sensor. It uses a capacitive humidity sensor and a thermistor to measure the surrounding air, and spits out a digital signal on the data pin, no analog input pins needed.
</br>![Climate Sensor](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/climate_sensor.png)

- **Moisture Probe**
</br>The TE215 moisture probe is sensitive to ambient humidity and is used to detect the moisture content of the soil or growing medium. The module outputs a HIGH or LOW value when the the soil humidity exceeds a set threshold value.
</br>![Moisture Probe](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/moisture_sensor.png) 

- **5V Relay Modules**
</br>5V Relay Modules are a great way to control high current and high voltage devices directly from the Raspberry Pi.
</br>![Relay Module](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/relay.png)

- **Raspberry Pi Camera**
</br>The Raspberry Pi Camera Module is the official camera product from the Raspberry Pi Foundation. The FruxePi has been tested using the 8MP Camera Module v2 (2016).
</br>![Camera](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/camera.png)

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

## Manual Installation
For ease of use across all Raspberry Pi models and platforms, we suggest running the Docker installer.

However, for those that wish to tinker and tweak their FruxePi, these instructions will assist you to install the application and configure the LAMP stack (Apache, PHP, and MySQL) and install Python dependencies on your Raspberry Pi:

#### Update package repositories
```
sudo apt-get update
sudo apt-get upgrade -y
```

#### Install Apache HTTP Server
Install Apache webserver and enable the `mod_rewrite` module.

```
sudo apt-get install apache2 -y
sudo a2enmod rewrite
sudo service apache2 restart
```

#### Install PHP
Install the PHP package with the following command:
```
sudo apt-get install php libapache2-mod-php -y
```

#### Download and install FruxePi application
Download and unzip the FruxePi application to your `/var/www/html` directory.

```
cd ~
wget https://github.com/fruxefarms/FruxePi/archive/master.zip
sudo unzip master.zip
sudo mv  -v ~/FruxePi-master/* /var/www/html/
sudo rm -rf FruxePi-master master.zip /var/www/html/index.html
```

#### Install MySQL and populate database
Install the MySQL Server and supporting PHP MySQL packages.
```
sudo apt-get install mysql-server php-mysql -y
```
Log in to MySQL as the root user. You will be prompted to enter the MySQL root password.
```
sudo mysql -u root -p
```
To create the `frxpi` database user, enter the following command. Replace `password` with your own.
```
GRANT ALL PRIVILEGES ON *.* TO 'frxpi'@'localhost' IDENTIFIED BY 'password';
```
Create `frx_db` database.
```
CREATE DATABASE frx_db;
```
Enter `\q` to exit the MySQL prompt.

Import the database structure using the following command.
```
sudo mysql -u frxpi -p frx_db < /var/www/html/db/frx_db.sql
```

#### Install phpMyAdmin
Install the phpMyAdmin package using:

```
sudo apt-get install phpmyadmin -y
```

#### Additional dependencies
Install additional dependencies and libraries:

```
sudo apt-get install cron nano unzip -y
```

### Python Dependencies

#### pip Installer
Make sure your system is able to compile and download Python extensions with `pip`.

On Raspbian you can ensure your system is running `pip` by using the following commands:

````
sudo apt-get install python-pip
sudo python -m pip install --upgrade pip setuptools wheel
````

#### Installing Dependencies
Install the following packages and modules from the command line:

```
sudo pip install Adafruit_DHT pymysql pillow
```

### Configuration

Once the application has been installed please check that the following settings have been set appropriately.

#### Configure Database

Ensure that these database credentials match your MYSQL user authorization. 

**Codeigniter Config**
</br>Open the Codeigniter `database.php` config file in the `/html/application/config/` folder:

```
cd /var/www/html/application/config
sudo nano database.php
```


Make sure that the following fields are set properly with your MYSQL database credentials.

```
'hostname' => 'localhost:3306',
'username' => 'frxpi',
'password' => 'password',
'database' => 'frx_db',
```
**FruxePi CLI Python Script**
</br>Open the FruxePi CLI Python file `fruxepi.py` in the `/html/actions/` folder and make sure that the following fields are set properly with your MYSQL database credentials.

```
host = "localhost"
user = "frxpi"
password = "password"
database = "frx_db"
```

#### Virtual Hosts
Ensure that your `.htaccess` file is enabled by setting `AllowOverride` to `All` in the virtual hosts file
```
sudo nano /etc/apache2/apache2.conf
```
Scroll to the bottom of the file and edit the `<Directory /var/www/>` edit `AllowOverride`:

```
<Directory /var/www/>
    Options Indexes FollowSymLinks MultiViews
    AllowOverride All
    Require all granted
</Directory>
```

#### Configure Permissions

Please set these permissions and access levels.

Grant `www-data` GPIO access permissions.
```
sudo usermod -a -G gpio www-data
```

Super User access is necessary to access certain functions of the GPIO. Grant `sudo` access to the `www-data` user to call the FruxePi CLI Python script. 

```
sudo visudo
```

Add the following code to the bottom of the file. 

```
# FruxePi Actions
www-data ALL=(root) NOPASSWD: /var/www/html/actions/fruxepi.py
```

#### Configure CRON

Cron is a tool for configuring scheduled tasks on Unix systems. It is used to schedule commands or scripts to run periodically and at fixed intervals. 

Edit the CRON job schedule for the `www-data` user.

```
sudo crontab -u www-data -e
```

The first time you run `crontab` you'll be prompted to select an editor; if you are not sure which one to use, choose `nano` by pressing `Enter`.

Copy the code below into the `www-data` crontab file. Remember to un-comment the lines for the sensors your wish to connect (camera, lights, fan, pump). Save and exit.

```
# FruxePi
* * * * * python /var/www/html/actions/fruxepi.py update -growdata
0 * * * * python /var/www/html/actions/fruxepi-chart.py
0 1 * * * python /var/www/html/actions/fruxepi.py maint -cleanup
#* * * * * python /var/www/html/actions/fruxepi.py camera -crop
#0 1 * * * python /var/www/html/actions/fruxepi.py lights -ON 15
#0 1 * * * python /var/www/html/actions/fruxepi.py lights -OFF 15
#0 * * * * python /var/www/html/actions/fruxepi.py fan -RUN 17 10
#11 11 * * * python /var/www/html/actions/fruxepi.py pump -RUN 15 5
```


### Restart Raspberry Pi

Lastly, reboot your Raspberry Pi and proceed to the Dashboard login upon restart.

```
sudo reboot
```

---

## Dashboard Login

If the installation and configuration process was successful, visit `http://<your-raspi-ip-address>:80/` in your browser and login using the default credentials:

```
Username: hello@fruxe.co 
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
* [Ion Auth](http://benedmunds.com/ion_auth/) - Ion Auth is a simple and lightweight authentication library for the CodeIgniter framework.
* [Adafruit DHT Sensor Library](https://github.com/adafruit/Adafruit_Python_DHT) - Python library to read the DHT series of humidity and temperature sensors on the Raspberry Pi.
* [PyMySQL](https://github.com/PyMySQL/PyMySQL) - A pure-Python MySQL client library.
* [Pillow](https://github.com/python-pillow/Pillow) - The friendly Python Imaging Library fork.
* [Docker](https://www.docker.com/) - Containerized LAMP stack.

### Front-End
* [Bootstrap](https://getbootstrap.com/) - The world's most popular HTML, CSS, and JS front-end component library.
* [Bootstrap Datepicker](https://github.com/uxsolutions/bootstrap-datepicker) - A flexible datepicker widget in the Bootstrap style.
* [jQuery Timepicker](https://jonthornton.github.com/jquery-timepicker/) - A lightweight, customizable javascript timepicker plugin.
* [Chart.js](http://www.chartjs.org/) - Simple yet flexible JavaScript charting for designers & developers.

---

## Version **frx-pi-v0.1-BETA**

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/fruxefarms/FruxePi/tags). 

---

## License

This project is released under **GPL 3.0**. 
>You are free to use, copy, distribute and transmit this software for non-commercial purposes. 

See [LICENSE.md](LICENSE.md) for more details. 

---

## Acknowledgments

* The seed of thought. Thanks to the **RaspiViv Project** for the inspiration and early confidence in making this project work. 
* Big thanks to all the master growers for sharing their earthly wisdom.
* Finally, a humble bow to the Raspberry Pi community. We owe a huge thank you to anyone who tinkered, tweaked or destroyed their Pi and were kind enough to share their story.
