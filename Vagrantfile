# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.define "kyeol-composer" do |node|
    node.vm.box = "ubuntu/focal64"
    node.vm.hostname = "kyeol-composer"
    node.vm.network "private_network", ip: "192.168.60.12"
    node.vm.provider "virtualbox" do |vb|
      vb.name = "kyeol-composer"
      vb.cpus = 1
      vb.memory = 1024
    end

    node.vm.provision "file", source: "~/.gitconfig", destination: ".gitconfig"
    node.vm.provision "file", source: "~/.ssh/id_rsa", destination: ".ssh/"
    node.vm.provision "file", source: "~/.ssh/id_rsa.pub", destination: ".ssh/"
    node.vm.provision "file", source: "./.env", destination: ".env"
  end

end
