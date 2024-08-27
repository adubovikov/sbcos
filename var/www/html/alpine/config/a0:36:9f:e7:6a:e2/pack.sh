#!/bin/sh

echo "Copying config...."

MAC=a0:36:9f:e7:6a:e2
HOST=sbc1.dc1

cp /var/www/html/config/repositories ./etc/apk/
cp /var/www/html/config/rsyslog.conf ./etc/


if [ ! -d "/var/www/html/boot-config/${MAC}" ]; then
  mkdir -p /var/www/html/boot-config/${MAC}
  ln -s /var/www/html/boot-config/${MAC} /var/www/html/boot-config/${HOST}
fi
    
echo "Packing config...."
tar czf /var/www/html/boot-config/${MAC}/config.tar.gz etc home usr
read -p "Done.... press something...." name


    
    
    