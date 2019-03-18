# FruxePi OPEN-PROTOTYPE v0.2-BETA
A browser-based dashboard to monitor and automate indoor agriculture using the Raspberry Pi.

![FruxePi Dashboard](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/screenshot-frame.png?raw=true)


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

### Configure Timezone
Edit the `docker/Dockerfile` using a text editor:

```
sudo nano docker/Dockerfile
```

Change the timezone environment variable to reflect your region.

```
ENV TZ=Europe/Amsterdam
```
[List of tz database time zones](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones)

### Run Installation Script
Run the `install.sh` script to quickly install Docker, Docker Compose and some other installation dependencies.

```
sudo bash install.sh
```

>**Manual Installation:** Besides the Docker container installation, the FruxePi can also be manually installed and configured by following these [instructions](#manual-installation).

### Launch App
Visit `http://<your-raspi-ip-address>:80/` in your browser to launch the FruxePi dashboard.

> **How do I find my Pi's IP address?**
<br>[Check out the following link](https://learn.adafruit.com/adafruits-raspberry-pi-lesson-3-network-setup/finding-your-pis-ip-address)

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

- Monitoring growing climate (Temperature and Humidity).
- Chart visualizations for historical temperature and humidity data.
- Manage crops by tracking progress and time to harvest.
- Monitor soil moisture.
- Camera monitoring with periodic and manual photo capture.
- Manual and scheduled lighting control.
- Fan control both manually and exception based (Temperature or Humidity thresholds).
- Watering pump control and daily automation.
- User authentication and management.
---

## Latest Version 

### frx-pi-v0.2-BETA
We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/fruxefarms/FruxePi/tags). 

---

## License

This project is released under **GPL 3.0**. 
>You are free to use, copy, distribute and transmit this software for non-commercial purposes. 

Read the [LICENSE](https://github.com/fruxefarms/FruxePi/blob/master/LICENSE.md) for details in full.
