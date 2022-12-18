# Docker Environment

## Environments

Copy `.env.local.example` as `.env.local` and change as needed.

## Quick start
1. Clone or download this repository
2. Go inside of directory `cd docker-environment/dev`
3. Optionally place certificates in a directory:
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
6. Run command:
     ```
    sh dev_docker-environment_up.sh
    ```

## Adding trusted root certificate authority (e.g. from mkcert)
1. Operating system
   - **Windows**
     - **Edge**:
       - double-click the file `\\wsl$\Debian\home\debian\workspace\docker-environment\.docker\dev\certificates\rootCA.crt` and install as root certificate authority:
         - local computer
         - custom location
           - trusted root certificate authority
   - **Linux (Debian)**:
    ```
    sudo cp rootCA.crt /usr/local/share/ca-certificates/
    sudo update-ca-certificates
    ```

2. Other browsers:
   - **Chrome, Firefox**: 
     - Settings -> Privacy and security -> Security -> Manage certificates -> Authorities -> Import (rootCA.crt)

## Configure your system `hosts` file:

- `127.0.0.1 dev-traefik.example.com dev-adminer.example.com dev-mailcatcher.example.com`

Path:
- Linux: `/etc/hosts`
- macOX: `/private/etc/hosts`
- Windows: `C:\Windows\System32\drivers\etc\hosts`

## Access URLs:
- **Traefik:**
  - `https://dev-traefik.example.com`
  - `(http://127.0.0.1:8080)`
    - default user: traefik
    - default password: traefik
- **Adminer:**
  - `https://dev-adminer.example.com`
  - `(http://127.0.0.1:8081)`
- **Mailcatcher:**
  - `https://dev-mailcatcher.example.com`
  - `(http://127.0.0.1:1083)`
