FROM php:7.0-apache

RUN docker-php-ext-install mysqli

COPY ./src /var/www/html
RUN chmod 755 /var/www/html

RUN chmod -R o+r /var/www/html/*
RUN chmod -R o+rx /var/www/html/img /var/www/html/images /var/www/html/assets /var/www/html/js /var/www/html/assets/js /var/www/html/assets/css /var/www/html/assets/vendor/bootstrap/css /var/www/html/assets/vendor/icofont /var/www/html/imgsellingproduct /var/www/html/imgproduct && chmod 644 /var/www/html/.htaccess

# RUN echo "" >> /var/ww/html/assets/.htaccess
# RUN chmod 644 /var/www/html/assets/.htaccess 
# RUN chmod 755 /var/www/html/