#! /bin/bash

usuarios=$(cat usuarios.txt)

if [[ -n $usuarios ]]; then
    i=0
    for usuario in $usuarios; do       
        sudo useradd -m -s /bin/bash "$usuario"
        echo "$usuario:N3wU\$er" | sudo chpasswd
        echo "Usuario "$usuario" creado"
        echo ""
        ((i++))
    done
    echo "$i Usuarios creados"
    exit 0
else
    echo "No se ha proporcionado lista de usuarios"
    exit 1
fi