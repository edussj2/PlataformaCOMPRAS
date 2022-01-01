    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-cash-register"></i> &nbsp; Cajas</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo CAJAS usted podrá registrar cajas de ventas en el sistema para poder realizar ventas, además podrá actualizar los datos de las cajas de venta, realizar búsquedas de cajas o eliminarlas si lo desea.</p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>cashierNew/" class="text-gray-700 h5 text-uppercase activo"><i class="fas fa-cash-register"></i> &nbsp; Nuevo
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>cashierList/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>cashierSearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar
            </a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Fila -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/cajaAjax.php" method="POST" data-form="save" autocomplete="off">
                            <fieldset>
                                <legend><i class="fas fa-server"></i> &nbsp; Información de la caja</legend>
                                <div class="container-fluid mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="caja_numero" class="bmd-label-floating">Número de caja &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[0-9]{1,5}" class="form-control" name="caja_numero_reg" id="caja_numero" maxlength="5">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="caja_nombre" class="bmd-label-floating">Nombre o código de caja &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ:# ]{3,40}" class="form-control" name="caja_nombre_reg" id="caja_nombre" maxlength="40">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="caja_estado" class="bmd-label-floating">Estado de la caja</label>
                                                <select class="form-control" name="caja_estado_reg" id="caja_estado">
                                                    <option value="Habilitada" selected="">Habilitada</option>
                                                    <option value="Deshabilitada">Deshabilitada</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="caja_efectivo" class="bmd-label-floating">Efectivo en caja &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[0-9.]{1,25}" class="form-control" name="caja_efectivo_reg" value="0.00" id="caja_efectivo" maxlength="25">
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