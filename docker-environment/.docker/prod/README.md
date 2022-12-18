# Docker Environment

## Environments

Copy `.env.local.example` as `.env.local` and change as needed.

## Quick start
1. Clone or download this repository
2. Go inside of directory `cd docker-environment/prod`
3. Place wildcard certificates in a directory:
    ```
    /etc/ssl/CUSTOM/CERTIFICATE.crt
    /etc/ssl/CUSTOM/CERTIFICATE.key
    ```
4. Optionally set custom certificates in `config/dynamic.yml`.
5. Run command:
    ```
    sh prod_docker-environment_stack-deploy.sh
    ```

## Adding trusted root certificate authority (e.g. from mkcert)
1. Operating system
   - **Linux (Debian)**:

         sudo cp rootCA.crt /usr/local/share/ca-certificates/
         sudo update-ca-certificates

2. Other browsers:
   - **Chrome, Firefox**:
     - Settings -> Privacy and security -> Security -> Manage certificates -> Authorities -> Import (rootCA.crt)

## Optionally configure your system `hosts` file:

- `127.0.0.1 traefik.ispovy.acr adminer.ispovy.acr`

Path:
- Linux: `/etc/hosts`
- macOX: `/private/etc/hosts`
- Windows: `C:\Windows\System32\drivers\etc\hosts`

## Access URLs:
- **Traefik:** `https://traefik.ispovy.acr`
- **Adminer:** `https://adminer.ispovy.acr`

## Create project volumes

```
cd .docker
sudo bash project-volumes_create.bash
```
