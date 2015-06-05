cd /tmp/

fin="/tmp/snapp6.jpg"
fout="/tmp/snap6.jpg"

rm $fin $fout 2>/dev/null
wget "http://192.168.1.209:8080/?action=snapshot" -O $fin > /dev/null 2>&1

timestamp=$(date +"%F %R")

convert $fin -fill white -undercolor '#00000080' -gravity SouthWest \
 -font Bitstream-Vera-Sans -pointsize 16 -annotate +5+10 " $timestamp " $fout > /dev/null 2>&1

rm $fin
