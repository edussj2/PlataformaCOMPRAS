    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Almacén" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-sync fa-fw"></i> &nbspActualizar Producto
        </h1>
    </div>

    <div class="container-fluid">
        <p class="text-right">
            <a href="<?php echo SERVERURL ?>productList/" class="btn btn-raised btn-info btn-go-back"><i class="fas fa-reply"></i> &nbsp; Regresar</a>
        </p>  
    </div>

    <!-- Fila -->
    <div class="row">

        <!-- Editar Tipo Trabajador -->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

            <?php

                $datos = explode("/", $_GET['views']);
                require_once "./controllers/productoControlador.php";
                $classproducto = new productoControlador();

                $filesP = $classproducto->datos_producto_controlador("Unico",$datos[1]);

                if($filesP->rowCount()==1){
                    $campos = $filesP->fetch();
            ?>

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/productoAjax.php" method="POST" data-form="update" autocomplete="off">

                        <input type="hidden" name="producto_id_up" value="<?php echo $datos[1];?>">
                        
                        <fieldset>
                            <legend><i class="fas fa-box"></i> &nbsp; Información del producto</legend>
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="producto_codigo" class="bmd-label-floating">Código  &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-9- ]{1,70}" class="form-control input-barcode" name="producto_codigo_up" id="producto_codigo" maxlength="70" value="<?php echo $campos['codigo']?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="producto_nombre" class="bmd-label-floating">Nombre &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\- ]{1,40}" class="form-control" name="producto_nombre_up" id="producto_nombre" maxlength="40" value="<?php echo $campos['nombre']?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="producto_stock_total" class="bmd-label-floating">Stock o existencias &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9]{1,11}" class="form-control" name="producto_stock_total_up" id="producto_stock_total" maxlength="11" value="<?php echo $campos['stockTotal']?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="producto_stock_minimo" class="bmd-label-floating">Stock mínimo &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9]{1,11}" class="form-control" name="producto_stock_minimo_up" id="producto_stock_minimo" maxlength="11" value="<?php echo $campos['stockMinimo']?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group is-filled">
                                            <label for="producto_precio_compra" class="bmd-label-floating">Precio Uni. de compra &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9.]{1,20}" class="form-control" name="producto_precio_compra_up"  id="producto_precio_compra" maxlength="20" value="<?php echo $campos['precioCompra']?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group is-filled">
                                            <label for="producto_precio_venta" class="bmd-label-floating">Precio Uni. de venta &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9.]{1,20}" class="form-control" name="producto_precio_venta_up" id="producto_precio_venta" maxlength="20" value="<?php echo $campos['precioVenta']?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="producto_diametro" class="bmd-label-floating">Diámetro</label>
                                            <input type="text" class="form-control input-barcode" name="producto_diametro_up" id="producto_diametro" maxlength="30" value="<?php echo $campos['diametro']?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="producto_longitud" class="bmd-label-floating">Longitud</label>
                                            <input type="text" class="form-control input-barcode" name="producto_longitud_up" id="producto_longitud" maxlength="30" value="<?php echo $campos['longitud']?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="producto_modelo" class="bmd-label-floating">Modelo</label>
                                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,30}" class="form-control input-barcode" name="producto_modelo_up" id="producto_modelo" maxlength="30" value="<?php echo $campos['modelo']?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset>
                            <legend><i class="fas fa-truck-loading"></i> &nbsp; Presentación, categoría &amp; estado</legend>
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group is-filled">
                                            <label for="producto_presentacion" class="bmd-label-floating">Presentación del producto &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <select class="form-control" name="producto_presentacion_up" id="producto_presentacion">
                                                <option value="Sin Registro" selected="">Seleccione una opción</option>
                                            <?php 
                                                require_once "./controllers/presentacionControlador.php";

                                                $inspresentacion = new presentacionControlador();

                                                $presentacion = $inspresentacion->datos_presentacion_controlador("Select",0);
                                                $contador = 1;

                                                while ($rowD = $presentacion->fetch()) {
                                                    echo '<option value="'.$rowD['idPresentacion'].'"'.($rowD['idPresentacion']  == $campos['idPresentacion'] ? 'selected' : '').'>'.$contador.' - '.$rowD['descripcion'].'</option>';
                                                    $contador++;
                                                }
                                            ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group is-filled">
                                            <label for="producto_categoria" class="bmd-label-floating">Categoría &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <select class="form-control" name="producto_categoria_up" id="producto_categoria">
                                                <option value="Sin Registro" selected="">Seleccione una opción</option>
                                            <?php 
                                                require_once "./controllers/categoriaControlador.php";

                                                $inscategoria = new categoriaControlador();

                                                $categoria = $inscategoria->datos_categoria_controlador("Select",0);
                                                $contador = 1;

                                                while ($rowD = $categoria->fetch()) {
                                                    echo '<option value="'.$rowD['idCategoria'].'"'.($rowD['idCategoria']  == $campos['idCategoria'] ? 'selected' : '').'>'.$contador.' - '.$rowD['nombre'].'</option>';
                                                    $contador++;
                                                }
                                            ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group is-filled">
                                            <label for="producto_estado" class="bmd-label-floating">Estado del producto</label>
                                            <select class="form-control" name="producto_estado_up" id="producto_estado">
                                                    <option value="Habilitada" <?php if($campos['estado']=="Habilitada"){echo 'selected=""' ; }?>>1 - Habilitada</option>
                                                    <option value="Deshabilitada" <?php if($campos['estado']=="Deshabilitada"){echo 'selected=""' ; }?>>2 - Deshabilitada</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <p class="text-center" style="margin-top: 40px;">
                            <button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync"></i> &nbsp; ACTUALIZAR</button>
                        </p>
                        <p class="text-center">
                            <small>Los campos marcados con &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp; son obligatorios</small>
                        </p>
                        <div class="RespuestaAjax"></div>
                    </form>
                    <!-- End Formulario -->
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