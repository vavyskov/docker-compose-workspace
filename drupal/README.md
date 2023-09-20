# Drupal

Content:
- Linux
- (E)Nginx
- MySQL/MariaDB
- PHP

## Environments

Copy `.env.local.example` as `.env.local` and change as needed.

Configuration:
- .env.local:
  - Nginx:
     - NGINX_ROOT: **web** (public | build)

## Quick start
1. Clone or download this repository
2. Go inside of directory `cd drupal/.docker/dev`
3. Run command:
    ```
    sh dev_drupal_up.sh
    ```

## Instalation
```
ssp -p 2225 drupal@localhost
   composer create-project drupal/recommended-project tmp --no-install &&
   cp -r tmp/. . &&
   rm -rf tmp
   composer install
   exit
```

## Database

Server: dev_drupal_mariadb

## Test/Prod notes

Let's Encrypt:
```
cd docker-environment/.docker/test/letsencrypt/certificates
mkdir test-drupal.example.com
cp cert.pem test-drupal.example.com/
```