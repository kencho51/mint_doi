# Taverna Server Docker

# Build the image
`docker image build -t test-taverna-jdk8 .`

# Run the image
`docker run -p 5000:5000 -e DISPLAY=unix$DISPLAY test-taverna-jdk8`

```bash
OpenJDK 64-Bit Server VM warning: ignoring option MaxPermSize=200m; support was removed in 8.0
Exception from method net.sf.taverna.raven.launcher.Launcher.main(String[])
java.awt.AWTError: Can't connect to X11 window server using 'unix' as the value of the DISPLAY variable.
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