# Taverna Docker version

1. Install `xquartz`
`brew install --cask xquartz`  
2. Launch XQuartz, select preference, go to security tab, check `Allow connections from network clients`  
3. Set Host Machine IP
`IP=$(ifconfig en0 | grep inet | awk '$1=="inet" {print $2}')`, then eho `$IP`  
4. Add IP access control list
`xhost + $IP`
# Build the image  
`docker build -t ken/test-taverna-jdk8 .`

# Get into the terminal
`docker run --rm -it ken/test-taverna-jdk8`  
- java version: 
```bash
openjdk version "1.8.0_275"
OpenJDK Runtime Environment (build 1.8.0_275-8u275-b01-0ubuntu1~18.04-b01)
OpenJDK 64-Bit Server VM (build 25.275-b01, mixed mode)

```
- JAVA_HOME: `/usr/lib/jvm/java-8-openjdk-amd64/`  

# Run the image
`docker run --rm -p 5000:5000 -e DISPLAY=172.20.10.75:0 ken/test-taverna-jdk8`

```bash
OpenJDK 64-Bit Server VM warning: ignoring option MaxPermSize=200m; support was removed in 8.0
Exception from method net.sf.taverna.raven.launcher.Launcher.main(String[])
java.awt.AWTError: Can't connect to X11 window server using '172.20.10.75:0' as the value of the DISPLAY variable.
        at sun.awt.X11GraphicsEnvironment.initDisplay(Native Method)
        at sun.awt.X11GraphicsEnvironment.access$200(X11GraphicsEnvironment.java:65)
        at sun.awt.X11GraphicsEnvironment$1.run(X11GraphicsEnvironment.java:115)
        at java.security.AccessController.doPrivileged(Native Method)
        at sun.awt.X11GraphicsEnvironment.<clinit>(X11GraphicsEnvironment.java:74)
        at java.lang.Class.forName0(Native Method)
        at java.lang.Class.forName(Class.java:264)
        at java.awt.GraphicsEnvironment.createGE(GraphicsEnvironment.java:103)
        at java.awt.GraphicsEnvironment.getLocalGraphicsEnvironment(GraphicsEnvironment.java:82)
        at java.awt.Window.initGC(Window.java:475)
        at java.awt.Window.init(Window.java:495)
        at java.awt.Window.<init>(Window.java:537)
        at java.awt.Frame.<init>(Frame.java:420)
        at java.awt.Frame.<init>(Frame.java:385)
        at javax.swing.JFrame.<init>(JFrame.java:189)
        at net.sf.taverna.raven.SplashScreen.<init>(SplashScreen.java:109)
        at net.sf.taverna.raven.SplashScreen.<init>(SplashScreen.java:105)
        at net.sf.taverna.raven.SplashScreen.getSplashScreen(SplashScreen.java:88)
        at net.sf.taverna.raven.launcher.Launcher.prepareSplashScreen(Launcher.java:225)
        at net.sf.taverna.raven.launcher.Launcher.launchMain(Launcher.java:127)
        at net.sf.taverna.raven.launcher.Launcher.main(Launcher.java:64)
        at sun.reflect.NativeMethodAccessorImpl.invoke0(Native Method)
        at sun.reflect.NativeMethodAccessorImpl.invoke(NativeMethodAccessorImpl.java:62)
        at sun.reflect.DelegatingMethodAccessorImpl.invoke(DelegatingMethodAccessorImpl.java:43)
        at java.lang.reflect.Method.invoke(Method.java:498)
        at net.sf.taverna.raven.prelauncher.PreLauncher.runLauncher(PreLauncher.java:115)
        at net.sf.taverna.raven.prelauncher.PreLauncher.launchArgs(PreLauncher.java:69)
        at net.sf.taverna.raven.prelauncher.PreLauncher.main(PreLauncher.java:47)

```

# Reference
1. [openjdk-8-jdk](https://hub.docker.com/r/picoded/ubuntu-openjdk-8-jdk/dockerfile/)
2. [docker-java-ssh-x-forward](https://github.com/Pozo/docker-java-ssh-x-forward)
3. [taverna-workbench](https://github.com/mohsensoori/taverna-workbench)
4. [vnc_startup](https://github.com/ConSol/docker-headless-vnc-container/blob/master/src/common/scripts/vnc_startup.sh)
5. [Running X11 GUI + XQuartz](https://gist.github.com/dahlia/4e8dc41ff29a86d08790589ca6f66174)
6. [x11_docker_mac](https://gist.github.com/cschiewek/246a244ba23da8b9f0e7b11a68bf3285)
7. [Gui application docker and Mac](https://sourabhbajaj.com/blog/2017/02/07/gui-applications-docker-mac/)
8. [Docker for Mac and GUI applications](https://fredrikaverpil.github.io/2016/07/31/docker-for-mac-and-gui-applications/)
