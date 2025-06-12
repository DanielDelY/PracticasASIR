<?php
    function conexion() {
        
        $host="localhost";
        $nombreBD="hoteles";
        $usuario="root";
        $password="";
        
        $pdo= new PDO("mysql:host=$host;dbname=$nombreBD;charset=utf8",$usuario,$password);
        /*Esta linea la utilicé para evitar errores en el ejercicio de videojuegos y poder usar el mensaje de error.*/
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);  
        return $pdo;
    }

    $pdo=conexion();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre=$_POST['nombre'];
        $provincia=$_POST['provincia'];
        $estrellas=$_POST['estrellas'];


        if (empty($nombre) || empty($provincia) || empty($estrellas)) {

            header("Location:error.php?mensaje=Los campos no pueden estar vacios.");
            exit();  
        }
    
        $insercion=$pdo->prepare("INSERT INTO hoteles (nombre,provincia,estrellas)" . "VALUES(:nombre,:provincia,:estrellas)");

        $insercion->bindParam(':nombre', $nombre);
        $insercion->bindParam(':provincia', $provincia);
        $insercion->bindParam(':estrellas', $estrellas);

        if ($insercion->execute()) {
            header("Location:index.php");
            exit();
        } else {
            header("Location:error.php?mensaje=Error al insertar el hotel.");
            exit();
        }
    }
    /*Para probar la redirección a error.php con el mensaje "Error al insertar el hotel", 
    se puede hacer cambiando el nombre de la tabla hoteles en INSERT INTO.
    Por ejemplo cambiandola a hotel para que no encuentre la tabla y no pueda ejecutar la inserción, 
    esto mismo probe (y escribí) en el ejercicio de videojuegos.
    He querido diferenciar el mensaje para cuando falta rellenar algun campo del mensaje si falla la inserción de datos en la base. */
?>