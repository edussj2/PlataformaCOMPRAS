    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>
    
    <?php 
        $fechaActual = date('Y-m-d');
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-shopping-basket"></i> &nbspNueva Compra</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo COMPRAS usted podrá registrar compras de productos ya sea nuevos o ya registrados en sistema. También puede ver la lista de todas las compras realizadas, buscar compras y ver información más detallada de cada compra..</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>shopNew/" class="text-gray-700 activo h5"><i class="fas fa-shopping-basket"></i> Nueva Compra</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>shopList/" class="text-gray-700 h5"><i class="fas fa-file-invoice-dollar"></i> Compras Realizadas</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>shopSearch/" class="text-gray-700 h5"><i class="fas fa-search-dollar"></i> Buscar Compra</a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Nueva Compra -->
    <div class="container-fluid">
        <div class="card shadow mb-5">
            <div class="card-body p-5">
                <div class="row justify-content-center">

                    <!-- Detalles -->
                    <div class="col-12 col-lg-9 p-3">
                        <p class="text-center">
                            <i class="fas fa-info"></i> &nbsp; Seleccione el producto a comprar, si no lo encuentra haga clic en <strong> <a href="<?php echo SERVERURL; ?>productNew/"> “Agregar Producto”</a></strong> para registrar un producto nuevo. Luego ingrese la cantidad y el precio unitario del producto.
                        </p>

                        <div class="container-fluid">
                        
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/detalleTempAjax.php" method="POST" data-form="save" autocomplete="off">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-8">
                                        <div class="form-group bmd-form-group">
                                            <label for="compra_producto_detalle" class="bmd-label-floating">Producto</label>
                                            <select name="compra_producto_detalle_reg" id="compra_producto_detalle" class="selectProducto form-control p-2" required>
                                                <option value="Sin Registro" selected="">Seleccione un producto</option>
                                                <?php 
                                                    require_once "./controllers/productoControlador.php";

                                                    $insproducto = new productoControlador();

                                                    $producto = $insproducto->datos_producto_controlador("Select",0);
                                                    $contador = 1;

                                                    while ($rowD = $producto->fetch()) {
                                                        echo '<option value="'.$rowD['idProducto'].'">'.$contador.' - '.$rowD['nombre'].'</option>';
                                                        $contador++;
                                                    }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="form-group bmd-form-group">
                                            <label for="compra_cantidad_detalle" class="bmd-label-floating">Cantidad</label>
                                            <input type="number" class="form-control" name="compra_cantidad_detalle_reg" id="compra_cantidad_detalle" maxlength="5" required>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="form-group bmd-form-group">
                                            <label for="compra_precio_detalle" class="bmd-label-floating">Precio Uni.</label>
                                            <input type="text" pattern="[0-9.]{1,10}" class="form-control" name="compra_precio_detalle_reg" value="0.00" id="compra_precio_detalle" maxlength="10" required>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-3 mb-3">
                                        <button type="submit" class="btn btn-outline-info"><i class="far fa-check-circle"></i> &nbsp; Agregar</button>
                                    </div>
                                </div>
                                <div class="RespuestaAjax"></div>
                            </form>

                        </div>
                        <hr>

                        <?php 
                            require_once "./controllers/detalleTempControlador.php";
                            $insdetalleTemp = new detalleTempControlador();
                            $pagina = explode("/", $_GET['views']);
			                echo $insdetalleTemp->paginador_detalleTemp_controlador($pagina[1],20,"");
                        ?>                          

                    </div>

                    <div class="col-12 col-lg-3 p-3 rounded shadow">
                        <h3 class="text-center text-uppercase">Datos de la compra</h3>
                        <hr>
                        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/compraAjax.php" method="POST" data-form="save" autocomplete="off">                       
                            
                            <div class="form-group bmd-form-group is-filled">
                                <label for="compra_fecha" class="bmd-label-static">Fecha &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                <input type="date" class="form-control input-barcode" name="compra_fecha_reg" id="compra_fecha" value="<?php echo $fechaActual?>" max="<?php echo $fechaActual?>">
                            </div>

                            <div class="form-group bmd-form-group is-filled">
                                <label for="compra_proveedor" class="bmd-label-floating">Proveedor &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                <select class="form-control" name="compra_proveedor_reg" id="compra_proveedor">
                                    <option value="Sin Registro" selected="">Seleccione un proveedor</option>
                                            <?php 
                                                require_once "./controllers/proveedorControlador.php";

                                                $insproveedor = new proveedorControlador();

                                                $proveedor = $insproveedor->datos_proveedor_controlador("Select",0);
                                                $contador = 1;

                                                while ($rowD = $proveedor->fetch()) {
                                                    echo '<option value="'.$rowD['idProveedor'].'">'.$contador.' - '.$rowD['razSocial'].'</option>';
                                                    $contador++;
                                                }
                                            ?>
                                </select>
                            </div>

                            <div class="form-group bmd-form-group is-filled">
                                <label for="compra_caja" class="bmd-label-floating">Caja &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                <select class="form-control" name="compra_caja_reg" id="compra_caja">
                                    <option value="Sin Registro" selected="">Seleccione un Caja</option>
                                            <?php 
                                                require_once "./controllers/cajaControlador.php";

                                                $inscaja = new cajaControlador();

                                                $caja = $inscaja->datos_caja_controlador("Select",0);
                                                $contador = 1;

                                                while ($rowD = $caja->fetch()) {
                                                    echo '<option value="'.$rowD['idCaja'].'">'.$contador.' - '.$rowD['descripcion'].'</option>';
                                                    $contador++;
                                                }
                                            ?>
                                </select>
                            </div>

                            <div class="form-group bmd-form-group is-filled">
                                <label for="compra_pago" class="bmd-label-floating">Tipo de pago &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                <select class="form-control" name="compra_pago_reg" id="compra_pago">
                                    <option value="Sin Registro" selected="">Seleccione Modalidad de pago</option>
                                            <?php 
                                                require_once "./controllers/formaPagoControlador.php";

                                                $insformaPago = new formaPagoControlador();

                                                $formaPago = $insformaPago->datos_formaPago_controlador("Select",0);
                                                $contador = 1;

                                                while ($rowD = $formaPago->fetch()) {
                                                    echo '<option value="'.$rowD['idTipoPago'].'">'.$contador.' - '.$rowD['descripcion'].'</option>';
                                                    $contador++;
                                                }
                                            ?>
                                </select>
                            </div>

                            <ul class="list-group list-unstyled">
                                <?php 
                                    require_once "./controllers/detalleTempControlador.php";

                                    $insdetalleTemp = new detalleTempControlador();

                                    $detalleTemp = $insdetalleTemp->datos_detalleTemp_controlador("Monto",0);
                                    $subTotalGeneral = 0.0;

                                    while ($rowD = $detalleTemp->fetch()) {
                                        $subTotalGeneral = $subTotalGeneral + $rowD['subtotal'];
                                    }
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Subtotal
                                    <span class="badge badge-pill">S/ <?php echo $subTotalGeneral; ?> SOLES</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    IGV (10%)
                                    <span class="badge badge-pill">S/ <?php $igv = $subTotalGeneral * 0.10; echo $igv;?> SOLES</span>
                                </li>
                                <li><hr></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total
                                    <span class="badge badge-pill">S/ <?php $totalGeneral = $subTotalGeneral + $igv; echo $totalGeneral; ?> SOLES</span>
                                </li>
                            </ul>


                            <input type="hidden" name="compra_usuario_reg" value="<?php echo mainModel::encryption($_SESSION['id_pernos']);?>">

                            <input type="hidden" name="compra_subtotal_reg" value="<?php echo $subTotalGeneral;?>">

                            <input type="hidden" name="compra_total_reg" value="<?php echo $totalGeneral;?>">
                            
                            <?php 
                                require_once "./controllers/detalleTempControlador.php";

                                $insdetalleTemp = new detalleTempControlador();

                                $detalleTemp = $insdetalleTemp->datos_detalleTemp_controlador("Conteo",0);

                                if($detalleTemp->rowCount()>=1){
                            ?>
                            <p class="text-center" style="margin-top: 40px;">
                                <button type="submit" class="btn" style="background:#03a9f4; color:#fff"><i class="far fa-save"></i> &nbsp; GUARDAR COMPRA</button>
                            </p>
                            <?php 
                                }
                            ?>
                            <p class="text-center">
                                <small>Los campos marcados con &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp; son obligatorios</small>
                            </p>
                            <div class="RespuestaAjax"></div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.selectProducto').select2();
    });
    </script>

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?> 