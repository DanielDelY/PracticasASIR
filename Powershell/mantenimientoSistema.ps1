# Comando para realizar el mantenimiento del sistema
cleanmgr /sagerun:1

# Generamos un pequeño informe de aviso para registrar la fecha y hora del mantenimiento
$fecha=Get-Date -Uformat "%d-%m-%Y %R"
$msn="Borrado de ficheros temporales"
" -- " + $fecha + " -- " | Out-File "C:\Users\Daniel\Documents\Mantenimiento_Semanal.txt"
$msn | Out-File -Append "C:\Users\Daniel\Documents\Mantenimiento_Semanal.txt"
Write-Host " -- $fecha -- `n $msn"
