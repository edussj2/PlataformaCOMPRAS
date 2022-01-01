    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Almacén" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>
    <!-- Regresar -->
    <div class="container-fluid">
        <p class="text-right">
            <a href="<?php echo SERVERURL ?>productList/" class="btn btn-raised btn-info btn-go-back"><i class="fas fa-reply"></i> &nbsp; Regresar</a>
        </p>  
    </div>
    
    <!-- Cabecera de página-->
    <div class="m-3 text-center">
        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-box-open"></i> &nbsp;Información del Producto</h1>
    </div>

    <!-- Fila -->
    <div class="row">

        <!-- VER PRODUCTO -->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

            <?php

                $datos = explode("/", $_GET['views']);
                require_once "./controllers/productoControlador.php";
                $clasproducto = new productoControlador();

                $filesC = $clasproducto->datos_producto_controlador("Unico",$datos[1]);

                if($filesC->rowCount()==1){
                    $campos = $filesC->fetch();

                    require_once "./controllers/categoriaControlador.php";
                    $clascategoria = new categoriaControlador();
                    $filesCAT = $clascategoria->datos_categoria_controlador("Unico",mainModel::encryption($campos['idCategoria']));
                    $camposC = $filesCAT->fetch();

                    require_once "./controllers/presentacionControlador.php";
                    $claspresentacion = new presentacionControlador();
                    $filesPRE = $claspresentacion->datos_presentacion_controlador("Unico",mainModel::encryption($campos['idPresentacion']));
                    $camposP = $filesPRE->fetch();
            ?>

                <div>
                    <h3 class="text-center text-info"><?php echo $campos['nombre']?></h3>
                    <hr>
                    <fieldset>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-4 align-self-center">
                                    <figure>
                                        <img class="img-fluid img-product-info" src="<?php echo SERVERURL; ?>files/<?php echo $campos['imagen'];?>" alt="<?php echo $campos['nombre'];?>">                        
                                    </figure>
                                </div>
                                <div class="col-12 col-md-8">
                                    <legend class="text-center"><i class="fas fa-box"></i> &nbsp; Información del producto</legend>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_codigo" class="bmd-label-floating"><i class="fas fa-barcode"></i> &nbsp; Código</label>
                                                    <input type="text" value="<?php echo $campos['codigo'];?>" class="form-control" id="producto_codigo" readonly="">
                                                </div>
                                            </div> 
                                            <div class="col-12 col-md-6">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_nombre" class="bmd-label-floating"><i class="fas fa-file-signature"></i> &nbsp; Nombre</label>
                                                    <input type="text" value="<?php echo $campos['nombre'];?>" class="form-control" id="producto_nombre" readonly="">
                                                </div>
                                            </div> 
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_stock_total" class="bmd-label-floating">Stock o existencias</label>
                                                    <input type="text" value="<?php echo $campos['stockTotal'];?>" class="form-control" id="producto_stock_total" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_stock_minimo" class="bmd-label-floating">Stock mínimo</label>
                                                    <input type="text" value="<?php echo $campos['stockMinimo'];?>" class="form-control" id="producto_stock_minimo" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_precio_compra" class="bmd-label-floating">Precio U. de compra</label>
                                                    <input type="text" value="S/ <?php echo $campos['precioCompra'];?>" class="form-control" id="producto_precio_compra" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_precio_venta" class="bmd-label-floating">Precio U. de venta</label>
                                                    <input type="text" value="S/ <?php echo $campos['precioVenta'];?>" class="form-control" id="producto_precio_venta" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_diametro" class="bmd-label-floating">Diámetro</label>
                                                    <input type="text" value="<?php echo $campos['diametro'];?>" class="form-control" id="producto_diametro" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_longitud" class="bmd-label-floating">Longitud</label>
                                                    <input type="text" value="<?php echo $campos['longitud'];?>" class="form-control" id="producto_longitud" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_modelo" class="bmd-label-floating">Modelo</label>
                                                    <input type="text" value="<?php echo $campos['modelo'];?>" class="form-control" id="producto_modelo" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_proveedor" class="bmd-label-floating">Presentación</label>
                                                    <input type="text" value="<?php echo $camposP['descripcion'];?>" class="form-control" id="producto_proveedor" readonly="">                        
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_categoria" class="bmd-label-floating">Categoría</label>
                                                    <input type="text" value="<?php echo $camposC['nombre'];?>" class="form-control" id="producto_categoria" readonly="">                        
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label for="producto_estado" class="bmd-label-floating">Estado del producto</label>
                                                    <input type="text" value="<?php echo $campos['estado'];?>" class="form-control" id="producto_estado" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset> 
                    <br><br>
                    <fieldset>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center">
                                        <label for="producto_codigo">Código de barras</label><br>
                                        <svg id="codigo_barras" width="222px" height="142px" x="0px" y="0px" viewBox="0 0 222 142" xmlns="http://www.w3.org/2000/svg" version="1.1" style="transform: translate(0px, 0px);"><rect x="0" y="0" width="222" height="142" style="fill:#ffffff;"></rect><g transform="translate(10, 10)" style="fill:#000000;"><rect x="0" y="0" width="4" height="100"></rect><rect x="6" y="0" width="2" height="100"></rect><rect x="12" y="0" width="6" height="100"></rect><rect x="22" y="0" width="2" height="100"></rect><rect x="26" y="0" width="4" height="100"></rect><rect x="34" y="0" width="6" height="100"></rect><rect x="44" y="0" width="2" height="100"></rect><rect x="52" y="0" width="2" height="100"></rect><rect x="56" y="0" width="4" height="100"></rect><rect x="66" y="0" width="6" height="100"></rect><rect x="78" y="0" width="2" height="100"></rect><rect x="82" y="0" width="4" height="100"></rect><rect x="88" y="0" width="6" height="100"></rect><rect x="96" y="0" width="2" height="100"></rect><rect x="100" y="0" width="8" height="100"></rect><rect x="110" y="0" width="2" height="100"></rect><rect x="118" y="0" width="4" height="100"></rect><rect x="124" y="0" width="6" height="100"></rect><rect x="132" y="0" width="2" height="100"></rect><rect x="136" y="0" width="2" height="100"></rect><rect x="144" y="0" width="4" height="100"></rect><rect x="154" y="0" width="2" height="100"></rect><rect x="158" y="0" width="4" height="100"></rect><rect x="164" y="0" width="6" height="100"></rect><rect x="176" y="0" width="4" height="100"></rect><rect x="186" y="0" width="6" height="100"></rect><rect x="194" y="0" width="2" height="100"></rect><rect x="198" y="0" width="4" height="100"></rect><text style="font: 20px monospace" text-anchor="middle" x="101" y="122">123456LA</text></g></svg>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                </div>
            <?php 
                }else{
            ?>
                <div class="alert alert-dimissible alert-warning text-center border mt-3">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <i class="fas fa-exclamation-triangle" style="font-size:4rem;"></i>
                    <h4>!LO SENTIMOS!</h4>
                    <p>No pudimos mostrar la información buscada</p>
                </div>
            <?php   
                }
            ?> 

                </div>
            </div>
        </div>
  
    </div>
    <!-- End Fila --> 

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>  