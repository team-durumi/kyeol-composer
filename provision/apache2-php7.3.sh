#!/bin/bash

echo "Install apache2, php 7.3"
yes | apt-add-repository ppa:ondrej/php
apt-get install -y -qq zip unzip apache2 php7.3-{apcu,cli,gd,xml,curl,mbstring,zip,opcache,mysql,fpm}
a2enmod rewrite proxy_fcgi && a2enconf php7.3-fpm

echo "[php] set config"
cp /vagrant/provision/config/php-dev.ini /etc/php/7.3/cli/conf.d/
cp /vagrant/provision/config/php-dev.ini /etc/php/7.3/fpm/conf.d/
echo 'php_admin_value[error_log] = /vagrant/fpm-php.www.log' >> /etc/php/7.3/fpm/pool.d/www.conf

echo "[apache2] add vagrant virtualhost"
cp /vagrant/provision/config/vagrant.conf /etc/apache2/sites-available/
a2dissite 000-default && a2ensite vagrant && service apache2 reload

echo "[php] install composer"
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
composer selfupdate 1.10.17

echo "[php] install drush launcher"
wget -O drush.phar https://github.com/drush-ops/drush-launcher/releases/latest/download/drush.phar
chmod +x drush.phar && mv drush.phar /usr/local/bin/drush
chown -R vagrant:vagrant /usr/local/bin

echo "[php] composer install"
su - vagrant -c "cd /vagrant && composer install"
chmod +w /vagrant/web/sites/default/
su - vagrant -c "cp -r /vagrant/provision/config/*.php /vagrant/web/sites/default"
rm -rf /vagrant/web/sites/default/files/
ln -s /data/kyeol/files /vagrant/web/sites/default/
