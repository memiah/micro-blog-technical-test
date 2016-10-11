# -*- mode: ruby -*-
# vi: set ft=ruby :
Vagrant.configure(2) do |config|
  config.vm.box = "geerlingguy/centos7"

  config.vm.provider "virtualbox" do |vb|
    vb.memory = "1024"
    vb.linked_clone = true
  end

  config.vm.synced_folder ".", "/sites", create: true, mount_options: ['dmode=0777', 'fmode=0776']
  
  config.ssh.forward_agent = true

  config.vm.define "origin" do |org|

    org.vm.hostname = "origin"
    org.vm.network :private_network, ip: "192.168.100.120"

    # Uncomment this option if you wish to run vagrant on a different host to your development machine and need to access it over the network
    # If you do this, you will also have to make the microblog.dev entry in your hosts file point at the external host IP  
    # org.vm.network "forwarded_port", guest: 80, host: 8080, gateway_ports: true, host_ip: "*"
    
    org.vm.provision "ansible" do |ansible|
      ansible.playbook = "site.yml"
      ansible.verbose = "vv"
    end

  end
end
