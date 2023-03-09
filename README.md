1. Request image by url: http://localhost:8000/1.png or http://localhost:8000/2.png
2. Check X-Proxy-Cache header - it should contain value MISS
3. Request image twice
4. Check X-Proxy-Cache header - it should contain value HIT
5. Use curl request from file curl_purge_cache.sh as a base request for purging cache for selected file
6. Request selected image and check X-Proxy-Cache header - it should contain value MISS