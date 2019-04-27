## Easy Install
Quickly deploy the FruxePi application using Docker and the installation script. 

### Step 1: Download FruxePi Project
Clone the FruxePi repository to your Raspberry Pi or download the ZIP file.

#### Clone Github repository
```
git clone https://github.com/fruxefarms/FruxePi.git
cd FruxePi
```

#### Download ZIP
```
wget https://github.com/fruxefarms/FruxePi/archive/master.zip
unzip master.zip
cd FruxePi-master
```

---

### Step 2: Run Installation Script

Run `sudo bash install.sh` to quickly install Docker, Docker Compose and some other installation dependencies.

![FruxePi Install](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/fruxepi_install.gif?raw=true)

To view the install process in the Terminal use `sudo bash install.sh -log`.

---

### Step 3: Launch App
![Launch FruxePi](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/fruxepi_login.gif?raw=true)

After successful deployment, visit `http://<your-raspi-ip-address>:80/` in your browser to launch the FruxePi dashboard and login with the default credentials.

#### Default Login
**User:** hello@fruxe.co 
<br/>**Pass:** password 

---

### Headless Raspberry Pi setup + FruxePi install
A [short guide](headless_rpi.md) on how to setup a headless Raspberry Pi (No monitor, mouse or keyboard) to run the FruxePi. This guide will take you through flashing Raspian to disk, configuring your WiFi connection, enabling SSH and installing the FruxePi application. 

---

### Manual installation
For ease of use across all Raspberry Pi models and platforms, we suggest running the Docker installer.

However, for those that wish to tinker and tweak their FruxePi, [these instructions](manual_install.md) will assist you to install the application and configure the LAMP stack (Apache, PHP, and MySQL) and install Python dependencies on your Raspberry Pi.