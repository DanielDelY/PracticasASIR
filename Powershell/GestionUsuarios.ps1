#Inicio variable
$salir=0

# Funciones para el Menu de gestion de usuarios y grupos
function lista-Usuarios () {
    Clear-Host
    Get-LocalUser | Select-Object Name | Out-Host
    return
}

function lista-Grupos () {
    Clear-Host
    Get-LocalGroup | Select-Object Name | Out-Host
    return
}

function info-Usuarios ($us) {
    Clear-Host
    $usuario=Read-Host "Introduce el nombre de usuario"
    Get-LocalUser $usuario | fl | Out-Host
    return
}

# Funciones para la Gestión de Usuarios
function añade-Usuario ($us){
    $grupo=Read-Host "Introduce el nombre de grupo al que añadir el usuario"
    Add-LocalGroupMember $grupo –Member $us
    Write-Host "Usuario $us añadido al grupo $grupo."
}

function elimina-Usuario-Grupo ($us) {
     $grupo = Read-Host "Introduzca el nombre del grupo del que eliminar al usuario"
     Remove-LocalGroupMember -Group $grupo -Member $us
     Write-Host "Usuario $us eliminado del grupo $grupo."
}

function elimina-Usuario () {
    Remove-LocalUser $us -Confirm
    Write-Host "Usuario $us eliminado."
}

function gestion-Usuarios () {
    $us=Read-Host "Introduce un nombre de Usuario"
    #inicio variable
    $y= ""
    #Inicio menu
    while ($y -ne "D")
    { 
        Write-Host "-Gestión de Usuarios-"
        Write-Host " "
        Write-Host "A. Añade usuario al grupo."
        Write-Host "B. Elimina usuario del Grupo."
        Write-Host "C. Elimina Usuario."
        Write-Host "D. Volver al menú anterior"

        $y=Read-Host "Elige una opción"
        switch ( $y )
        {
        "A" { añade-Usuario $us }
        "B" { elimina-Usuario-Grupo $us }
        "C" { elimina-Usuario $us }
        "D" { Write-Host "Volviendo al menú anterior..."}
        default {Write-Host "Pulsa para continuar..."}
        }
    }
}

#Inicio del menú
:bucleMenu while ($salir -ne 1)
{ 
    Write-Host "-Menu de gestion de usuarios y grupos-"
    Write-Host " "
    Write-Host "1. Lista de Usuarios." 
    Write-Host "2. Lista de grupos." 
    Write-Host "3. Información detallada de usuario." 
    Write-Host "4. Gestionar usuarios."
    Write-Host "5. Salir."

    $x=Read-Host "Elige una opción"
    switch ( $x )
    {
        1 { lista-Usuarios }    
        2 { lista-Grupos }    
        3 { info-Usuarios }   
        4 { gestion-Usuarios }
        5 { 
            Write-Host "Saliendo..."
            break bucleMenu
            }
        default { Write-Host "Pulsa para continuar..."
            }
     }
}
