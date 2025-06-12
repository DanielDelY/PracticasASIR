<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Hoteles</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/estilos.css">
    </head>
    <body>
        <!-- Menú de Navegación -->
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="nuevo_hotel.php">Nuevo Hotel</a></li>
                <li><a href="logout.php">Cerrar Sesion</a></li><!--He incluido un cierre de sesión-->
            </ul>
        </nav>
        <?php
            /*Comprueba si no hay una sesion de un usuario activa y redirige a login.php en todas las páginas donde está la cabecera.*/
            session_start();

            if(!isset($_SESSION['login'])) {
                header("Location:login.php");
                die();
            }
        ?>