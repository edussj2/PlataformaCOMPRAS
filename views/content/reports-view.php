    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Logística"){
            $fechaActual=date('Y-m-d');
    ?>   
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-file-csv"></i> &nbsp;Reportes en Excel</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo REPORTES ustes puede generar archivos de excel de los datos registrados en el sistema.</p>
    </div>

    <div class="border-left-danger border p-4 rounded mt-5">
        <h4 class="text-center">Generar reporte de inventario personalizado</h4>
        <form action="<?php echo SERVERURL;?>reports/report_inventory.php" method="POST" autocomplete="off">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group bmd-form-group is-filled">
                            <label for="orden_reporte_inventario" class="bmd-label-floating">Ordenar por</label>
                            <select class="form-control" name="orden_reporte_inventario" id="orden_reporte_inventario" required>
                                <option value="nasc" selected="">Nombre (ascendente)</option>
                                <option value="ndesc">Nombre (descendente)</option>
                                <option value="sasc">Stock (menor - mayor)</option>
                                <option value="sdesc">Stock (mayor - menor)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="text-center" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-danger"> &nbsp; GENERAR REPORTE</button>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="border-left-warning border p-4 rounded mt-5">
        <h4 class="text-center">Generar reporte de compras por fechas</h4>
        <form action="<?php echo SERVERURL;?>reports/report_shop_date.php" method="POST" autocomplete="off">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group bmd-form-group is-filled">
                            <label for="fecha_reporte1_compra" class="bmd-label-floating">Rango de Fechas:</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="date" name="fecha1_reporte_compra" id="fecha_reporte_compra" class="form-control"  max="<?php echo $fechaActual; ?>" required>
                                </div>
                                <div class="col-6">
                                    <input type="date" name="fecha2_reporte_compra" id="fecha_reporte_compra" class="form-control" max="<?php echo $fechaActual; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="text-center" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-warning"> &nbsp; GENERAR REPORTE</button>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <?php if($_SESSION['tipo_pernos'] == "Administrador"){?>
    <div class="border-left-primary border p-4 rounded mt-5">
        <h4 class="text-center">Generar reporte de compras por Trabajador</h4>
        <form action="<?php echo SERVERURL;?>reports/report_shop_user.php" method="POST" autocomplete="off">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group bmd-form-group is-filled">
                            <label for="trabajador_reporte_compra" class="bmd-label-floating">Trabajador</label>
                            <select class="form-control" name="trabajador_reporte_compra" id="trabajador_reporte_compra" required>
                                <?php 
                                    require_once "./controllers/userControlador.php";

                                    $insusuario = new userControlador();

                                    $usuario = $insusuario->datos_user_controlador("Logistica",0);
                                    $contador = 1;

                                    while ($rowD = $usuario->fetch()) {
                                        echo '<option value="'.$rowD['idUsuario'].'">'.$contador.' - '.$rowD['nombres'].' '.$rowD['apellidos'].'</option>';
                                        $contador++;
                                    }
                                ?> 
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="text-center" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary"> &nbsp; GENERAR REPORTE</button>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php } ?>

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>