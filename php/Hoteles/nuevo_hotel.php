<?php
include "cabecera.inc.php";
?>
    <header>
        <h1>Alta de nuevo Hotel</h1>
    </header>
    <main>
        <form action="guardar_hotel.php" method="post">
            <div class="col g-3">
                <div class="col-md-2">
                    <label class="form-label" for="nombre_hotel"></label>
                    <input class="form-control" type="text" name="nombre_hotel" id="nombre_hotel" placeholder="Nombre del Hotel" aria-label="Nombre del Hotel"><br>
                </div>
                <div class="row row-cols-auto gx-3">
                    <div class="col">
                        <label>Provincia: 
                            <select class="form-select form-select-sm" aria-label="Selecciona Provincia" name="provincia_hotel">
                                <option value="">Selecciona Provincia</option>
                                <option value="Alicante">Alicante</option>
                                <option value="Valencia">Valencia</option>
                                <option value="Málaga">Málaga</option>
                                <option value="Cádiz">Cádiz</option>
                            </select>
                        </label>
                    </div>
                    <div class="col">
                        <label>Estrellas: 
                            <select class="form-select form-select-sm" aria-label="Estrellas" name="estrellas_hotel">
                                <option value="" selected>--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select><br>
                        </label>
                    </div>
                </div>
                <div class="col-1 pt-2 d-grid col">
                    <input class="btn btn-primary" type="submit" value="Guardar">
                </div>
            </div>
        </form>
    </main>   
<?php
include "footer.inc.php";
?>