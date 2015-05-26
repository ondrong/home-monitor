# welcome to home-monitor
A little surveillance tool for monitoring what is going around your house... or spying on your neighbor.

### preface

This is the main repo. Other repositories are optional and simply add more functionality to this tool.

And yes, I know user interface is both in english and some foreign language you probably never heard of. Personally I do *not* find it distracting and it's up to you to translate to whatever language you wish.

## what it does

- displays pictures from your webcams
- shows current temperature inside or outside your house
- draws neat temperature line charts of various periods of time (day, week, month)
- performs a livelihood test on your network devices by pinging a defined array of IP's
- shows your external IP (no need to use dyndns anymore)
- displays some other useful information (from other tools from this GIT such as wifi-player)

## how it looks

If everything is setup and configured the right way, you might expect to see something along the lines of this (certain personal data has been redacted):

![banana_info](https://cloud.githubusercontent.com/assets/12605057/7808582/fade089c-039c-11e5-9d86-2cceef768348.jpg)

## how it works

Basically it's an array of three scheduled scripts to be run from cron/systemd.

* The main script gets executed every 15 minutes
* The ping-check script is executed every hour
* The video-timelapse script run every morning at 3AM

## requirements

- PHP/MySQL web hosting account with FTP access and some free space. You might want from a few MB to *infinity* depending whether you want to use video-timelapse and how big of an archive to keep.
- Stable power line and reliable internet connection at your house.
- A device with Linux, BSD, MacOS to run the home-monitor scripts. I'm using ArchLinux on BananaPi, so be prepared to edit the scripts according to the platform of your choice.
- A bunch of photo cameras, webcams, network IP cams or whatever device you have that allows picture to be taken from.
- Some digital temperature sensors you might have lying around somewhere. I use Dallas DS18B20 via 1-wire interface and a cheap chinese USB device called Temper.
