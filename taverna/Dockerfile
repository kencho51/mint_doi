FROM ubuntu:18.04
MAINTAINER Ken Cho

RUN apt-get update && \
    apt-get install -y && \
    apt-get install graphviz -y && \
    apt-get install wget unzip vim -y && \
    apt-get install lsb-release -y

WORKDIR /app

# Install Java
RUN apt-get update && \
	apt-get install -y openjdk-8-jdk && \
	apt-get install -y ant && \
	apt-get clean && \
	rm -rf /var/lib/apt/lists/* && \
	rm -rf /var/cache/oracle-jdk8-installer;

RUN apt-get update && \
    apt-get install -y ca-certificates-java && \
    apt-get clean && \
    update-ca-certificates -f && \
    rm -rf /var/lib/apt/lists/* && \
    rm -rf /var/cache/oracle-jdk8-installer;

ENV JAVA_HOME /usr/lib/jvm/java-8-openjdk-amd64/
RUN export JAVA_HOME

WORKDIR /app/Desktop

### Install Taverna Workbench
RUN wget https://bitbucket.org/taverna/taverna-workbench-product/downloads/taverna-workbench-core-2.5.0-standalone.zip
RUN unzip taverna-workbench-core-2.5.0-standalone.zip
RUN rm taverna-workbench-core-2.5.0-standalone.zip
RUN mv /app/Desktop/taverna-workbench-core-2.5.0/ /app/Desktop/taverna-workbench/
RUN chmod +x /app/Desktop/taverna-workbench/taverna.sh
RUN ln -s /app/Desktop/taverna-workbench/taverna.sh taverna

# Clean up APT when done.
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 5000

WORKDIR /app/Desktop

CMD ["/bin/bash", "taverna"]
