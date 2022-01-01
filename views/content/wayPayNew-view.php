<?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="far fa-credit-card"></i> &nbsp; Tipo de Pagos</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo TIPO DE PAGOS usted podrá registrar los Tipo de Pagos que se registren las ventas. Además de lo antes mencionado, puede actualizar los datos de los cargos, realizar búsquedas de cargos o eliminarlas si así lo desea.</p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>wayPayNew/" class="text-gray-700 h5 text-uppercase activo"><i class="far fa-credit-card"></i> &nbsp; NUEVO</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>wayPayList/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>wayPaySearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar</a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Content Fila -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/formaPagoAjax.php" method="POST" data-form="save" autocomplete="off">

                            <fieldset>
                                <legend><i class="fas fa-server"></i> &nbsp; Información de la forma de pago</legend>
                                <div class="container-fluid mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="form-group bmd-form-group">
                                                <label for="forma_pago_nombre">Descripción &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-99áéíóúÁÉÍÓÚñÑ ]{3,20}" class="form-control" name="forma_pago_nombre_reg" id="forma_pago_nombre" maxlength="20">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group bmd-form-group">
                                                <label for="forma_pago_icono">Icono &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="{3,50}" class="form-control" name="forma_pago_icono_reg" id="forma_pago_icono" maxlength="50">
                                                <div id="forma_pago_icono" class="form-text">Use la página de FontAwesome.</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="forma_pago_estado">Estado de la categoría</label>
                                                <select class="form-control" name="forma_pago_estado_reg" id="forma_pago_estado">
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
    <!-- Content Fila -->