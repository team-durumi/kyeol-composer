#!/bin/bash

echo "[rclone] install latest"
curl https://rclone.org/install.sh | sudo bash
echo 'user_allow_other' | sudo tee -a /etc/fuse.conf

echo "[rclone] set config and mount"
if [ -z $RCLONE_MOUNT_POINT ]; then 
    RCLONE_MOUNT_POINT='/data/kyeol/files'
    sudo mkdir -p $RCLONE_MOUNT_POINT && sudo chown -R vagrant:vagrant /data
fi

if [ -z $DRUPAL_FILE_DIR ]; then
    DRUPAL_FILE_DIR='/vagrant/web/sites/default/files'
fi
if [ -z $RCLONE_SOURCE ]; then 
    RCLONE_SOURCE='drive:files'
fi
if [ -z $RCLONE_CONFIG ]; then
    RCLONE_CONFIG='/vagrant/dump/rclone.conf'
    if [ -f $RCLONE_CONFIG ]; then
        mkdir -p ~/.config/rclone/
        cp $RCLONE_CONFIG ~/.config/rclone/
        echo 'rclone mount '"$RCLONE_SOURCE"' '"$RCLONE_MOUNT_POINT"' --allow-other --daemon -vvv'
        rclone mount "$RCLONE_SOURCE" "$RCLONE_MOUNT_POINT" --allow-other --daemon -vvv
        chmod +w /vagrant/web/sites/default
        # ln -s "$RCLONE_MOUNT_POINT" "$DRUPAL_FILE_DIR"
        df -h && ls -alh $DRUPAL_FILE_DIR
    fi
fi
