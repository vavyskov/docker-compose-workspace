# docker-compose-workspace
The development environment

## Instalace

Možnosti:
- Aplikace Docker Desktop (Windows, macOS)
    - komerční použití zdarma pouze pro **organizace do 250 zaměstnanců** nebo **obratu do 10 mil dolarů ročně**
- Docker Command Line Interface (Linux, Windows, macOS):
    - zdarma

### Linux:

Dokumentace:
- https://docs.docker.com/install/linux/docker-ce/debian/
- https://docs.docker.com/install/linux/linux-postinstall/

### Windows (macOS)

Docker CLI (bez Docker Desktop):
1. Požadavky:
    - Windows 10 (build 19041+) nebo Windows 11
        ```
        winver
        ```
    - CPU s podporout SLAT (Second Level Address Translation)
    - v BIOSu pro CPU povolená virtualizace
2. Ovládací panely -> Programy a funce -> Zapnout nebo vypnout funkce systému Windows
    - Platforma virtuálního počítač: **Ano**
    - Subsystém Windows pro Linux (WSL): **Ano**
3. (Microsoft Store -> Hledat "Linux")
4. PowerShell:
    - Instalace distribuce (WSL Debian):
        ```
        wsl --set-default-version 2
        wsl --install --distribution debian
        wsl --set-default debian
        wsl --list --verbose
        ```
    - Odinstalace distribuce (WSL Debian):
        ```
        wsl --unregister debian
        ```
    - Vypnutí WSL:
      ```
      wsl --shutdown
      ```

## Zprovoznění "docker" a "docker-compose" příkazů (WSL Debian)

Dokumentace:
- https://docs.docker.com/engine/install/debian/#install-using-the-repository
- https://docs.docker.com/engine/install/linux-postinstall/#manage-docker-as-a-non-root-user
- https://docs.docker.com/compose/install/linux/#install-the-plugin-manually

WSL Debian:
```
sudo apt update; \
sudo apt upgrade -y; \
sudo apt install -y ca-certificates curl gnupg lsb-release; \
sudo mkdir -p /etc/apt/keyrings; \
curl -fsSL https://download.docker.com/linux/debian/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg; \
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/debian $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null; \
sudo apt update; \
sudo apt install -y docker-ce docker-ce-cli containerd.io docker-compose-plugin; \
sudo usermod -aG docker $USER; \
newgrp docker; \
sudo update-alternatives --set iptables /usr/sbin/iptables-legacy; \
sudo service docker start; \
sudo service docker status; \
sudo curl -SL https://github.com/docker/compose/releases/download/1.29.2/docker-compose-linux-x86_64 -o /usr/local/bin/docker-compose; \
sudo chmod +x /usr/local/bin/docker-compose; \
source ~/.bashrc; \
sudo apt install wget vim mc; \
echo -e "\nDocker:\n-------"; \
docker --version; \
echo -e "\nDocker Compose:\n---------------"; \
docker-compose --version;
```

WSL Git:
- Konfigurace:
    ```
    git config --global user.email "you@example.com"
    git config --global user.name "Your Name"
    git config --list
    ```
- Zkopírovat obsah adresáře `.ssh/` do WSL `~/.ssh/docker/`.

## Visual Studio Code

Rozšíření:
- https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-wsl (WSL)
    - ve Visual Studio Code kliknout vlevo dole na ikonu "><" a zvolit:
        - New WSL Window using Distro...
    - nebo ve WSL terminálu přejít do adresáře projektu a spustit příkaz:
        - ```
          code .
          ```
- https://marketplace.visualstudio.com/items?itemName=donjayamanne.githistory (Git History)
- https://marketplace.visualstudio.com/items?itemName=k--kato.intellij-idea-keybindings (IntelliJ IDEA Keybindings)

## Drupal

Docker konfigurace:
- Nginx:
    - NGINX_ROOT: **web** (public | build)

Instalace:
```
composer create-project drupal/recommended-project tmp --no-install
mv tmp/.composer.json ./
mv tmp/.composer.lock ./
rmdir tmp
composer install
```

Databáze:
- Server: **dev_drupal-lemp_mariadb** (dev_vyskov_mariadb)
