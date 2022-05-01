FROM ubuntu:21.10
LABEL maintainer="hibara428"

# Docker args
ARG WWWGROUP
ARG NODE_VERSION=16

# Environments
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=UTC

# Set up server
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor libcap2-bin libpng-dev python2 \
    && mkdir -p ~/.gnupg \
    && chmod 600 ~/.gnupg \
    && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf \
    && apt-key adv --homedir ~/.gnupg --keyserver hkps://keyserver.ubuntu.com --recv-keys 14AA40EC0831756756D7F66C4F4EA0AAE5267A6C \
    && echo "deb https://ppa.launchpadcontent.net/ondrej/php/ubuntu impish main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && apt-get update \
    && apt-get install -y php8.1-cli php8.1-dev \
    php8.1-gd \
    php8.1-curl \
    php8.1-imap php8.1-mysql php8.1-mbstring \
    php8.1-xml php8.1-zip php8.1-bcmath php8.1-soap \
    php8.1-intl php8.1-readline \
    && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -sL https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && apt-get update \
    && apt-get install -y yarn \
    && apt-get install -y mysql-client \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.1
RUN groupadd --force -g $WWWGROUP sail
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u 1337 sail
COPY ./docker/8.1/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./docker/8.1/php.ini /etc/php/8.1/cli/conf.d/99-sail.ini

# Build app
COPY --chmod=$WWWUSER:$WWWGROUP . /var/www/html
WORKDIR /var/www/html
RUN chmod -R 777 /var/www/html/storage \
    && composer install --no-dev

# Entry point
COPY ./docker/8.1/start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

EXPOSE 8000
ENTRYPOINT ["start-container"]
