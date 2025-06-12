#Variables a utilizar
$fecha=Get-Date -Uformat "%d-%m-%Y %R"
$msnPrcs="Primeros 10 procesos con más uso de CPU"
$msnServ="Servicios en ejecución"
$msnEsp="Espacio usado por usuario"
$informe="C:\Users\Daniel\Documents\Estado_Sistema.txt"

# Función para generar todo el informe
function generaInforme(){

    " -- $fecha -- "
    "-Informe de Estado del Sistema-"
    "--------------------------------`n"
    "--$msnPrcs--"
    Get-Process | Sort CPU -Descending | Select -first 10

    "--------------------------------`n"
    "--$msnServ--"
    Get-Service | Where-Object {$_.Status -eq "Running"} | ft 

    "--------------------------------`n"
    "--$msnEsp-- `n"   
    $userDirs = Get-ChildItem -Path "C:\Users" -Directory -Exclude "Public"
    foreach ($userDir in $userDirs) {
            $totalSize = 0
            $files = Get-ChildItem -Path $userDir.FullName -Recurse -File
                foreach ($file in $files) {
                    $totalSize += $file.Length
                }
            "--"
            $totalSizeMB = [math]::round($totalSize / 1MB, 2)
            Write-Output "$($userDir.Name) ocupa $totalSizeMB MB"          
    }

    "--"
    "-------------------------------`n"  
}
<# El informe que se genera va añadiendose cada vez que se ejecuta.
En caso de querer sustituirlo para que no ocupe cada vez más
podemos cambiar la salida asi: generaInforme | Write-Output > $informe #>
generaInforme | Write-Output >> $informe
# Avisamos de que se ha generado el informe y su ruta
Write-Host "Informe generado en $informe"
