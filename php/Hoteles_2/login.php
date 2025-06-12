    <?php

    function conexion() {
        
        $host="localhost";
        $nombreBD="hoteles";
        $usuario="root";
        $password="";
        
        $pdo= new PDO("mysql:host=$host;dbname=$nombreBD;charset=utf8",$usuario,$password);
        return $pdo;
    }

    $pdo=conexion();

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        $loged = $pdo->prepare("SELECT * FROM usuarios WHERE login=:login AND password=:password");
        $loged->execute(['login' => $login,'password' => $password]);
        $usuario = $loged->fetch();

        if ($usuario) {
            $_SESSION['login'] = $usuario['login'];
            header("Location: index.php");
            die();
        } else {
            $_SESSION['mensajeError']=" --Credenciales Incorrectas-- ";
            header("Location: login.php");
            exit();
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <title>Hoteles</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link rel="stylesheet" href="./css/estilo_login.css">
        </head>
        <body>
            <nav>
                <h1>Gestiona Hoteles</h1>
            </nav>
        
            <main>
            <header>
                <h2>Inicio de sesión</h2>
            </header>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="row g-2">
                    <div class="col-2">
                        <label class="form-label" for="login"></label>
                        <input class="form-control" type="text" name="login" id="login" placeholder="Usuario" aria-label="Usuario"><br>
                    </div>
                    <div class="col-2">
                        <label class="form-label" for="password"></label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña" aria-label="Password"><br>
                    </div>
                    <div class="row">
                        <div class="col-1 pt-2 d-grid col">
                            <input class="btn btn-dark" type="submit" value="Iniciar sesión">
                        </div>
                    </div>
                </div>
            </form>
            <?php 
                if (isset($_SESSION['mensajeError'])):
                    echo '<div class="alert alert-danger mt-3 col-2" role="alert" id="alert">' . htmlspecialchars($_SESSION['mensajeError']) . '</div>';
                    unset($_SESSION['mensajeError']);
                endif;
            ?>
        </main>
<?php
include "footer.inc.php";
?>