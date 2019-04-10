# FruxePi OPEN-PROTOTYPE v0.2-BETA
A browser-based dashboard to monitor and automate indoor agriculture using the Raspberry Pi.

![FruxePi Dashboard](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/screenshot-frame.png?raw=true)


***PLEASE NOTE:** This version of the FruxePi is still under development and in prototype. Our goal is to make this application effortless to deploy and run on your Raspberry Pi. However, until we get all the bugs worked out, this project may require the knowledge of an advanced Pi user. Nonetheless, if you are keen on this project and are having issues deploying FruxePi, please create an issue explaining your problem or contact <hello@fruxe.co>.*

Quick Links
=================

   * [Overview](https://docs.fruxe.co/#/?id=fruxepi-overview)
   * [Features](https://docs.fruxe.co/#/?id=what-can-it-do)
   * [Requirements](https://docs.fruxe.co/#/requirements)
   * [Easy Install](https://docs.fruxe.co/#/install?id=easy-install)
   * [Documentation](https://docs.fruxe.co)
   * [Help](https://docs.fruxe.co/#/help)
   * [License](https://docs.fruxe.co/#/?id=license)
   * [About](https://docs.fruxe.co/#/about)

---

## FruxePi Overview

The FruxePi is a web application running on a LAMP stack (Linux, Apache, MySQL, PHP) which can be accessed from the browser on your local network. The application collects grow data from a variety of sensors and controls various operations such as lighting, ventilation and watering, using relay modules.

### Dashboard Demo
**URL:**  https://demo.fruxe.co/
</br>**User:**  demo@fruxe.co
</br>**Pass:**  password


### Features

Using the browser-based dashboard, users can easily monitor the status of their growing environment and automate certain tasks. 

**The basic functionalies of the FruxePi include:**

- Monitor your growing climate (temperature and humidity).
- Chart visualizations for historical temperature and humidity data.
- Manage crops by tracking progress and time to harvest.
- Monitor soil moisture.
- Camera monitoring with periodic and manual photo capture.
- Manual and scheduled lighting control.
- Fan control both manually and exception based (temperature or humidity thresholds).
- Watering pump control and daily automation.
- User authentication and management.
- Track daily activity using blog-like journal.

---

## What parts will I need?

The FruxePi runs on the RaspberryPi using several sensors and relays:

|Part|Description|
| ------------- | ------------- |
|![Raspberry Pi](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/raspberrypi.png?raw=true) | **Raspberry Pi**<br/> The FruxePi has been tested and runs well on the following models running Raspian:<br/>- Raspberry Pi 3 Model B <br/>- Raspberry Pi Model Zero W |
|![Climate Sensor](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/climate_sensor.png?raw=true) | **Climate Sensor**<br/> The DHT22 is a basic digital temperature and humidity sensor. It uses a capacitive humidity sensor and a thermistor to measure the surrounding air, and spits out a digital signal on the data pin, no analog input pins needed.|
|![Moisture Probe](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/moisture_sensor.png?raw=true)  | **Moisture Probe**<br/> The TE215 moisture probe is sensitive to ambient humidity and is used to detect the moisture content of the soil or growing medium. The module outputs a HIGH or LOW value when the the soil humidity exceeds a set threshold value. |
|![Relay Module](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/relay.png?raw=true)|**5V Relay Modules**<br/> 5V Relay Modules are a great way to control high current and high voltage devices directly from the Raspberry Pi.|
|![Camera](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/camera.png?raw=true)|**Raspberry Pi Camera**<br/> The Raspberry Pi Camera Module is the official camera product from the Raspberry Pi Foundation. The FruxePi has been tested using the 8MP Camera Module v2 (2016).|

Please see the [full list](https://docs.fruxe.co/#/requirements) of requirements and further information regarding each component.

---

## Easy Install
Quickly deploy the FruxePi application using Docker and the installation script.

### Step 1: Clone Project
Clone the FruxePi repository to your Raspberry Pi or download the [ZIP](https://github.com/fruxefarms/FruxePi/archive/master.zip) file.

```
git clone https://github.com/fruxefarms/FruxePi.git
cd FruxePi
```
---

### Step 2: Run Installation Script

Run `sudo bash install.sh` to quickly install the application as well as Docker, Docker Compose and some other installation dependencies.

![FruxePi Install](docs/img/fruxepi_install.gif?raw=true)


#### Manual Installation
Besides the Docker installation, the FruxePi can also be manually installed and configured by following these [instructions](https://docs.fruxe.co/#/install?id=manual-installation-1). Good luck! 

---

### Step 3: Launch App

Launch the application from your browser and login!

![Launch FruxePi](/docs/img/fruxepi_login.gif)

After successful deployment, visit `http://<your-raspi-ip-address>:80/` in your browser to launch the FruxePi dashboard and login with the default credentials below:

#### Default Login
**User:** hello@fruxe.co 
<br/>**Pass:** password 


---

## Built With
This project was built with the assistance of the following libraries and tools:

### Raspberry Pi
* [Adafruit DHT Sensor Library](https://github.com/adafruit/Adafruit_Python_DHT) - Python library to read the DHT series of humidity and temperature sensors on the Raspberry Pi.
* [Wiring Pi](http://wiringpi.com/download-and-install/) - GPIO Interface library for the Raspberry Pi.
* [Pillow](https://github.com/python-pillow/Pillow) - The friendly Python Imaging Library fork.
* [PyMySQL](https://github.com/PyMySQL/PyMySQL) - A pure-Python MySQL client library.

### Back-End
* [Codeigniter](https://codeigniter.com/) - PHP web framework.
* [Ion Auth](http://benedmunds.com/ion_auth/) - Ion Auth is a simple and lightweight authentication library for the CodeIgniter framework.
* [Docker](https://www.docker.com/) - Containerized LAMP stack.
* [Balena](https://github.com/balena-io-library/base-images) - Raspberry Pi compatible Docker base images.
* [Docsify](https://docsify.js.org/#/) - A magical documentation site generator.

### Front-End
* [Bootstrap](https://getbootstrap.com/) - The world's most popular HTML, CSS, and JS front-end component library.
* [Bootstrap Datepicker](https://github.com/uxsolutions/bootstrap-datepicker) - A flexible datepicker widget in the Bootstrap style.
* [jQuery Timepicker](https://jonthornton.github.com/jquery-timepicker/) - A lightweight, customizable javascript timepicker plugin.
* [Chart.js](http://www.chartjs.org/) - Simple yet flexible JavaScript charting for designers & developers.
* [Font Awesome](https://fontawesome.com/) - The world's most popular and easiest to use icon set.

---

## Version 

### frx-pi-v0.2-BETA
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
We are a collective of programmers and master growers. Our goal is to develop open-source software and low-cost hardware to automate indoor agriculture.

[fruxe.co/about](https://fruxe.co/about)