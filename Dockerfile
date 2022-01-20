FROM php:apache-buster

RUN apt-get update && apt-get -y install inkscape
RUN mkdir -p /var/ww/.config/inkscape
RUN chmod a+rw /var/www/ -R

COPY script.php /var/www/html
COPY input.svg /var/www/html
