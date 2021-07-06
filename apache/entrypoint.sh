#!/bin/bash

# if there's no ssl certificate yet create it
if [ ! -f "/usr/local/apache2/conf/server.crt" ]; then
    openssl req \
        -new \
        -newkey rsa:4096 \
        -days 3650 \
        -nodes \
        -x509 \
        -subj "/C=US/ST=CA/L=SF/O=Docker-demo/CN=totara" \
        -keyout /usr/local/apache2/conf/server.key \
        -out /usr/local/apache2/conf/server.crt
fi

# Replace the remote src variable in the nginx configuration with
# the one defined in the environment variables
cp /usr/local/apache2/conf.d/server.conf /tmp/temp.conf
envsubst '$REMOTE_SRC' < /tmp/temp.conf > /usr/local/apache2/conf.d/server.conf
rm /tmp/temp.conf

# change directory permissions
chmod 02777 $REMOTE_DATA
chown www-data:www-data $REMOTE_DATA
chmod 02777 /shared_files

httpd -D "FOREGROUND" -k start
