FROM phusion/baseimage:latest

MAINTAINER Mahmoud Zalt <mahmoud@zalt.me>

ENV DEBIAN_FRONTEND noninteractive
ENV PATH /usr/local/rvm/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin

RUN apt-get update
RUN apt-get install -y beanstalkd
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

VOLUME /var/lib/beanstalkd/data

EXPOSE 11300

# enable bigger job size
# CMD ["/usr/bin/beanstalkd"]
ENTRYPOINT ["/usr/bin/beanstalkd", "-z", "524280"]