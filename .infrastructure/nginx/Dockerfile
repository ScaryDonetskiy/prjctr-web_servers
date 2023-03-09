FROM nginx:1.23

RUN apt-get update && apt-get install -y --no-install-recommends nginx-extras && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./.infrastructure/nginx/cache_purge.sh /var
COPY ./.infrastructure/nginx/cache_purge.lua /var
RUN chmod +x /var/cache_purge.sh

RUN rm /etc/nginx/sites-enabled/default