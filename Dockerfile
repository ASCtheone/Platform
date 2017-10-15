FROM williamyeh/ansible:alpine3

COPY config/ssh /root/.ssh

RUN chmod 600 /root/.ssh/*

RUN mkdir -p /srv/documentation /srv/service /srv/spa

WORKDIR /etc/ansible/env/lab
