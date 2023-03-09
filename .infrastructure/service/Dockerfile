FROM php:8.2.3-cli

ENV APP_NAME prjctr
ENV APP_ENV prod
ENV APP_RUN_SERVER yes
ENV APP_PORT 8080

RUN apt-get update && apt-get install -y --no-install-recommends git unzip libpq-dev && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN useradd -ms /bin/bash Qui-Gon

RUN docker-php-ext-install sockets && docker-php-ext-install pcntl && \
    pecl install mongodb && docker-php-ext-enable mongodb && \
    pecl install apcu && docker-php-ext-enable apcu && \
    echo "apc.enable_cli=1" >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini

RUN php -r "readfile('https://getcomposer.org/installer');" | php && chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer && \
    export PATH="/home/Qui-Gon/.composer/vendor/bin/:$PATH" && \
    export COMPOSER_HOME="/home/Qui-Gon" && \
    export HOME="/home/Qui-Gon"

ENV DEBIAN_FRONTEND noninteractive
RUN echo 'PS1="\[\033[36m\]\u\[\033[m\]@\[\033[32m\]${APP_NAME}:\[\033[33;1m\]\w\[\033[m\]\$ "' >> /home/Qui-Gon/.bashrc

COPY ./.infrastructure/service/entrypoint.sh /usr/local/bin
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

COPY --chown=1000:1000 .. /var/www/project

WORKDIR /var/www/project

RUN composer install --no-dev
RUN ./vendor/bin/rr get-binary
