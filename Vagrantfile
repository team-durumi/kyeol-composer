# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/focal64"
  config.vm.network "forwarded_port", guest: 8888, host: 8888, id: "drush-rs"
  config.vm.network "forwarded_port", guest: 80, host: 8080, id: "apache2"
  config.vm.network "private_network", ip: "192.168.39.10"
  config.vm.synced_folder ".", "/vagrant", type: "nfs"

  config.vm.provider "virtualbox" do |vb|
    vb.name = "kyeol-composer"
    vb.cpus = 2
    vb.memory = 2048
    # https://askubuntu.com/a/1273081
    vb.customize [ "modifyvm", :id, "--uartmode1", "file", File::NULL ]
  end

  # Apache/2.4.41
  # PHP 7.3.22
  # 10.3.22-MariaDB
  config.vm.box_check_update = false
  config.vbguest.auto_update = false
  config.vm.provision "shell", path: "provision/bootstrap.sh"
  config.vm.provision "shell", path: "provision/mariadb-10.3.sh"
  config.vm.provision "shell", path: "provision/apache2-php7.3.sh"
  config.vm.provision "shell", path: "provision/rclone.sh", privileged: false
  config.vm.provision "shell", path: "provision/check.sh"
end
