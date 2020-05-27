printf '\x21\x01\x00' > /dev/hidraw0
sleep 2
printf '\x21\x00\x00' > /dev/hidraw0

