# welcome to home-monitor
A little surveillance tool for monitoring what is going around your house... or spying on your neighbor.

### preface

This is the main repo. Other repositories are optional and simply add more functionality to this tool.

And yes, I know user interface is both in english and some foreign language you probably never heard of. Personally I do *not* find it distracting and it's up to you to translate to whatever language you wish.

## what it does

- displays pictures from your webcams
- allows you to rewind today's pictures
- provides full fledged DVR like system for all your cams
- shows current temperature inside or outside your house
- draws neat temperature line charts of various periods of time (day, week, month)
- performs a livelihood test on your network devices by pinging a defined array of IP's
- shows your external IP (no need to use dyndns anymore)
- displays some other useful information (from other tools from this git such as wifi-player)

## how it looks

If everything is setup and configured the right way, you might expect to see something along the lines of this (certain personal data has been redacted):

![main1](https://cloud.githubusercontent.com/assets/12605057/7812346/10857b9a-03ba-11e5-8b6f-8e3b9cffd6af.jpg)

![banana_info](https://cloud.githubusercontent.com/assets/12605057/7808582/fade089c-039c-11e5-9d86-2cceef768348.jpg)

![main2](https://cloud.githubusercontent.com/assets/12605057/7812347/108cc800-03ba-11e5-83e9-014ae8205eca.jpg)

![rewind](https://cloud.githubusercontent.com/assets/12605057/7990391/64ad42de-0af9-11e5-85a3-5de4f33a345f.jpg)

![timelapse](https://cloud.githubusercontent.com/assets/12605057/7812493/541e0c04-03bb-11e5-9635-afdd67052452.jpg)

## how it works

Basically it's an array of three scheduled scripts to be run from cron/systemd.

* The main script gets executed every 15 minutes and captures pictures from the cameras, inserts temperatures into database table and gathers all the required information
* The ping-check script is executed every hour and checks if network attached devices are alive around the house (routers, STB's, access points etc.)
* The video-timelapse script runs every morning at 3AM, downloads yesterday's cam pics and makes mp4 video for each of your cams.

## requirements

- PHP/MySQL web hosting account with FTP access and some free space. You might want from a few MB to *infinity* depending whether you want to use video-timelapse and how big of an archive to keep.
- Stable power line and reliable internet connection at your house.
- A device with Linux, BSD, MacOS to run the home-monitor scripts. I'm using ArchLinux on BananaPi, so be prepared to edit the scripts according to the platform of your choice.
- A bunch of photo cameras, webcams, network IP cams or whatever device you have that allows picture to be taken from.
- Some digital temperature sensors you might have lying around somewhere. I use Dallas DS18B20 via 1-wire interface and a cheap chinese USB device called Temper.

## bundled stuff

- jQuery javascript framework
- Chartist javascript chart-library
- mBox library for light-box effect

## installation

* Clone the repo 
* Put the files where they need to be
* Pray it works

Unfortunately I don't really have time nor am I willing to provide step by step installation tutorial. However, I'm pretty sure there are lots of smart and curious people who will build something even better and bigger based upon my code. So go download/clone/fork *home-monitor* and have some fun with it!

## my setup

If anyone is interested here's my current setup:

* BananaPi runs the home-monitor scripts and has Logitech webcam and Temper connected to its USB ports
* Raspberry Pi has Dallas DS18B20 1wire sensor connected via it's GPIO and also has Creative webcam
* Bunch of different routers running Oleg/Gorgoyle/DD-WRT/OpenWRT/Tomato third-party firmwares installed on them. Full list can be found on [wiki](https://github.com/gedasm/home-monitor/wiki) page.

