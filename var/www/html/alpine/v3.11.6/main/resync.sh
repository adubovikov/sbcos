#!/usr/bin/env sh

# make sure we never run 2 rsync at the same time
lockfile="/tmp/alpine-mirror.lock"
if [ -z "$flock" ] ; then
  exec env flock=1 flock -n $lockfile "$0" "$@"
fi

src=rsync://rsync.alpinelinux.org/alpine/v3.11/main/x86_64
dest=/var/www/html/alpine/v3.11.6/main/x86_64

# uncomment this to exclude old v2.x branches
#exclude="--exclude='*'"
#--include='v3.11/main/x86_64' \
#$exclude \

mkdir -p "$dest"
/usr/bin/rsync \
        --archive \
        --update \
        --hard-links \
        --delete \
        --delete-after \
        --delay-updates \
        --timeout=600 \
        "$src" "$dest"
