    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Almacén" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>  
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-box-open"></i> &nbspNuevo Producto</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo PRODUCTOS podrá agregar nuevos productos al sistema, actualizar datos de los productos, eliminar o actualizar la imagen de los productos, imprimir códigos de barras de cada producto, buscar productos en el sistema, ver todos los productos en almacén y filtrar productos por categoría.</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones2">
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productNew/" class="text-gray-700 activo h5"><i class="fas fa-box-open"></i> Nuevo Producto</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productList/" class="text-gray-700 h5"><i class="fas fa-dolly-flatbed"></i> Productos en Almacén</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productCategory/" class="text-gray-700 h5"><i class="fas fa-th-list"></i> Productos por Categoría</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productSearch/" class="text-gray-700 h5"><i class="fas fa-search"></i> Buscar Producto  </a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Agregar -->
    <div class="row">

        <!-- Nuevo Producto -->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/productoAjax.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">

                        <fieldset>
                            <legend><i class="fas fa-box"></i> &nbsp; Información del producto</legend>
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="producto_codigo" class="bmd-label-floating">Código  &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-9- ]{1,8}" class="form-control input-barcode" name="producto_codigo_reg" id="producto_codigo" maxlength="8">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="producto_nombre" class="bmd-label-floating">Nombre &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\- ]{1,40}" class="form-control" name="producto_nombre_reg" id="producto_nombre" maxlength="40">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="producto_stock_total" class="bmd-label-floating">Stock o existencias &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9]{1,11}" class="form-control" name="producto_stock_total_reg" id="producto_stock_total" maxlength="11">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="producto_stock_minimo" class="bmd-label-floating">Stock mínimo &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9]{1,11}" class="form-control" name="producto_stock_minimo_reg" id="producto_stock_minimo" maxlength="11">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group is-filled">
                                            <label for="producto_precio_compra" class="bmd-label-floating">Precio Uni. de compra &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9.]{1,20}" class="form-control" name="producto_precio_compra_reg" value="0.00" id="producto_precio_compra" maxlength="20">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group is-filled">
                                            <label for="producto_precio_venta" class="bmd-label-floating">Precio Uni. de venta &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9.]{1,20}" class="form-control" name="producto_precio_venta_reg" value="0.00" id="producto_precio_venta" maxlength="20">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-group">
                                            <label for="producto_diametro" class="bmd-label-floating">Diámetro</label>
                                            <input type="text" class="form-control" name="producto_diametro_reg" id="productodiametro maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-group">
                                            <label for="producto_longitud" class="bmd-label-floating">Longitud</label>
                                            <input type="text"  class="form-control" name="producto_longitud_reg" id="producto_longitud" maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="producto_modelo" class="bmd-label-floating">Modelo</label>
                                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,30}" class="form-control" name="producto_modelo_reg" id="producto_modelo" maxlength="30">
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
                                            <select class="form-control" name="producto_presentacion_reg" id="producto_presentacion">
                                                <option value="Sin Registro" selected="">Seleccione una opción</option>
                                            <?php 
                                                require_once "./controllers/presentacionControlador.php";

                                                $inspresentacion = new presentacionControlador();

                                                $presentacion = $inspresentacion->datos_presentacion_controlador("Select",0);
                                                $contador = 1;

                                                while ($rowD = $presentacion->fetch()) {
                                                    echo '<option value="'.$rowD['idPresentacion'].'">'.$contador.' - '.$rowD['descripcion'].'</option>';
                                                    $contador++;
                                                }
                                            ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group is-filled">
                                            <label for="producto_categoria" class="bmd-label-floating">Categoría &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <select class="form-control" name="producto_categoria_reg" id="producto_categoria">
                                                <option value="Sin Registro" selected="">Seleccione una opción</option>
                                            <?php 
                                                require_once "./controllers/categoriaControlador.php";

                                                $inscategoria = new categoriaControlador();

                                                $categoria = $inscategoria->datos_categoria_controlador("Select",0);
                                                $contador = 1;

                                                while ($rowD = $categoria->fetch()) {
                                                    echo '<option value="'.$rowD['idCategoria'].'">'.$contador.' - '.$rowD['nombre'].'('.$rowD['ubicacion'].')</option>';
                                                    $contador++;
                                                }
                                            ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group is-filled">
                                            <label for="producto_estado" class="bmd-label-floating">Estado del producto</label>
                                            <select class="form-control" name="producto_estado_reg" id="producto_estado">
                                                <option value="Habilitada" selected="">Habilitado</option>
                                                <option value="Deshabilitada">Deshabilitado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset>
                            <legend><i class="far fa-image"></i> &nbsp; Foto o imagen del producto</legend>
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="file" class="form-control-file" name="producto_foto_reg" accept=".jpg, .png, .jpeg" id="archivoInput" onchange="return validarExt()">
                                            <small class="text-muted">Tipos de archivos permitidos: JPG, JPEG, PNG. Tamaño máximo 3MB.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <p class="text-center" style="margin-top: 40px;">
                            <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
                            &nbsp; &nbsp;
                            <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                        </p>
                        <p class="text-center">
                            <small>Los campos marcados con &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp; son obligatorios</small>
                        </p>
                        <div class="RespuestaAjax"></div>
                    </form>
                    <!-- Formulario -->

                </div>
            </div>
        </div>
  
    </div> 
    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    
    ?>