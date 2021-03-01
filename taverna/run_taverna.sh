#!/bin/sh
set -e

## resolve links - $0 may be a symlink
prog="$0"

## hardcode the file path
realprog="/app/taverna-workbench-core-2.5.0/run_taverna.sh"
taverna_home="/app/taverna-workbench-core-2.5.0/"
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