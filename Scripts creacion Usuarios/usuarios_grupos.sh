#! /bin/bash

archivo=$(cat usuarios.txt)

if [[ -n $archivo ]]; then
    i=0
    for linea in $archivo; do
        usuario=$(echo "$linea" | cut -d':' -f1)
        grupo=$(echo "$linea" | cut -d':' -f2)
        sudo useradd -m -s /bin/bash -g "$grupo" "$usuario"
        echo "$usuario:N3wU\$er" | sudo chpasswd
        echo "Usuario $usuario creado en el grupo $grupo"
        echo ""
        ((i++))
    done
    echo "$i Usuarios creados"
    exit 0
else
    echo "No se ha proporcionado lista de usuarios"
    exit 1
fi