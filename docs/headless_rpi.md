# Headless Raspberry Pi setup + FruxePi install
A short guide on how to set up a headless Raspberry Pi to run the FruxePi application.

## Download latest Raspian release
Download the [latest version](https://www.raspberrypi.org/downloads/raspbian/) of Raspbian.

- Latest FruxePi Tested OS Version: Raspbian Stretch Lite (November 2018)

## Write the Raspian disk image to the SD card
Download and install [Etcher](https://www.balena.io/etcher/) to write the Raspian OS disk image to your SD card.

After installion is complete, insert your SD card into your card reader and open Etcher.

![Write Disk Image](img/etcher_install.png?raw=true)

Click "Select image" and locate the Raspbian OS image .zip file you previously downloaded. 

In the next step, select the SD card you wish to write to.

Finally, click "Flash!" to write the OS image to the SD card. 

## Configure WiFi Connection
To configure the WiFi connection locate the `boot` volume which was created on the SD card. 

Next we will create a file in the root directory of the SD card "boot" volume that will instruct the Raspberry Pi on how to connect to the local WiFi network and provide the necessary security credentials.

### Create wpa_supplicant.conf file

#### MacOS
```
cd /Volumes/boot
nano wpa_supplicant.conf 
```

#### Linux \ Ubuntu
```
cd /media/$USER/boot/
nano wpa_supplicant.conf
```

### Edit wpa_supplicant.conf file

After creating the `wpa_supplicant.conf` file, copy and paste the following text into the file and amend the fields accordingingly:

- `country`
- `ssid`
- `psk`


```
ctrl_interface=DIR=/var/run/wpa_supplicant GROUP=netdev
update_config=1
country=US
network={
    ssid="WiFiNetwork"
    psk="WiFiPassw0rd"
}
```
Save and exit the file using CTRL-X, Y, and Enter.

During the initial boot Raspbian will replace this file on the OS partition. The Raspberry Pi will then use these settings to connect to the specified WiFi network.

## Enable SSH

SSH (Secure Shell) allows you to access the command line of a Raspberry Pi remotely from another computer or device on the same network using SSH.

A simple way to accomplish this is to add a file named SSH to the root of the `boot` partition on your SD card. 

```
touch SSH
```

## Boot up Raspberry Pi and connect over SSH

Now you can insert the SD card into your Raspberry Pi and power the device on. After the device has booted up, connect over SSH using the default Raspberry Pi user credentials below:

- **User** pi
- **Default Password** raspberry

Connect using the following command in the Terminal and amend the IP address. If you do not know the IP address of your Raspberry Pi, follow this helpful guide.

```
ssh pi@192.168.X.X
```
Afterward you will be prompted for the default password, `raspberry`.

## Change Default Password

After successfully connecting over SSH, change the default password for the `pi` user.

```
pi@raspberrypi:~ $ passwd
Changing password for pi.
(current) UNIX password: 
Enter new UNIX password: 
Retype new UNIX password: 
passwd: password updated successfully
```

<!-- ## Add your SSH Key to your Raspberry Pi for login -->

## Install Docker

The FruxePi uses Docker as a means of standardization and allows us to deliver a predictable build across a broad range of devices, with minimal configuration headaches.

Installing Docker on the Raspberry Pi is very simple:

```
curl -ssl https://get.docker.com | sh
```

Once the install is complete, next add the current user to the docker user group.

```
sudo usermod -a -G docker $USER
```

## Install docker-compose

Install docker-compose which is a tool for defining and running multi-container Docker applications.

Install the python-pip repository:

```
sudo apt-get -y install python-pip
```

Using pip, now install docker-compose:

```
sudo pip install docker-compose
```

## Download FruxePi
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

## Run Installation Script

Run `sudo bash install.sh` to quickly install the FruxePi application.

![FruxePi Install](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/fruxepi_install.gif?raw=true)

To view the install process in the Terminal use `sudo bash install.sh -log`.

---

## Launch FruxePi in browser
![Launch FruxePi](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/fruxepi_login.gif?raw=true)

After successful deployment, visit `http://<your-raspi-ip-address>:80/` in your browser to launch the FruxePi dashboard and login with the default credentials.

#### Default Login
**User:** hello@fruxe.co 
<br/>**Pass:** password 

