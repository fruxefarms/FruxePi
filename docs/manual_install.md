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
After installing phpMyAdmin, you will be presented with the package configuration screen.

Press TAB to highlight `OK` and use your **SPACEBAR** to select `apache2`. Finally, hit **ENTER**.

![phpMyAdmin Setup Step 1](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/phpmyadmin-step_01.png?raw=true)

The installation process will continue until you’re back at the next package configuration screen.

Select `Yes` and then hit **ENTER** at the dbconfig-common screen.

![phpMyAdmin Setup Step 2](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/phpmyadmin-step_02.png?raw=true)

You will be prompted to enter the database admin password.

Upon entry, hit **TAB** to highlight `OK` and then press **ENTER**.

![phpMyAdmin Setup Step 3](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/phpmyadmin-step_03.png?raw=true)

Next, enter a password for the phpMyAdmin application itself.

![phpMyAdmin Setup Step 4](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/phpmyadmin-step_04.png?raw=true)

Confirm the phpMyAdmin application password.

![phpMyAdmin Setup Step 5](https://github.com/fruxefarms/FruxePi/blob/master/docs/img/phpmyadmin-step_05.png?raw=true)

You must restart Apache for these changes to take affect.

```
sudo service apache2 restart
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

#### Installing Climate Sensor, MySQL and Camera Dependencies
Install the following packages and modules from the command line using `pip`:

```
sudo pip install pymysql pillow
```

#### Install Adafruit DHT library
```
sudo apt-get install build-essential python-dev
git clone https://github.com/adafruit/Adafruit_Python_DHT.git
cd Adafruit_Python_DHT/
python setup.py install
```

#### Installing WiringPi
Install WiringPi to your `home/` directory or preferred destination.
```
cd ~
git clone git://git.drogon.net/wiringPi
cd wiringPi
git pull origin
sudo ./build
```

### Configuration

Once the application has been installed please check that the following settings have been set appropriately.

#### Configure Database

Ensure that these database credentials match your MYSQL user authorization. 

**Codeigniter Config**
</br>Open the Codeigniter `database.php` config file in the `/html/app/application/config/` folder:

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
</br>Open the FruxePi CLI Python file `fruxepi.py` in the `/html/app/actions/` folder and make sure that the following fields are set properly with your MYSQL database credentials.

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
0 * * * * python /var/www/html/actions/fruxepi.py update -chart
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