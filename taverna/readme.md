# Taverna Docker version

## Pre-requisites
0. Download source binary file to the root directory

1. Install `xquartz` ans `socat`  
`brew install --cask xquartz`  
`brew install socat`

2. Launch XQuartz, select preference, go to security tab, check `Allow connections from network clients`  
3. Start the TCP listen:  
`socat TCP-LISTEN:6000,reuseaddr,fork UNIX-CLIENT:\"$DISPLAY\"`  
If `socat[73221] E bind(5, {LEN=0 AF=2 0.0.0.0:6000}, 16): Address already in use`
    - ` lsof -n -i | grep 6000` and `kill -9` the process  
    
### taverna script
```bash
#!/bin/sh

set -e

## resolve links - $0 may be a symlink
prog="$0"

real_path() {
    readlink -m "$1" 2>/dev/null || python -c 'import os,sys;print os.path.realpath(sys.argv[1])' "$1"
}

realprog=`real_path "$prog"`
taverna_home=`dirname "$realprog"`
javabin=java
if test -x "$taverna_home/jre/bin/java"; then
    javabin="$taverna_home/jre/bin/java"
elif test -x "$JAVA_HOME/bin/java"; then
    javabin="$JAVA_HOME/bin/java"
fi

# 32-bit compatible memory settings:
# 700 MB memory, 200 MB for classes
exec "$javabin" -Xmx700m -XX:MaxPermSize=200m \
  "-Draven.profile=file://$taverna_home/conf/current-profile.xml" \
  "-Dtaverna.startup=$taverna_home" \
  "-Dtaverna.dotlocation=$taverna_home/bin/dot.sh" \
  -Djava.system.class.loader=net.sf.taverna.raven.prelauncher.BootstrapClassLoader \
  -Dapple.laf.useScreenMenuBar=true \
  -Dapple.awt.graphics.UseQuartz=false \
  -Dcom.sun.net.ssl.enableECC=false \
  -Djsse.enableSNIExtension=false \
  -Dsun.swing.enableImprovedDragGesture \
  -jar "$taverna_home/lib/"prelauncher-*.jar \
  ${1+"$@"}
```

### Examine the file path created by pyhton
```bash
echo $realprog=`real_path "$prog"`  
`/app/taverna-workbench-core-2.5.0/taverna.sh`  
echo $taverna_home=`dirname "$realprog"`  
`/app/taverna-workbench-core-2.5.0/`
```

## Build the image  
`docker build -t ken/test-taverna-jdk8 .`

## Get into the terminal for background checking
`docker run --rm -it ken/test-taverna-jdk8`  
- java version: 
```bash
openjdk version "1.8.0_275"
OpenJDK Runtime Environment (build 1.8.0_275-8u275-b01-0ubuntu1~18.04-b01)
OpenJDK 64-Bit Server VM (build 25.275-b01, mixed mode)

```
- JAVA_HOME: `/usr/lib/jvm/java-8-openjdk-amd64/`  


## Run the image
1. Start the TCP listen:  
`socat TCP-LISTEN:6000,reuseaddr,fork UNIX-CLIENT:\"$DISPLAY\"`  
2. Get IP of network interface for host OS  
`ifconfig en0`  
3. Run the container 
`docker run --rm -p 5000:5000 -e DISPLAY=172.20.10.75:0 ken/test-taverna-jdk8`

## Result
![img.png](screenshot.png)

## Reference
1. [openjdk-8-jdk](https://hub.docker.com/r/picoded/ubuntu-openjdk-8-jdk/dockerfile/)
2. [docker-java-ssh-x-forward](https://github.com/Pozo/docker-java-ssh-x-forward)
3. [taverna-workbench](https://github.com/mohsensoori/taverna-workbench)
4. [vnc_startup](https://github.com/ConSol/docker-headless-vnc-container/blob/master/src/common/scripts/vnc_startup.sh)
5. [Running X11 GUI + XQuartz](https://gist.github.com/dahlia/4e8dc41ff29a86d08790589ca6f66174)
6. [x11_docker_mac](https://gist.github.com/cschiewek/246a244ba23da8b9f0e7b11a68bf3285)
7. [Gui application docker and Mac](https://sourabhbajaj.com/blog/2017/02/07/gui-applications-docker-mac/)
8. [Docker for Mac and GUI applications](https://fredrikaverpil.github.io/2016/07/31/docker-for-mac-and-gui-applications/)
9. [Running GUI’s with Docker on Mac OS X](https://cntnr.io/running-guis-with-docker-on-mac-os-x-a14df6a76efc)
10. [socat not working on OSX](https://bitsanddragons.wordpress.com/2020/06/05/address-already-in-use-socat-not-working-on-osx/)
11. [Official taverna site](http://www.taverna.org.uk/download/workbench/2-5/core/#download-binary) 