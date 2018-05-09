FROM ubuntu:16.04

MAINTAINER Le Phat <lethanhphat0208@gmail.com>

ARG DEBIAN_FRONTEND=noninteractive

#Update OS
RUN apt-get -y update; \
    apt-get install apt-utils -y; \
    apt-get -y upgrade; \
    apt-get dist-upgrade

RUN apt-get -y install gcc g++ git

#Install apache
RUN apt-get -y install apache2 \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

#Install php
RUN apt-get -y install php7.0 libapache2-mod-php7.0 php7.0-opcache php-apcu php7.0-cli php7.0-dev libmecab-dev build-essential

RUN /etc/init.d/apache2 restart

COPY library/mecab-0.996.tar.gz /tmp
COPY library/mecab-ipadic-2.7.0-20070801.tar.gz /tmp

RUN cd /tmp; \
tar zxfv mecab-0.996.tar.gz && cd mecab-0.996; \
./configure --with-charset=utf8 --enable-utf8-only && make && make install

RUN ldconfig

RUN cd /tmp; \
tar zxfv mecab-ipadic-2.7.0-20070801.tar.gz && cd mecab-ipadic-2.7.0-20070801; \
./configure --with-charset=utf-8 && make && make install

RUN cd /tmp && git clone https://github.com/skvadrik/re2c.git re2c; \
cd /tmp/re2c/re2c && ./autogen.sh && ./configure && make && make install; \
cd /tmp && git clone https://github.com/rsky/php-mecab.git && cd /tmp/php-mecab/mecab; \
phpize && ./configure --with-php-config=/usr/bin/php-config --with-mecab=/usr/local/bin/mecab-config && make && make install

RUN cd /etc/php/7.0/mods-available/ && touch mecab.ini \
&& echo "extension=mecab.so" | tee -a mecab.ini && phpenmod -v 7.0 mecab

RUN /etc/init.d/apache2 restart

RUN mkdir /usr/local/lib/mecab/dic/ipadic/mecabDic

WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT ["apachectl", "-D", "FOREGROUND"]
