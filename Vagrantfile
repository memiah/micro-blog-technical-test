# -*- mode: ruby -*-
# vi: set ft=ruby :
Vagrant.configure(2) do |config|
  config.vm.box = "geerlingguy/centos7"

  config.vm.provider "virtualbox" do |vb|
    vb.memory = "1024"
    vb.linked_clone = true
  end

  config.vm.synced_folder ".", "/sites"
  
  config.ssh.forward_agent = true

  config.vm.define "origin" do |org|
    org.vm.hostname = "origin"
    org.vm.network :private_network, ip: "192.168.100.120"

    org.vm.provision "ansible" do |ansible|
      ansible.playbook = "site.yml"
      ansible.verbose = "vv"
    end
  end
end
