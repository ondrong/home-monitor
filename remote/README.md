# web interface for home-monitor

You have already seen how it looks, so without further ado let's get to it.

## directory structure

* *web-root* is, well, just that - the root folder in your webhosting.
* *banana* is the actual directory where the magic happens and it contains the actual html/php/js part of home-monitor. Why is it called banana then? Cause as I've already mentionted I run local part of the home-monitor on BananaPi and initial codename for this repository was banana-monitor. :-)

## requirements

* PHP (my webhost used 5.x)
* MySQL (at least two or three tables)
* FTP accesss to the webhost
* Google Drive account for spreasdsheets/forms
* PHP Cron for google based chart creation and caching
