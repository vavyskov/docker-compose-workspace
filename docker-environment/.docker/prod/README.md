# Docker Environment

## Environments

Copy `.env.local.example` as `.env.local` and change as needed.

## Quick start
1. Clone or download this repository
2. Go inside of directory `cd docker-environment/prod`
3. Optionally place wildcard certificates in a directory:
    ```
    /etc/ssl/CUSTOM/CERTIFICATE.crt
    /etc/ssl/CUSTOM/CERTIFICATE.key
    ```
4. Optionally change volumes:
    ```
    volumes:
      - /etc/ssl/CUSTOM:/etc/ssl/certificates:ro
      #- ./certificates:/etc/ssl/certificates:ro
    ```
5. Optionally set custom certificates in `config/dynamic.yml`.
6. Optionally create project volumes (NFS only):
    ```
    cd .docker
    sudo bash project-volumes_create.bash
    ```
7. Run command:
    ```
    sh prod_docker-environment_stack-deploy.sh
    ```

## Access URLs:
- **Traefik:** `https://traefik.example.com`
- **Adminer:** `https://adminer.example.com`
