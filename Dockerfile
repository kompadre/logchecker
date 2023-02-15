FROM php:7.4.33-apache-bullseye

RUN apt-get update && apt-get install python3 pip -y && \
pip3 install cchardet eac-logchecker xld-logchecker && \
apt-get clean autoclean && \
apt-get autoremove --yes && \
rm -rf /var/lib/{apt,dpkg,cache,log}/ 

RUN a2enmod ssl

COPY logchecker.phar /opt/logchecker.phar
COPY src/index.php /var/www/html/index.php
COPY src/favicon.ico /var/www/html/favicon.ico
COPY config/ssl/srv3-cert.pem /etc/ssl/srv3-cert.pem
COPY config/ssl/srv3-fullchain.pem /etc/ssl/srv3-fullchain.pem
COPY config/ssl/srv3-privkey.pem /etc/ssl/srv3-privkey.pem
COPY config/000-default.conf /etc/apache2/sites-available/000-default.conf