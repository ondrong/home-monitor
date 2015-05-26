#!/bin/bash

DEST="/run/shm/snap2.jpg"

rm $DEST
n=0

until [ $n -ge 5 ]
do
 echo "Attempting to take a snapshot - #"$n
 ls $DEST && break
 fswebcam -r 640x480 -d /dev/video0 -v $DEST
 n=$[$n+1]
 sleep 5
done
