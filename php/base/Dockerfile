FROM ubuntu:16.04

ARG TIME_ZONE=Pacific/Auckland

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y \
    curl \
    freetds-bin \
    freetds-common \
    freetds-dev \
    git \
    libsybdb5 \
    locales \
    nano \
    unixodbc \
    tzdata \
    wget \
    && rm -rf /var/lib/apt/lists/*

RUN sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
    sed -i -e 's/# en_AU.UTF-8 UTF-8/en_AU.UTF-8 UTF-8/' /etc/locale.gen && \
    dpkg-reconfigure --frontend=noninteractive locales && \
    update-locale LANG=en_US.UTF-8

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US.UTF-8
ENV LC_ALL en_US.UTF-8

# Set the timezone
RUN echo ${TIME_ZONE} > /etc/timezone \
    && dpkg-reconfigure --frontend noninteractive tzdata

# Install required packages to run phpbrew
RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y \
    autoconf \
    automake \
    build-essential \
    gettext \
    libbz2-dev \
    libcurl4-openssl-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libmcrypt4 \
    libmhash2 \
    libmhash-dev \
    libpng-dev \
    libpq-dev \
    libreadline-dev \
    libssl-dev \
    libxml2-dev \
    libxslt1-dev \
    openssl \
    php7.0 \
    php7.0-cgi \
    php7.0-curl \
    php7.0-fpm \
    php7.0-json \
    && rm -rf /var/lib/apt/lists/*

# Install phpbrew
RUN mkdir /tmp/php \
    && cd /tmp/php \
    && curl -L -O https://github.com/phpbrew/phpbrew/raw/master/phpbrew \
    && chmod +x phpbrew \
    && mv phpbrew /usr/local/bin/phpbrew \
    && mkdir -p /opt/phpbrew \
    && phpbrew init --root=/opt/phpbrew \
    && echo "source /root/.phpbrew/bashrc" >> ~/.bashrc

RUN ["/bin/bash", "-c", "source /root/.phpbrew/bashrc"]

# Make sure we have know about old PHP versions too
RUN phpbrew update --old && phpbrew known --old

# Source each .bash file found in the /bash/ folder
RUN echo 'for f in ~/custom_bash/*.bash; do [[ -e "$f" ]] && source "$f"; done;' >> ~/.bashrc
