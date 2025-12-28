FROM alpine:latest

RUN apk update
RUN apk upgrade

RUN apk add --no-cache php php-mysqli php-curl php-json php-session


WORKDIR /opt/veselica

COPY . .

# Set environment variable for Apache
#RUN mkdir -p /etc/apache2/conf-enabled

#RUN echo 'SetEnv DB_HOST ${DB_HOST}' >> /etc/apache2/conf-enabled/environment.conf
#RUN echo 'SetEnv DB_USER ${DB_USER}' >> /etc/apache2/conf-enabled/environment.conf
#RUN echo 'SetEnv DB_PASS ${DB_PASS}' >> /etc/apache2/conf-enabled/environment.conf
#RUN echo 'SetEnv DB_NAME ${DB_NAME}' >> /etc/apache2/conf-enabled/environment.conf

# autostart
#RUN rc-update add apache2 default

EXPOSE 80

ENTRYPOINT [ "php", "-S", "0.0.0.0:80"]
