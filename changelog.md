# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [frx-pi-v0.4-BETA] - 2019-10-08
PRE-RELEASE: Initial BETA release of open prototype for public testing.

### Improvements
 - Continued work and improvements to installation and upgrade bash script.
 - Added `robots.txt` file to stop bot indexing.
 - As always, more documentation!

### Fixes
 - Fixed delete user 404 error
 - Fixed WiringPi repository error which failed installation.

## [frx-pi-v0.3-BETA] - 2019-04-29
PRE-RELEASE: Initial BETA release of open prototype for public testing.

### What's New
 - Toggle Celsius or Fahrenheit temperature formats.
 - Upload a crop thumbnail or use the camera as your thumbnail image.
 - Take a current photo from the Dashboard.
 - Added support for relay types with active high or active low.
 - Easier upgrades with `update.sh` bash script.

### Improvements
 - Continued work and improvements to installation script.
 - Docker support for armv6 architecture (RPI Zero).
 - Improved [documentation](https://docs.fruxe.co) hub hosted with GitHub Pages and built using [Docsify](https://docsify.js.org/#/).

### Fixes
 - CRON fixes and scheduling bugs.
 - Bad data fix on humidity sensor.
 - Fan program and triggering fix.
 - Relay related functions had many errors and dead ends that have been remedied.

## [frx-pi-v0.2-BETA] - 2019-03-18
PRE-RELEASE: Initial BETA release of open prototype for public testing.

### What's New
 - Much easier deployment process using installation script. (We admit, our previous install process sucked.)

### Improvements
 - Dockerized deployment allows for greater compatibility across all Raspberry Pis.
 - Improved documentation with many errors and omissions corrected. Many thanks to the keen eyes of some helpful FruxePi users!

### Fixes
 - Set user timezone
 - Chart updates properly
 - Lots of documentation fixes (sorry folks).
 - Many small errors, tweaks and bug fixes.

## [frx-pi-v0.1-BETA] - 2018-11-07
PRE-RELEASE: Initial BETA release of open prototype for public testing.

[frx-pi-v0.1-BETA]: https://github.com/fruxefarms/FruxePi/releases/tag/frx-pi-v0.1-BETA
[frx-pi-v0.2-BETA]: https://github.com/fruxefarms/FruxePi/releases/tag/frx-pi-v0.2-BETA
[frx-pi-v0.3-BETA]: https://github.com/fruxefarms/FruxePi/releases/tag/frx-pi-v0.3-BETA
[frx-pi-v0.4-BETA]: https://github.com/fruxefarms/FruxePi/releases/tag/frx-pi-v0.4-BETA
