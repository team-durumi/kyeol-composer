#!/bin/bash
echo "[os]"
lsb_release -a

echo "[house keeping]"
apt-get -y -qq update && apt-get -y -qq upgrade && apt-get -y -qq autoremove
timedatectl set-timezone Asia/Seoul && date

echo "install rclone"
curl https://rclone.org/install.sh | sudo bash
echo 'user_allow_other' | tee -a /etc/fuse.conf
mkdir -p /data/kyeol && chown -R vagrant:vagrant /data
ln -s /data/kyeol/files /vagrant/web/sites/default/files
