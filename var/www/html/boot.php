#!ipxe

echo +----- NETBOOT ----------------------------------------------
echo |hostname: ${hostname}, next-server: ${next-server}
echo |mac.....: ${net0/mac} /
echo +------------------------------------------------------------
echo

<?php

  openlog("netboot", LOG_PID | LOG_PERROR, LOG_SYSLOG);

  $cldlog="10.255.3.2";
  $master="10.255.3.2";

  $hostname = $_GET['hostname'];
  $mac = $_GET['mac'];
  $testmac = "a0:36:9f:f2:bb:02";
  $newmac = "a0:36:9f:e7:6a:e2";
  syslog(LOG_ERR, "Boot request: $hostname - $mac");

  #$console = "tty0";
  $console="ttyS1,115200n8r console=tty0";
  $cmdline = "modules=loop,squashfs quiet nomodeset";
  $default_cmdline = "default";
  $start_sshd = "yes";
  $branch = "v3.11.6";
  $version = "3.11.6";
  $flavor = "lts";
  $mirror = "http://$master/alpine";
  $arch = "x86_64";
  $imgurl = "$mirror/$branch/releases/$arch/netboot-$version";
  $repourl = "$mirror/$branch/main";
  $sshkey = "KEY";
  $modloopurl = "$imgurl/modloop-$flavor";
  $vmlinuzurl = "$imgurl/vmlinuz-$flavor";
  $initramurl = "$imgurl/initramfs-$flavor";
  $rootflags = "size=6G";
  $pkgs="bonding,coreutils,vlan,rsyslog,monit,net-tools,irqbalance,iproute2,redis,rtpengine,kamailio,kamailio-redis,kamailio-dbtext,htop,joe,ngrep,sudo,telegraf,chrony";
  $apkovl="apkovl=http://$master/boot-config/{MAC}/config.tar.gz";
  #$apkovl="";

  syslog(LOG_ERR, "Boot Alpine request: $vmlinuzurl - Flavor: $flavor - Moodloop: $modloopurl, Initramfs: $initramurl,  apkovl=$apkovl\n");
  #echo "kernel $vmlinuzurl $cmdline alpine_repo=$repourl pkgs=$pkgs modloop=$modloopurl modules=loop,squshfs,igb,e1000e ip=10.255.3.13:10.255.3.253:10.255.3.1:255.255.255.0:dproxy3.fra:eth4: console=$console $sshkey\n";
  echo "kernel $vmlinuzurl $cmdline alpine_repo=$repourl pkgs=$pkgs ssh_key=yes modloop=$modloopurl rootflags=$rootflags  modules=loop,squshfs,igb,e1000e ip=dhcp::::dproxy3.fra:eth4: console=$console $apkovl\n";
  echo "initrd $initramurl\n";

  closelog();
?>
boot
