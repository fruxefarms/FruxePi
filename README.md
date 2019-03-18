# FruxePi OPEN-PROTOTYPE v0.2-BETA
A browser-based dashboard to monitor and automate indoor agriculture using the Raspberry Pi.

![FruxePi Dashboard](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/screenshot-frame.png?raw=true)


***PLEASE NOTE:** This version of the FruxePi is still under development and in prototype. Our goal is to make this application effortless to deploy and run on your Raspberry Pi. However, until we get all the bugs worked out, this project may require the knowledge of an advanced Pi user. Nonetheless, if you are keen on this project and are having issues deploying FruxePi, please create an issue explaining your problem or contact <hello@fruxe.co>.*

Quick Links
=================

   * [Overview](#FruxePi-Overview)
   * [Features](#Features)
   * [Requirements](#Requirements)
   * [Easy Install](#Easy-Install)
   * [Documentation](https://docs.fruxe.co)
   * [Help](https://docs.fruxe.co)
   * [License](#License)
   * [About](#About-Fruxe)

---

## FruxePi Overview

The FruxePi is a web application running on a LAMP stack (Linux, Apache, MySQL, PHP) which can be accessed from the browser on your local network. The application collects grow data from a variety of sensors and controls various operations such as lighting, ventilation and watering, using relay modules.

### Demo
**URL:**  https://demo.fruxe.co/
</br>**User:**  demo@fruxe.co
</br>**Pass:**  password


### Features

Using the browser-based dashboard, users can easily monitor the status of their growing environment and automate certain tasks. 

The basic functionalies of the FruxePi include:

- Monitoring growing climate (Temperature and Humidity).
- Chart visualizations for historical temperature and humidity data.
- Manage crops by tracking progress and time to harvest.
- Monitor soil moisture.
- Camera monitoring with periodic and manual photo capture.
- Manual and scheduled lighting control.
- Fan control both manually and exception based (Temperature or Humidity thresholds).
- Watering pump control and daily automation.
- User authentication and management.

### Requirements

The FruxePi runs on the RaspberryPi using several sensors and relays. All sensors and relays are not necessary for basic operation, however, the Climate sensor (DHT22- Temperature\Humidity) is considered a compulsory component and key to the operation of the application.

#### Raspberry Pi
The FruxePi has been tested and runs well on the following models running Raspian: 
- Raspberry Pi 3 Model B
- Raspberry Pi Model Zero W

> [How to Check the Software and Hardware Version of a Raspberry Pi](http://ozzmaker.com/check-raspberry-software-hardware-version-command-line/)

#### Sensors and Relays
The following sensors and relays connect to the Raspberry Pi GPIO board. Although many of these accessories are optional, to get the full experience of the FruxePi application, the Climate Sensor (DHT22) is compulsory. 

|Part|Description|
| ------------- | ------------- |
|![Climate Sensor](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/climate_sensor.png?raw=true) | **Climate Sensor**<br/> The DHT22 is a basic digital temperature and humidity sensor. It uses a capacitive humidity sensor and a thermistor to measure the surrounding air, and spits out a digital signal on the data pin, no analog input pins needed.|
|![Moisture Probe](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/moisture_sensor.png?raw=true)  | **Moisture Probe**<br/> The TE215 moisture probe is sensitive to ambient humidity and is used to detect the moisture content of the soil or growing medium. The module outputs a HIGH or LOW value when the the soil humidity exceeds a set threshold value. |
|![Relay Module](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/relay.png?raw=true)|**5V Relay Modules**<br/> 5V Relay Modules are a great way to control high current and high voltage devices directly from the Raspberry Pi.|
|![Camera](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/camera.png?raw=true)|**Raspberry Pi Camera**<br/> The Raspberry Pi Camera Module is the official camera product from the Raspberry Pi Foundation. The FruxePi has been tested using the 8MP Camera Module v2 (2016).|

Sensors and relays can be activated or deactivated easily and at anytime using the dashboard.

---

## Easy Install
Quickly deploy the FruxePi application using Docker and the installation script. 

### Clone Project
Clone the FruxePi repository to your Raspberry Pi.

```
git clone https://github.com/fruxefarms/FruxePi.git
cd FruxePi
```

### Configure Timezone
Edit the `docker/Dockerfile` using a text editor and change the timezone environment variable to reflect your region.

```
ENV TZ=Europe/Amsterdam
```
[List of tz database time zones](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones)

### Run Installation Script
Run the `install.sh` script to quickly install Docker, Docker Compose and some other installation dependencies.

```
sudo bash install.sh
```

#### Manual Installation
Besides the Docker container installation, the FruxePi can also be manually installed and configured by following these [instructions](#manual-installation).

### Launch App
Visit `http://<your-raspi-ip-address>:80/` in your browser to launch the FruxePi dashboard and login with the default credentials.

**Default Login**

```
Username: hello@fruxe.co 
Password: password
``` 

>[**How do I find my Raspberry Pi's IP address?**](https://learn.adafruit.com/adafruits-raspberry-pi-lesson-3-network-setup/finding-your-pis-ip-address)

---

## Built With
This project was built with the assistance of the following libraries and tools:

### Raspberry Pi
* [Adafruit DHT Sensor Library](https://github.com/adafruit/Adafruit_Python_DHT) - Python library to read the DHT series of humidity and temperature sensors on the Raspberry Pi.
* [Wiring Pi](http://wiringpi.com/download-and-install/) - GPIO Interface library for the Raspberry Pi.
* [Pillow](https://github.com/python-pillow/Pillow) - The friendly Python Imaging Library fork.

### Back-End
* [Codeigniter](https://codeigniter.com/) - PHP web framework.
* [Ion Auth](http://benedmunds.com/ion_auth/) - Ion Auth is a simple and lightweight authentication library for the CodeIgniter framework.
* [PyMySQL](https://github.com/PyMySQL/PyMySQL) - A pure-Python MySQL client library.
* [Docker](https://www.docker.com/) - Containerized LAMP stack.
* [Docsify](https://docsify.js.org/#/) - A magical documentation site generator.

### Front-End
* [Bootstrap](https://getbootstrap.com/) - The world's most popular HTML, CSS, and JS front-end component library.
* [Bootstrap Datepicker](https://github.com/uxsolutions/bootstrap-datepicker) - A flexible datepicker widget in the Bootstrap style.
* [jQuery Timepicker](https://jonthornton.github.com/jquery-timepicker/) - A lightweight, customizable javascript timepicker plugin.
* [Chart.js](http://www.chartjs.org/) - Simple yet flexible JavaScript charting for designers & developers.

---

## Version 

**frx-pi-v0.2-BETA**

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/fruxefarms/FruxePi/tags). 

---

## License

This project is released under **GPL 3.0**. 
>You are free to use, copy, distribute and transmit this software for non-commercial purposes. 

Read the [LICENSE](https://github.com/fruxefarms/FruxePi/blob/master/LICENSE.md) for details in full. 

---

## Acknowledgments

* Teamwork makes the dream work. Big shout out to all the FruxePi contributors. It's really great working on this together!
* The seed of thought. Thanks to the **RaspiViv Project** for the inspiration and early confidence in making this project work. 
* Big thanks to all the master growers for sharing their earthly wisdom.
* Finally, a humble bow to the Raspberry Pi community. We owe a huge thank you to anyone who tinkered, tweaked or destroyed their Pi and were kind enough to share their story.

---

## About Fruxe
We are a collective of programmers and master growers. Our goal is to develop open-source software and hardware to automate indoor agriculture. 

[fruxe.co/about](https://fruxe.co/about)