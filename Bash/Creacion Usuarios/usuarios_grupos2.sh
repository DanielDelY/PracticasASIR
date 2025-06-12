#! /bin/bash

archivo=$(cat usuarios.txt)

if [[ -n $archivo ]]; then
    i=0
    for linea in $archivo; do
        usuario=$(echo "$linea" | cut -d':' -f1)
        grupo=$(echo "$linea" | cut -d':' -f2)
            if grep -w ^"$grupo" /etc/group &>/dev/null; then
                if grep -w ^"$usuario" /etc/passwd &>/dev/null; then
                    echo "El usuario $usuario ya existe"
                    echo ""
                else
                    sudo useradd -m -s /bin/bash -g "$grupo" "$usuario"
                    echo "$usuario:N3wU\$er" | sudo chpasswd
                    echo "Usuario $usuario creado en el grupo $grupo"
                    echo ""
                    ((i++))
                fi
            else
                if grep -w ^"$usuario" /etc/passwd &>/dev/null; then
                    echo "El usuario $usuario ya existe"
                    echo ""
                else
                    sudo addgroup "$grupo"
                    sudo useradd -m -s /bin/bash -g "$grupo" "$usuario"
                    echo "$usuario:N3wU\$er" | sudo chpasswd
                    echo "Usuario $usuario creado en el grupo $grupo"
                    echo ""
                    ((i++))
                fi
            fi
    done
    echo "$i Usuarios creados"
    exit 0
else
    echo "No se ha proporcionado lista de usuarios"
    exit 1
fi
