FROM nginx:1.23

RUN apt-get update && apt-get install -y --no-install-recommends fcgiwrap && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./.infrastructure/nginx/proxy_cache_purge.sh /tmp
RUN chmod +x /tmp/proxy_cache_purge.sh