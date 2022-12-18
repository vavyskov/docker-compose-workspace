#!/bin/sh

## Check .env.local file
if [ ! -f .env.local ]; then
    printf "\r\n%sFile '.env.local' does not exist.%s\r\n\r\n" \
    "$(tput setaf 1)" "$(tput sgr 0)"
    exit 1
fi

## Stop and remove containers
docker-compose --env-file .env.local down
