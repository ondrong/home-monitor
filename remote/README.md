# web interface for home-monitor

You have already seen how it looks, so without further ado let's get to it. The content of this directory goes to your remote web hosting. Any web server should do really provided it supports PHP. However I use .htaccess files hence it is Apache for me.

## directory structure

### web-root
The root folder in your webhosting, perhaps called public_html.

### banana
This is the actual directory where the magic happens and it contains the actual html/php/js part of home-monitor. Why is it called banana then? Cause as I've already mentionted I run local part of the home-monitor on BananaPi and initial codename for this repository was banana-monitor. :-)

### timelapse
The web interface for so called DVR part of home-monitor which allows to watch archived videos generated from the webcams.

## requirements

* PHP (my webhost used 5.x)
* MySQL (at least two or three tables)
* FTP accesss to the webhost
* Google Drive account for spreasdsheets/forms
* PHP Cron for google based chart creation and caching

## usage

If you have your webhost running and accessible via http://your.host.net, you will have these URL's working:

* Main Google Drive based charts on /
* Home-monitor interface on /banana
* Timelapse DVR on /timelapse

Provided .htaccess files allow only certain IP addresses to access these pages, so you might want to keep it that way to make sure nobody else is looking at your stuff ;-)
