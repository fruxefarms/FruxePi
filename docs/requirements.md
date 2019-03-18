# Requirements

## What do I need?

The FruxePi runs on the RaspberryPi using several sensors and relays. All sensors and relays are not necessary for basic operation, however, the Climate sensor (DHT22- Temperature\Humidity) is considered a compulsory component and key to the operation of the application.

#### Raspberry Pi
The FruxePi has been tested and runs well on the following models running Raspian: 
- Raspberry Pi 3 Model B
- Raspberry Pi Model Zero W

> [How to Check the Software and Hardware Version of a Raspberry Pi](http://ozzmaker.com/check-raspberry-software-hardware-version-command-line/)

#### Sensors and Relays
The following sensors and relays connect to the Raspberry Pi GPIO board. Although many of these accessories are optional, to get the full experience of the FruxePi application, the Climate Sensor (DHT22) is compulsory. 

Sensors and relays can be activated or deactivated easily and at anytime using the dashboard.

|Part|Description|
| ------------- | ------------- |
|![Climate Sensor](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/climate_sensor.png?raw=true) | **Climate Sensor**<br/> The DHT22 is a basic digital temperature and humidity sensor. It uses a capacitive humidity sensor and a thermistor to measure the surrounding air, and spits out a digital signal on the data pin, no analog input pins needed.|
|![Moisture Probe](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/moisture_sensor.png?raw=true)  | **Moisture Probe**<br/> The TE215 moisture probe is sensitive to ambient humidity and is used to detect the moisture content of the soil or growing medium. The module outputs a HIGH or LOW value when the the soil humidity exceeds a set threshold value. |
|![Relay Module](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/relay.png?raw=true)|**5V Relay Modules**<br/> 5V Relay Modules are a great way to control high current and high voltage devices directly from the Raspberry Pi.|
|![Camera](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/camera.png?raw=true)|**Raspberry Pi Camera**<br/> The Raspberry Pi Camera Module is the official camera product from the Raspberry Pi Foundation. The FruxePi has been tested using the 8MP Camera Module v2 (2016).|
