ARG BASE_IMAGE=ghcr.io/totara/docker-dev-php83

FROM $BASE_IMAGE:latest

RUN apt-get update && apt-get install -y cron

COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

CMD /entrypoint.sh
