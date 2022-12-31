# Drupal LEMP

Content:
- Linux
- (E)Nginx
- MySQL/MariaDB
- PHP

## Environments

Copy `.env.local.example` as `.env.local` and change as needed.

## Quick start
1. Clone or download this repository
2. Go inside of directory `cd drupal-lemp/dev`
3. Run command:
    ```
    sh dev_drupal-lemp_up.sh
    ```

## Test/Prod notes

Let's Encrypt:
```
cd docker-environment/.docker/test/letsencrypt/certificates
mkdir test-vyskov.example.com
cp cert.pem test-vyskov.example.com/
```