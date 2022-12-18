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

##
## Create networks
##
## $1 ~ network name
## $2 ~ network driver
## https://linuxize.com/post/bash-functions/
create_network() {
    if [ "$(docker network ls | grep "$1" | grep -v "$2")" != "" ]; then
        printf "$(tput setaf 1)Network with name '%s' already exists but requires driver '%s'.$(tput sgr 0)\r\n\r\n" "$1" "$2"
        exit 1
    elif [ "$(docker network ls | grep "$1" | grep "$2")" = "" ]; then
        printf "Creating network '%s'...\r\n" "$1"
        docker network create --driver "$2" "$1"
    else
        printf "Network with name '%s' already exists.\r\n" "$1"
    fi
}
## Empty new line
printf "\r\n"
## https://linuxize.com/post/bash-for-loop/
for i in frontend_network backend_network database_network ${COMPOSE_PROJECT_NAME}_network
do
  create_network "$i" overlay
done

## Part 1
## docker stack deploy --compose-file=docker-compose.yml project
docker-compose --env-file .env.local --file=docker-compose.yml config 2>/dev/null | docker stack deploy --compose-file - ${COMPOSE_PROJECT_NAME}

## Part 2 (depends on "Part 1")
## (docker stack deploy --compose-file=docker-compose.override.yml project)
## docker-compose config | docker stack deploy --compose-file - project
## Require remove "depends_on" section (https://unix.stackexchange.com/questions/648684/how-do-i-remove-all-specifc-sub-sections-of-a-specifc-header-in-a-yaml-file?rq=1#answer-650052)
#docker-compose config | sed -e 'H;x;/^\(  *\)\n\1/{s/\n.*//;x;d;}' -e 's/.*//;x;/\depends_on/{s/^\( *\).*/ \1/;x;d;}' | docker stack deploy --compose-file - ${COMPOSE_PROJECT_NAME}
docker-compose --env-file .env.local --file=docker-compose.override.yml config 2>/dev/null | docker stack deploy --compose-file - ${COMPOSE_PROJECT_NAME}
