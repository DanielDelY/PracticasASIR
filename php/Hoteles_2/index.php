<?php
include "cabecera.inc.php";
?>
    <header>
        <h1>Listado de Hoteles</h1>
    </header>   
    <main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="request">
            <div class="row row-cols-auto gx-3">
                <div class="col">
                    <label>Provincia: 
                        <select class="form-select" aria-label="Provincia" name="provincia">
                            <option value="" selected>-Cualquiera-</option>
                            <option value="Alicante">Alicante</option>
                            <option value="Valencia">Valencia</option>
                            <option value="Málaga">Málaga</option>
                            <option value="Cádiz">Cádiz</option>
                        </select>
                    </label>
                </div>
                <div class="col">
                    <label>Estrellas: 
                        <select class="form-select" aria-label="Estrellas" name="estrellas">
                            <option value="" selected>-Cualquiera-</option>
                            <option value="2">2 o más</option>
                            <option value="3">3 o más</option>
                            <option value="4">4 o más</option>
                            <option value="5">5</option>
                        </select>
                    </label>
                </div>
                <div class="col-1 pt-2 d-grid col">
                    <input class="p-2 my-2 btn btn-secondary" type="submit" value="Buscar">
                </div>
            </div>  
        </form>
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

            $provincia=$_REQUEST['provincia'] ?? '';
            $estrellas=$_REQUEST['estrellas'] ?? '';

            /*Consultas si se seleccionan los dos campos, solo uno, o ninguno, ordenado por nombre del Hotel*/
            if ($provincia !== '' && $estrellas !== '')  {
                $consulta=$pdo->prepare("SELECT * FROM hoteles WHERE provincia = :provincia AND estrellas >= :estrellas ORDER BY nombre");
                $consulta->bindParam('provincia', $provincia);
                $consulta->bindParam('estrellas', $estrellas);
            } elseif ($provincia !== '') {
                $consulta=$pdo->prepare("SELECT * FROM hoteles WHERE provincia = :provincia ORDER BY nombre");
                $consulta->bindParam('provincia', $provincia);
            } elseif ($estrellas !== '') {
                $consulta=$pdo->prepare("SELECT * FROM hoteles WHERE estrellas >= :estrellas ORDER BY nombre");
                $consulta->bindParam('estrellas', $estrellas);
            } else {
                $consulta=$pdo->prepare("SELECT * FROM hoteles ORDER BY nombre");
            }
            $consulta->execute();
            $hoteles=$consulta->fetchall(PDO::FETCH_ASSOC);//Recuperamos el resultado de la consulta guardándolo en un array
            //Listado de Hoteles en forma de tabla
                if(count($hoteles)> 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Nombre</th>";
                    echo "<th>Provincia</th>";
                    echo "<th>Estrellas</th>";
                    echo "</tr>";

                    foreach($hoteles as $hotel) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($hotel['nombre']) ."</td>";
                        echo "<td>" . htmlspecialchars($hotel['provincia']) ."</td>";
                        echo "<td>" . htmlspecialchars($hotel['estrellas']) ."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<br><p>--No se han encontrado Hoteles--</p>";
                }          
        ?>
    </main>
    <?php
    $consulta = NULL;
    $pdo = NULL;
    ?>
<?php
include "footer.inc.php";
?>