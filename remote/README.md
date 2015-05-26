# web interface for home-monitor

You have already seen how it looks, so without further ado let's get to it.

## directory structure

* *web-root* is, well, just that - the root folder in your webhosting.
* *banana* is the actual directory where the magic happens and it contains the actual html/php/js part of home-monitor. Why is it called banana then? Cause as I've already mentionted I run local part of the home-monitor on BananaPi and initial codename for this repository was banana-monitor. :-)
* *timelapse* is the web interface for so called DVR part of home-monitor which allows to watch archived videos generated from the webcams.

## requirements

* PHP (my webhost used 5.x)
* MySQL (at least two or three tables)
* FTP accesss to the webhost
* Google Drive account for spreasdsheets/forms
* PHP Cron for google based chart creation and caching

## usage

If you have your webhost running and accessible via http://your.host.net, you will URL's working:

* Main Google based chart on /
* Home-monitor interface on /banana
* Timelapse DVR on /timelapse

Provided .htaccess allows only certain IP addresses to access these pages, so you might want to keep it that way to make sure nobody else is looking at your stuff ;-)
