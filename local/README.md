# local part of home-monitor
The content of this directory must be installed locally on some linux device you have at home running 24/7. I use Banana Pi single board computer for this purpose.

## directory structure

* bin - /usr/local/bin
* home - /home/bananapi
* systemd - /etc/systemd/system
* raspberry - a few scripts running on the Raspberry Pi board (ds18b20 sensor and creative webcam)

## enabling services

Remember, I run them on ArchLinux so I'm using systemd here. So for example do this for homemonitor schedule timer:

```
sudo systemctl enable homemonitor.timer
sudo systemctl start homemonitor.timer
```

And do exactly the same for the other two timers. Debian based disto users might want to use cron instead. 

## getting webcam pictures

You might be curious where is the part responsible for taking photos from the webcam. It's right there in homemonitor shell script. :-) I also included the script I use for taking a picture from one of my cams (Logitech C210). No reason to include all of them since chances are you might never have the same setup I use.

## additional information

The source for temper USB device is also included. It's written in C and calibrated against good old DS18B20 sensor to make that little device as accurate as possible.