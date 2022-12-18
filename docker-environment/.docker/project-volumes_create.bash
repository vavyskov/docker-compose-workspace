#!/bin/bash
#set -eu
set -e

HOSTNAME=$(hostname)
DOMAIN=$(hostname --domain)
USER=user

## If HOST contains string
if [[ ${HOSTNAME} =~ ^.*myTestServer.*$ ]]; then
  PROJECT_MODE='test'
elif [[ ${HOSTNAME} =~ ^.*myProdServer.*$ ]]; then
  PROJECT_MODE='prod'
else
  echo -e "\n$(tput setaf 1)Wrong server 'hostname'!$(tput sgr 0)\n"
  exit 1

  #PROJECT_MODE='dev'
fi

## If DOMAIN not contains string
if [[ ! ${DOMAIN} =~ ^.*example\.com.*$ ]]; then
  echo -e "\n$(tput setaf 1)Wrong server 'domain'!$(tput sgr 0)\n"
  exit 1
fi

## -----------------------------------------------------------------------------

## Detect permission
if [[ $(id -u) != 0 ]]; then
  echo -e "\n$(tput setaf 1)Run script as a 'root' user or with 'sudo' prefix at the beginning!$(tput sgr 0)\n"
  exit 1
fi

# Detect user
if ! id ${USER} >/dev/null 2>&1; then
  echo -e "\nUser '${USER}' does not exist!\n"
  exit
fi

## Get variables
while true; do

    while true; do
        read -e -p "The project 'URL Slug' in the GIT repository (e.g. 'my-project-2'): " -i ${PROJECT:-''} PROJECT
        ## https://regex101.com/
        ## ^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{4,}$
        if [[ ${PROJECT} =~ ^([a-z]+[-]*)+[a-z0-9]+$ ]]; then
            break
        else
            tput bold
            echo -e "Allowed characters are lowercase letters, dash and numbers (e.g. 'my-project-2')."
            echo -e "The minimum length is 2 characters."
            tput sgr0
        fi
    done

    echo -e "\nDo you want to use a database? (1/2)"
    select DB_CREATE in "Yes" "No"; do
        case ${DB_CREATE} in
            "Yes" )
                DB_CREATE=true
                break;;
            "No" )
                DB_CREATE=false
                break;;
            * )
                tput bold
                echo "Invalid option ${REPLY}"
                tput sgr0;;
        esac
    done
    ## New line
    echo -e ''

    if [[ ! ${DB_CREATE} = false ]]; then
        echo -e "\nWhat database do you wish to use? (1/2/3)"
        select DB_CREATE in "MySQL" "PgSQL" "MySQL and PgSQL"; do
            case ${DB_CREATE} in
                "MySQL" )
                    DB_CREATE=mysql
                    break;;
                "PgSQL" )
                    DB_CREATE=pgsql
                    break;;
                "MySQL and PgSQL" )
                    DB_CREATE=all
                    break;;
                * )
                    tput bold
                    echo "Invalid option ${REPLY}"
                    tput sgr0;;
            esac
        done
        ## New line
        echo -e ''
    fi

    echo -e "\nDo you want to use 'Chromium' (requires 'tmp_data')? (1/2)"
    select IS_CHROMIUM in "No" "Yes"; do
        case ${IS_CHROMIUM} in
            "No" )
                IS_CHROMIUM=false
                break;;
            "Yes" )
                IS_CHROMIUM=true
                break;;
            * )
                tput bold
                echo "Invalid option ${REPLY}"
                tput sgr0;;
        esac
    done
    ## New line
    echo -e ''

    NFS_PROJECT_PATH=/media/nfs_docker/${PROJECT_MODE}/${PROJECT_MODE}_${PROJECT}
    NFS_PROJECT_HTML_PATH=${NFS_PROJECT_PATH}/volumes/html_data
    NFS_PROJECT_MARIADB_PATH=${NFS_PROJECT_PATH}/volumes/mariadb_data
    NFS_PROJECT_POSTGRES_PATH=${NFS_PROJECT_PATH}/volumes/postgres_data
    NFS_PROJECT_TMP_PATH=${NFS_PROJECT_PATH}/volumes/tmp_data

    echo -e "\nYour configuration"
    echo -e "------------------"
    echo -e "Project name:        $(tput setaf 6)${PROJECT}$(tput sgr 0)"
    echo -e "Files NFS path:      $(tput setaf 6)${NFS_PROJECT_HTML_PATH}$(tput sgr 0)"
    if [[ ! ${DB_CREATE} = pgsql ]] && [[ ! ${DB_CREATE} = false ]]; then
        echo -e "MySQL NFS path:      $(tput setaf 6)${NFS_PROJECT_MARIADB_PATH}$(tput sgr 0)"
    fi
    if [[ ! ${DB_CREATE} = mysql ]] && [[ ! ${DB_CREATE} = false ]]; then
        echo -e "PgSQL NFS path:      $(tput setaf 6)${NFS_PROJECT_POSTGRES_PATH}$(tput sgr 0)"
    fi
    if [[ ${IS_CHROMIUM} = true ]]; then
        echo -e "Tmp NFS path:        $(tput setaf 6)${NFS_PROJECT_TMP_PATH}$(tput sgr 0)"
    fi

    ## New line
    echo -e ''

    read -e -p 'Is it correct? (Yes/No/Cancel): ' -n 1 CONTINUE
    if [[ ${CONTINUE} =~ ^[Yy].*$ ]]; then
        break
    elif [[ ${CONTINUE} =~ ^[Cc].*$ ]]; then
        echo -e "\n$(tput setaf 3)Canceled!$(tput sgr 0)\n"
        exit
    fi
    echo -e ''
done

## -----------------------------------------------------------------------------

## Create Project directory
if [[ ! -d ${NFS_PROJECT_PATH} ]]; then
  mkdir -p "${NFS_PROJECT_PATH}"

  # Set permission
  sudo chmod g+rwx "${NFS_PROJECT_PATH}"
else
  echo -e "\n$(tput setaf 1)Directory '${NFS_PROJECT_HTML_PATH}' exists!$(tput sgr 0)\n"
  exit 1
fi

## Create Files directory
if [[ ! -d ${NFS_PROJECT_HTML_PATH} ]]; then
  mkdir -p "${NFS_PROJECT_HTML_PATH}"
else
  echo -e "\n$(tput setaf 1)Directory '${NFS_PROJECT_HTML_PATH}' exists!$(tput sgr 0)\n"
  exit 1
fi

## Create MySQL directory
if [[ ! ${DB_CREATE} = pgsql ]] && [[ ! ${DB_CREATE} = false ]]; then
  if [[ ! -d ${NFS_PROJECT_MARIADB_PATH} ]]; then
    mkdir -p "${NFS_PROJECT_MARIADB_PATH}"
  else
    echo -e "\n$(tput setaf 1)Directory '${NFS_PROJECT_MARIADB_PATH}' exists!$(tput sgr 0)\n"
    exit 1
  fi
fi

## Create PgSQL directory
if [[ ! ${DB_CREATE} = mysql ]] && [[ ! ${DB_CREATE} = false ]]; then
  if [[ ! -d ${NFS_PROJECT_POSTGRES_PATH} ]]; then
    mkdir -p "${NFS_PROJECT_POSTGRES_PATH}"
  else
    echo -e "\n$(tput setaf 1)Directory '${NFS_PROJECT_POSTGRES_PATH}' exists!$(tput sgr 0)\n"
    exit 1
  fi
fi

## Create Tmp directory
if [[ ${IS_CHROMIUM} = true ]]; then
  if [[ ! -d ${NFS_PROJECT_TMP_PATH} ]]; then
    mkdir -p "${NFS_PROJECT_TMP_PATH}"
  else
    echo -e "\n$(tput setaf 1)Directory '${NFS_PROJECT_TMP_PATH}' exists!$(tput sgr 0)\n"
    exit 1
  fi
fi

## Clone project from GIT repository
chown ${USER}:${USER} "${NFS_PROJECT_HTML_PATH}"
sudo -u "${USER}" git clone git@git.example.com:user/"${PROJECT}".git "${NFS_PROJECT_HTML_PATH}"
cd "${NFS_PROJECT_HTML_PATH}"
if [[ ${PROJECT_MODE} != prod ]]; then
  git checkout ${PROJECT_MODE}
fi
cp ${NFS_PROJECT_HTML_PATH}/.docker/${PROJECT_MODE}/.env.local.example ${NFS_PROJECT_HTML_PATH}/.docker/${PROJECT_MODE}/.env.local
chown root:root "${NFS_PROJECT_HTML_PATH}"

#cd ${NFS_PROJECT_HTML_PATH}/.docker/${PROJECT_MODE}
#exec bash
#$SHELL

## Show next steps
echo -e "\n$(tput setaf 2)Next steps:$(tput sgr 0)\n"
echo -e "$(tput setaf 2)1. In the directory '${NFS_PROJECT_HTML_PATH}/.docker/${PROJECT_MODE}':$(tput sgr 0)"
echo -e "$(tput setaf 2)   - as 'root' edit '.env.local' file$(tput sgr 0)"
echo -e "$(tput setaf 2)   - as '${USER}' run command 'sh ${PROJECT_MODE}_${PROJECT}_stack-deploy.sh'$(tput sgr 0)"
echo -e "$(tput setaf 2)2. Login to the container using SSH and initialize the project.$(tput sgr 0)"
echo -e "$(tput setaf 2)   - see project documentation$(tput sgr 0)"
echo -e ''
