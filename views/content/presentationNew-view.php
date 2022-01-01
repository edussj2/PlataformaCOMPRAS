    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fab fa-product-hunt"></i> &nbsp; Presentaciones</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo PRESENTACIONES usted podrá registrar las Presentaciones que servirán para identificar a los productos que se registren. Además de lo antes mencionado, puede actualizar los datos de los Presentaciones, realizar búsquedas de Presentaciones o eliminarlas si así lo desea.</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>presentationNew/" class="text-gray-700 h5 text-uppercase activo"><i class="fab fa-product-hunt"></i> &nbsp; Nuevo
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>presentationList/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>presentationSearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar
            </a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Fila -->
    <div class="row">

        <!-- Nuevo Presentacion -->
        <div class="col-12">
            <div class="card shadow mb-5">
                <div class="card-body">

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/presentacionAjax.php" method="POST" data-form="save" autocomplete="off">
                            <fieldset>
                                <legend><i class="fas fa-server"></i> &nbsp; Información de la Presentación</legend>
                                <div class="container-fluid mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="presentacion_nombre">Descripción &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-99áéíóúÁÉÍÓÚñÑ ]{3,20}" class="form-control" name="presentacion_nombre_reg" id="presentacion_nombre" maxlength="20">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="presentacion_estado">Estado de la presentación</label>
                                                <select class="form-control" name="presentacion_estado_reg" id="presentacion_estado">
                                                    <option value="Habilitada" selected="">Habilitada</option>
                                                    <option value="Deshabilitada">Deshabilitada</option>
                                                </select>
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

                </div>
            </div>
        </div>
  
    </div>
    <!-- Fila -->