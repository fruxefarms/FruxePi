### Connecting Sensors and Relays to GPIO pins
Please be aware that there are multiple ways of referring to the pins on the Raspberry Pi GPIO board. When connecting peripherals to the Raspberry Pi please refer to the pins by their GPIO names, this is known as BCM naming (Broadcom Pin Number). A handy reference for pin numbering can be accessed on the Raspberry Pi by opening a terminal window and running the command `pinout` or check out [pinout.xyz](https://pinout.xyz/) which is another great visual tool.

You may connect the peripherals using any configuration you wish, however, the FruxePi application uses these pins as default. Pins can easily be changed from the dashboard when enabling or disabling peripherals. 

#### Climate Sensor

|DHT22|GPIO|Directions|
| ------------- | ------------- | ------------- |
|![Climate Sensor](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/climate_sensor.png?raw=true)|![Climate Sensor Pinout](img/climate_pinout.png?raw=true) | **Climate Sensor**<br/> Connect the DHT22 sensor using the following GPIO pin configuration:<br/>- VCC / + (3v3 Power - Physical pin 1)<br/>- Ground / - (Physical pin 9)<br/>- Out (Physical pin 3)|

#### Moisture Probe

|TE215|GPIO|Directions|
| ------------- | ------------- | ------------- |
|![Moisture Probe](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/moisture_sensor.png?raw=true)|![Moistrure Probe Pinout](img/moisture_pinout.png?raw=true) | **Moisture Probe**<br/> Connect the TE215 moisture probe using the following GPIO pin configuration:<br/>- VCC / + (3v3 Power - Physical pin 17)<br/>- Ground / - (Physical pin 20)<br/>- Out (Physical pin 18)|

#### Relay Modules

The FruxePi uses a 5V 3-channel relay to control the lights, fans and water pump, which are connected to their respective AC power plug. Relays can be connected in any configuration (1/2/3 channel.    

For many, this is step arguably the trickiest part of setting up the FruxePi. A power strip controlled by the Raspberry Pi is a common project found online and many tutorials are available which can offer guidance on how to wire a relay power outlet appropriately. A few tutorials we found particularly helpful were:

- [Web Controlled 8-Channel Powerstrip](https://www.instructables.com/id/Web-Controlled-8-Channel-Powerstrip/)

> It goes without saying, but for some reason we still have it say it. Please be careful and exercise the utmost caution when working with high voltage electricity. Err on the side of caution and get some help if you're confused or lost in the process. Let's all be safe people! 

|Relay|GPIO|Directions|
| ------------- | ------------- | ------------- |
|![Relay Module](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/relay.png?raw=true)|![Relay Module Pinout](img/relay_pinout.png?raw=true) | **Relay Modules**<br/> Connect the relay module using the following GPIO pin configuration:<br/>- VCC / + (5v Power - Physical pin 4)<br/>- Ground / - (Physical pin 6)<br/>- CH1 (Lights) (Physical pin 8) <br/>- CH2 (Fans) (Physical pin 10) <br/>- CH3 (Pumps) (Physical pin 12)|

---

#### Enable Sensors & Relays

Enabling and disabling sensors is easy from the dashboard using the slide toggle.

![Enable Sensor](img/fruxepi_enablesensor.gif?raw=true)

You may also run the diagnostics function to test if the peripherals are connected properly.