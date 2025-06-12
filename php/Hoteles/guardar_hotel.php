<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombrehotel=$_POST['nombre_hotel'];
        $provinciahotel=$_POST['provincia_hotel'];
        $estrellashotel=$_POST['estrellas_hotel'];


        if (empty($nombrehotel) || empty($provinciahotel) || empty($estrellashotel)) {

            header("Location:error.php?mensaje=Los campos no pueden estar vacios.");
            exit();   

        } else {

            $fichero = "hoteles.txt";
            $nuevohotel= "\n" .$nombrehotel .  ";" . $provinciahotel  . ";" .  $estrellashotel;

            if (file_exists($fichero)) {
                file_put_contents($fichero, $nuevohotel, FILE_APPEND);

                header("Location:index.php");
                exit();

            } else {
                echo "No se pudo abrir el archivo.";
            }
        }
    }
?>