# docker-compose-workspace

Vývojové prostředí

## Instalace

Možnosti:
- Aplikace Docker Desktop (Windows, macOS)
    - komerční použití zdarma pouze pro **organizace do 250 zaměstnanců** nebo **obratu do 10 mil dolarů ročně**
- Docker Command Line Interface (Linux, Windows, macOS):
    - zdarma

### Linux:

Dokumentace:
- [Install using the Apt repository](https://docs.docker.com/engine/install/debian/#install-using-the-repository)
- [Manage Docker as a non-root user](https://docs.docker.com/engine/install/linux-postinstall/#manage-docker-as-a-non-root-user)
- [Install the plugin manually](https://docs.docker.com/compose/install/linux/#install-the-plugin-manually)

### Windows (macOS)

Docker CLI (bez Docker Desktop):
1. Požadavky:
   - Windows 10 (build 19041+) nebo Windows 11
     ```
     winver
     ```
   - CPU s podporout SLAT (Second Level Address Translation)
   - v BIOSu pro CPU povolená virtualizace
2. Microsoft Store:
   - Windows Subsystem for Linux (WSL)
   - Debian:
     - Zprovoznění "docker" příkazů (WSL Debian):
       - Instalace Docker CE (WSL Debian):
         ```
         sudo apt-get update &&
         sudo apt-get install -y ca-certificates curl gnupg &&
         sudo install -m 0755 -d /etc/apt/keyrings &&
         curl -fsSL https://download.docker.com/linux/debian/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg &&
         sudo chmod a+r /etc/apt/keyrings/docker.gpg &&
         echo \
           "deb [arch="$(dpkg --print-architecture)" signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/debian \
           "$(. /etc/os-release && echo "$VERSION_CODENAME")" stable" | \
           sudo tee /etc/apt/sources.list.d/docker.list > /dev/null &&
         sudo apt-get update &&
         sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin &&
         sudo curl -SL https://github.com/docker/compose/releases/download/1.29.2/docker-compose-linux-x86_64 -o /usr/local/bin/docker-compose &&
         sudo chmod +x /usr/local/bin/docker-compose &&
         sudo service docker start &&
         sudo usermod -aG docker $USER &&
         newgrp docker
         ```
       - Kontrola funkčnosti:
         ```
         service docker status
         (sudo service docker start)
         docker ps
         docker run hello-world
         ```
       - Volitelně Git:
         - Konfigurace uživatele:
           ```
           git config --global user.email "you@example.com"
           git config --global user.name "Your Name"
           git config --list
           ```
           - Zkopírovat obsah adresáře `.ssh/` do WSL `~/.ssh/docker/`.
3. PowerShell příkazy:
    - Instalace WSL:
      ```
      wsl --install
      ```
    - Instalace distribuce (WSL Debian):
        ```
        wsl --install --distribution debian
        ```
    - Odinstalace distribuce (WSL Debian):
        ```
        wsl --unregister debian
        ```
    - Volitelné nastavení výchozí distribuce:
        ```
        wsl --list --verbose
        wsl --set-default debian
        ```
    - Vypnutí WSL:
      ```
      wsl --shutdown
      ```
    - Odinstalace WSL:
      ```
      wsl --uninstall
      ```

## Visual Studio Code

Rozšíření:
- [WSL](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-wsl)
    - ve Visual Studio Code kliknout vlevo dole na ikonu "><" a zvolit:
        - New WSL Window using Distro...
    - nebo ve WSL terminálu přejít do adresáře projektu a spustit příkaz:
      ```
      code .
      ```
- Volitelně [Git Graph](https://marketplace.visualstudio.com/items?itemName=mhutchie.git-graph)
- Volitelně [IntelliJ IDEA Keybindings](https://marketplace.visualstudio.com/items?itemName=k--kato.intellij-idea-keybindings)

## Drupal

Docker konfigurace:
- Nginx:
    - NGINX_ROOT: **web** (public | build)

Instalace:
```
composer create-project drupal/recommended-project tmp --no-install &&
cp -r tmp/. . &&
rm -rf tmp
composer install
```

Databáze:
- Server: **dev_drupal-lemp_mariadb** (dev_vyskov_mariadb)
