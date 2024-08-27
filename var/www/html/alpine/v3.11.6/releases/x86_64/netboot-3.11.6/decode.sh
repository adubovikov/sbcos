

unsquashfs -l /boot/modloop-hardened (to explore what will get mounted to /.modloop)
gzip -dc /boot/initramfs-hardened | cpio -it (to explore the initramfs contents)
sudo qemu-system-x86_64 -m 512M -enable-kvm -kernel  ipxe.lkrn 

https://access.redhat.com/solutions/24029


zcat /boot/initrd-$(uname -r).img | cpio -idmv

find . | cpio -o -c | gzip -9 > /boot/new.img