#!/bin/bash

_term() {
    ./rr stop
}

trap _term SIGTERM

if [ "$APP_RUN_SERVER" == "yes" ]; then
    ./rr serve -p &
else
    sleep infinity &
fi

child=$!

wait $child
