-- FruxePi OPEN-PROTOTYPE DEVELOPMENT v0.1
-- DB: frx_DEV 

-- TABLE: activity
DROP TABLE IF EXISTS activity;

CREATE TABLE activity (
    id INT PRIMARY KEY AUTO_INCREMENT,
    cropID VARCHAR(255) NOT NULL,
    date_time VARCHAR(255) NOT NULL,
    activity_type VARCHAR(255) NOT NULL,
    msg VARCHAR(255) NOT NULL
);

-- TEST DATA: activity
INSERT INTO activity
    (cropID, date_time, activity_type, msg) 
VALUES
    ('FRX-CR0001', '21-11-2017 11:11:00','Alert','Temperature is too hot!'),
    ('FRX-CR0001', '21-11-2017 12:11:00','Update','Lights turned ON!'),
    ('FRX-CR0001', '21-11-2017 20:11:00','Update','Lights turned OFF!'),
    ('FRX-CR0001', '21-11-2017 20:11:00','Journal','Watch for pests'),
    ('FRX-CR0001', '21-11-2017 20:11:00','Journal','Transplanted some plants'),
    ('FRX-CR0001', '21-11-2017 20:11:00','Journal','Added nutrition to plants');


-- TABLE: climate_threshold
DROP TABLE IF EXISTS climate_threshold;

CREATE TABLE climate_threshold (
    id INT PRIMARY KEY AUTO_INCREMENT,
    temp_MIN VARCHAR(255) NOT NULL,
    temp_MAX VARCHAR(255) NOT NULL,
    humid_MIN VARCHAR(255) NOT NULL,
    humid_MAX VARCHAR(255) NOT NULL
);

-- TEST DATA: climate_threshold
INSERT INTO climate_threshold
    (temp_MIN, temp_MAX, humid_MIN, humid_MAX) 
VALUES
    ('15', '40','20','99');



-- TABLE: crops
DROP TABLE IF EXISTS crops;

CREATE TABLE crops (
    id INT NOT NULL AUTO_INCREMENT,
    cropID VARCHAR(255) NOT NULL,
    users VARCHAR(255) NOT NULL,
    nickname VARCHAR(255) NOT NULL,
    plant_qty INT(10),
    plant_type VARCHAR(255) NOT NULL,
    crop_start VARCHAR(255),
    crop_end VARCHAR(255),
    date_created VARCHAR(255) NULL,
    date_modified VARCHAR(255) NULL,
    PRIMARY KEY (id)
);

-- TEST DATA: crops
INSERT INTO crops 
    (cropID, users, nickname, plant_qty, plant_type, crop_start, crop_end, date_created, date_modified)
VALUES
    ('FRX-CR0001', 1,'Big Harvest', 5, 'Italian Basil', '05-09-2018', '21-11-2018', '05-09-2018 11:11:11', '05-09-2018 11:11:11');


-- TABLE: technical
DROP TABLE IF EXISTS technical;

CREATE TABLE technical (
    id INT PRIMARY KEY AUTO_INCREMENT,
    module_type VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    gpio_pin VARCHAR(255),
    enabled TINYINT(1)
);

-- TEST DATA: technical
INSERT INTO technical 
    (module_type, description, gpio_pin, enabled)
VALUES
    ('Sensor','Climate Sensor', 2, 1),
    ('Sensor','Moisture Probe', 17, 0),
    ('Relay','Light Controls', 15, 0),
    ('Relay','Fan Controls', 18, 0),
    ('Relay','Pump Controls', 19, 0),
    ('Camera','Camera Module', 0, 0);


-- TABLE: light_schedule
DROP TABLE IF EXISTS light_schedule;

CREATE TABLE light_schedule (
    id INT NOT NULL AUTO_INCREMENT,
    event_name VARCHAR(255) NULL,
    process VARCHAR(255) NULL,
    process_id VARCHAR(255) NULL,
    lights_ON VARCHAR(255) NULL,
    lights_OFF VARCHAR(255) NULL,
    PRIMARY KEY (id)
);

-- TEST DATA: light_schedule
INSERT INTO light_schedule 
    (event_name, process, process_id, lights_ON, lights_OFF)
VALUES
    ('Lights','Light Controls','lights','11:11','23:11');

-- TABLE: pump_schedule
DROP TABLE IF EXISTS pump_schedule;

CREATE TABLE pump_schedule (
    id INT NOT NULL AUTO_INCREMENT,
    event_name VARCHAR(255) NULL,
    process VARCHAR(255) NULL,
    process_id VARCHAR(255) NULL,
    pump_ON VARCHAR(255) NULL,
    pump_duration VARCHAR(255) NULL,
    PRIMARY KEY (id)
);

-- TEST DATA: pump_schedule
INSERT INTO pump_schedule 
    (event_name, process, process_id, pump_ON, pump_duration)
VALUES
    ('Pump','Pump Controls','pump','11:11','5');

-- TABLE: fan_schedule
DROP TABLE IF EXISTS fan_schedule;

CREATE TABLE fan_schedule (
    id INT NOT NULL AUTO_INCREMENT,
    event_name VARCHAR(255) NULL,
    process VARCHAR(255) NULL,
    process_id VARCHAR(255) NULL,
    fan_temp_threshold VARCHAR(255) NULL,
    fan_humid_threshold VARCHAR(255) NULL,
    fan_duration VARCHAR(255) NULL,
    PRIMARY KEY (id)
);

-- TEST DATA: fan_schedule
INSERT INTO fan_schedule 
    (event_name, process, process_id, fan_temp_threshold, fan_humid_threshold, fan_duration)
VALUES
    ('Fan','Fan Controls','fan','33','99','5');

-- TABLE: grow_data
DROP TABLE IF EXISTS grow_data;

CREATE TABLE grow_data (
    id INT NOT NULL AUTO_INCREMENT,
    date_time DATETIME NOT NULL,
    temperature VARCHAR(255) DEFAULT NULL,
    humidity VARCHAR(255) DEFAULT NULL,
    light_status VARCHAR(255) NULL,
    moisture_status VARCHAR(255) NULL,
    fan_status VARCHAR(255) NULL,
    pump_status VARCHAR(255) NULL,
    PRIMARY KEY (id)
);

-- TEST DATA: grow_data
INSERT INTO grow_data
    (date_time, temperature, humidity, light_status, moisture_status, fan_status, pump_status)
VALUES
    ('2018-10-18 00:00:00', 25, 75, True, True, True, False),
    ('2018-10-18 01:00:00', 27, 88, True, True, True, False),
    ('2018-10-18 02:00:00', 26, 84, True, True, True, False),
    ('2018-10-18 03:00:00', 26, 80, True, True, True, False),
    ('2018-10-18 04:00:00', 25, 77, True, True, True, False),
    ('2018-10-18 05:00:00', 26, 78, True, True, True, False),
    ('2018-10-18 06:00:00', 25, 75, True, True, True, False),
    ('2018-10-18 07:00:00', 27, 76, True, True, True, False),
    ('2018-10-18 08:00:00', 28, 80, True, True, True, False),
    ('2018-10-18 09:00:00', 25, 75, True, True, True, False),
    ('2018-10-18 10:00:00', 27, 81, True, True, True, False),
    ('2018-10-18 11:00:00', 28, 84, True, True, True, False),
    ('2018-10-18 12:00:00', 28, 83, True, True, True, False),
    ('2018-10-18 13:00:00', 28, 82, True, True, True, False),
    ('2018-10-18 14:00:00', 29, 88, True, True, True, False),
    ('2018-10-18 15:00:00', 30, 90, True, True, True, False),
    ('2018-10-18 16:00:00', 25, 75, True, True, True, False),
    ('2018-10-18 17:00:00', 25, 80, True, True, True, False),
    ('2018-10-18 18:00:00', 25, 79, True, True, True, False),
    ('2018-10-18 19:00:00', 25, 78, True, True, True, False),
    ('2018-10-18 20:00:00', 24, 77, True, True, True, False),
    ('2018-10-18 21:00:00', 24, 74, True, True, True, False),
    ('2018-10-18 22:00:00', 22, 73, True, True, True, False),
    ('2018-10-18 23:00:00', 23, 72, True, True, True, False);


-- TABLE: climate_history
DROP TABLE IF EXISTS climate_history;

CREATE TABLE climate_history (
    id INT NOT NULL AUTO_INCREMENT,
    date_time DATETIME NOT NULL,
    temperature VARCHAR(255) DEFAULT NULL,
    humidity VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (id)
);

-- TEST DATA: climate_history
INSERT INTO climate_history
    (date_time, temperature, humidity)
VALUES
    ('2018-10-18 00:00:00', 25, 75),
    ('2018-10-18 01:00:00', 27, 88),
    ('2018-10-18 02:00:00', 26, 84),
    ('2018-10-18 03:00:00', 26, 80),
    ('2018-10-18 04:00:00', 25, 77),
    ('2018-10-18 05:00:00', 26, 78),
    ('2018-10-18 06:00:00', 25, 75),
    ('2018-10-18 07:00:00', 27, 76),
    ('2018-10-18 08:00:00', 28, 80),
    ('2018-10-18 09:00:00', 25, 75),
    ('2018-10-18 10:00:00', 27, 81),
    ('2018-10-18 11:00:00', 28, 84),
    ('2018-10-18 12:00:00', 28, 83),
    ('2018-10-18 13:00:00', 28, 82),
    ('2018-10-18 14:00:00', 29, 88),
    ('2018-10-18 15:00:00', 30, 90),
    ('2018-10-18 16:00:00', 25, 75),
    ('2018-10-18 17:00:00', 25, 80),
    ('2018-10-18 18:00:00', 25, 79),
    ('2018-10-18 19:00:00', 25, 78),
    ('2018-10-18 20:00:00', 24, 77),
    ('2018-10-18 21:00:00', 24, 74),
    ('2018-10-18 22:00:00', 22, 73),
    ('2018-10-18 23:00:00', 23, 72);


-- TABLE: groups
DROP TABLE IF EXISTS groups;

CREATE TABLE groups (
    id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    description VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

-- TEST DATA: groups
INSERT INTO groups
    (id, name, description)
VALUES
     (1,'admin','Administrator'),
     (2,'members','General User');


-- TABLE: users
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT(11) unsigned NOT NULL AUTO_INCREMENT,
    ip_address VARCHAR(45) NOT NULL,
    username VARCHAR(100) NULL,
    password VARCHAR(255) NOT NULL,
    salt VARCHAR(255) DEFAULT NULL,
    email VARCHAR(254) NOT NULL,
    activation_code VARCHAR(40) DEFAULT NULL,
    forgotten_password_code VARCHAR(40) DEFAULT NULL,
    forgotten_password_time INT(11) unsigned DEFAULT NULL,
    remember_code VARCHAR(40) DEFAULT NULL,
    created_on INT(11) unsigned NOT NULL,
    last_login INT(11) unsigned DEFAULT NULL,
    active tinyint(1) unsigned DEFAULT NULL,
    first_name VARCHAR(50) DEFAULT NULL,
    last_name VARCHAR(50) DEFAULT NULL,
    PRIMARY KEY (id)
);

-- TEST DATA: users
INSERT INTO users 
    (id, ip_address, username, password, salt, email, activation_code, forgotten_password_code, created_on, last_login, active, first_name,last_name)
VALUES
    ('1','127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','hello@fruxe.co','',NULL,'1268889823','1268889823','1', 'Admin','istrator');


-- TABLE: users_groups
DROP TABLE IF EXISTS users_groups;

CREATE TABLE users_groups (
    id INT(11) unsigned NOT NULL AUTO_INCREMENT,
    user_id INT(11) unsigned NOT NULL,
    group_id mediumint(8) unsigned NOT NULL,
    PRIMARY KEY (id),
    KEY fk_users_groups_users1_idx (user_id),
    KEY fk_users_groups_groups1_idx (group_id),
    CONSTRAINT uc_users_groups UNIQUE (user_id, group_id),
    CONSTRAINT fk_users_groups_users1 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE NO ACTION,
    CONSTRAINT fk_users_groups_groups1 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE ON UPDATE NO ACTION
);

-- TEST DATA: users_groups
INSERT INTO users_groups
    (id, user_id, group_id)
VALUES
    (1,1,1),
    (2,1,2);


-- TABLE: login_attempts
DROP TABLE IF EXISTS login_attempts;

CREATE TABLE login_attempts (
    id INT(11) unsigned NOT NULL AUTO_INCREMENT,
    ip_address VARCHAR(45) NOT NULL,
    login VARCHAR(100) NOT NULL,
    time INT(11) unsigned DEFAULT NULL,
    PRIMARY KEY (id)
);