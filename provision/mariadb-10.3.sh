#!/bin/bash

echo "[mariadb] add 10.3 repository"
apt-key adv --fetch-keys 'https://mariadb.org/mariadb_release_signing_key.asc'
add-apt-repository 'deb [arch=amd64,arm64,ppc64el] https://ftp.harukasan.org/mariadb/repo/10.3/ubuntu focal main'

echo "[mariadb] install 10.3"
export DEBIAN_FRONTEND=noninteractive
echo "mariadb-server-10.3 mysql-server/root_password password root" | debconf-set-selections
echo "mariadb-server-10.3 mysql-server/root_password_again password root" | debconf-set-selections
apt-get install -y -qq mariadb-server

echo "[mariadb] create user and database"
mysql --password=root -e "CREATE DATABASE kyeol CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql --password=root -e "GRANT ALL ON kyeol.* TO vagrant@localhost IDENTIFIED BY 'vagrant'; FLUSH PRIVILEGES;"

cp /vagrant/provision/config/my.cnf /home/vagrant/.my.cnf
chown vagrant:vagrant /home/vagrant/.my.cnf

FILE=/vagrant/dump/1103.sql.gz
if [ -f "$FILE" ]; then
    echo "[mariadb] $FILE exists and restoring kyeol database..."
    gunzip -c $FILE | mysql kyeol --password=root
else
    echo "[mariadb] $FILE does not exist."
fi
