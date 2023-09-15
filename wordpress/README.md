# Vyškov

Content:
- Linux
- (E)Nginx
- MySQL/MariaDB
- PHP

## Environments

Copy `.env.local.example` as `.env.local` and change as needed.

## Quick start
1. Clone or download this repository
2. Go inside of directory `cd wordpress/dev`
3. Run command:
    ```
    sh dev_wordpress_up.sh
    ```

## Test/Prod notes

Let's Encrypt:
```
cd docker-environment/.docker/test/letsencrypt/certificates
mkdir test-wordpress.example.com
cp cert.pem test-wordpress.example.com/
```