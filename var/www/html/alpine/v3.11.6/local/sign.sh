cp abuild.tgz .
tar xzvf abuild.tgz
cp .abuild
cp alpine-devel\@mycompany.com-5ebeaeee.rsa /etc/apk/keys/
apk index -o /repo/x86_64/APKINDEX.unsigned.tar.gz /repo/x86_64/*.apk
apk index -o  /repo/v3.11.6/local/x86_64/APKINDEX.unsigned.tar.gz /repo/v3.11.6/local/x86_64/*.apk
cp /repo/v3.11.6/local/x86_64/APKINDEX.unsigned.tar.gz /repo/v3.11.6/local/x86_64/APKINDEX.tar.gz
abuild-sign -k /root/.abuild/alpine-devel@mycompany.com-5ebeaeee.rsa /repo/v3.11.6/local/x86_64/APKINDEX.tar.gz
