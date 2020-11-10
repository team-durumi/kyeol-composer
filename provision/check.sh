#!/bin/bash
tput setaf 2; echo '#1 [OS]'; tput sgr0;
lsb_release -a
tput setaf 2; echo '#2 [disk]'; tput sgr0;
df -h | grep /dev/sda1
tput setaf 2; echo '#3 [apache2]'; tput sgr0;
apache2 -v
apache2ctl -M
tput setaf 2; echo '#4 [php7.4]'; tput sgr0;
php -v
php -m
php -i | grep "timezone"
php -i | grep "memory_limit"
tput setaf 2; echo '#5 [mariadb]'; tput sgr0;
mysql -V
tput setaf 2; echo '#6 [rclone]'; tput sgr0;
rclone version
sudo service apache2 start