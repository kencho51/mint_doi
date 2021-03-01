FROM openjdk:8-jdk-alpine
MAINTAINER Ken Cho

RUN apk add --no-cache bash unzip

COPY . /app

WORKDIR /app

RUN unzip taverna-workbench-core-2.5.0-standalone.zip && \
    rm taverna-workbench-core-2.5.0-standalone.zip && \
    chmod u+x /app/taverna-workbench-core-2.5.0/taverna.sh

EXPOSE 5000

WORKDIR /app

CMD ["bash", "/app/taverna-workbench-core-2.5.0/taverna.sh"]