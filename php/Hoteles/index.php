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
            $fichero="hoteles.txt";
            $hoteles=[];

            if (file_exists($fichero) or die ("No se encuentra el fichero.")) {

                foreach(file('hoteles.txt') as $linea) {
                    list($nombre,$provincia,$estrellas) = explode(';',$linea);
                    $hoteles[] = array(
                        'nombre'=> $nombre,
                        'provincia' => $provincia,
                        'estrellas' => (int)$estrellas
                    );         
                }
            }
            //Ordenar Hoteles por nombre
            usort($hoteles, function($item1, $item2) {
                return $item1["nombre"] <=> $item2["nombre"];
            });            
            //Filtro de Hoteles por provincia
            if(isset($_REQUEST['provincia']) && $_REQUEST['provincia'] != '') {
                $selprovincia = $_REQUEST['provincia'];
                $hoteles = array_filter($hoteles, function($hotel) use ($selprovincia) {
                    return $hotel['provincia'] == $selprovincia;
                });
            }
            //Filtro de Hoteles por estrellas
            if(isset($_REQUEST['estrellas']) && $_REQUEST['estrellas']!= '') {
                $selestrellas =  $_REQUEST['estrellas'];
                $hoteles = array_filter($hoteles, function($hotel) use ($selestrellas) {
                    return $hotel['estrellas'] >= $selestrellas;
                });
            }
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
include "footer.inc.php";
?>