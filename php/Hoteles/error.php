<?php
include "cabecera.inc.php";
?>
    <header>
        <h1>Error</h1>
    </header>
    <main>
        <?php
            if (isset($_GET['mensaje'])) {
                $mensaje = htmlspecialchars($_GET['mensaje']);
                echo "<h2>$mensaje</h2>";
            }
        ?>
    </main>
<?php
include "footer.inc.php";
?>