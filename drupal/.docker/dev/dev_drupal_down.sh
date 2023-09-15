#!/bin/sh

## Check .env.local file
if [ ! -f .env.local ]; then
    printf "\r\n%sFile '.env.local' does not exist.%s\r\n\r\n" \
    "$(tput setaf 1)" "$(tput sgr 0)"
    exit 1
else
    ## Get COMPOSE_PROJECT_NAME variable (exists, not comment, not empty)
    if [ -n "$(cat < .env.local | grep COMPOSE_PROJECT_NAME= | sed '/^#/d' | cut -d= -f2 | xargs)" ]; then
        COMPOSE_PROJECT_NAME=$(cat < .env.local | grep COMPOSE_PROJECT_NAME= | cut -d= -f2 | xargs)
    else
        printf "\r\n%s'COMPOSE_PROJECT_NAME' variable is not set.%s\r\n\r\n" \
        "$(tput setaf 1)" "$(tput sgr 0)"
        exit 1
    fi
fi

## Stop and remove containers
docker-compose --env-file .env.local down

## Remove project network
echo "\r\nRemoving network: "
docker network rm ${COMPOSE_PROJECT_NAME}_network
