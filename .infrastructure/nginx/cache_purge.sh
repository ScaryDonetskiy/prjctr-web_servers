#!/bin/bash

REQ_FILE=$1

TMP_HASH=$(echo -n $REQ_FILE | md5sum)

HASH=${TMP_HASH:0:32}
FIRST_DIR=${HASH:31:1}
SECOND_DIR=${HASH:29:2}

rm /dev/nginx_cache/$FIRST_DIR/$SECOND_DIR/$HASH