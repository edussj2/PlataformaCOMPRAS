    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-user-tag"></i> &nbsp; Tipo de Trabajadores
        </h1>
        <p class="text-gray-700 mb-4 text-justify">
            En el módulo TIPO DE TRABAJADORES usted podrá registrar los tipos de Trabajadores que servirán para identificar a los trabajadores que se registren y los módulos al que tendrán acceso. Además de lo antes mencionado, puede actualizar los datos de los tipo de trabajadores, realizar búsquedas de tipo de trabajadores o eliminarlas si así lo desea.
        </p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>positionNew/" class="text-gray-700 h5 text-uppercase activo">
                <i class="fas fa-user-tag"></i> &nbsp; Nuevo 
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>positionList/" class="text-gray-700 h5 text-uppercase">
                <i class="fas fa-list"></i> &nbsp; Lista
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>positionSearch/" class="text-gray-700 h5 text-uppercase">
                <i class="fas fa-search"></i> &nbsp; Buscar
            </a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Fila -->
    <div class="row">

        <!-- Nuevo Cargo -->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/cargoAjax.php" method="POST" data-form="save" autocomplete="off">

                            <fieldset>
                                <legend><i class="fas fa-server"></i> &nbsp; Información del Cargo</legend>
                                <div class="container-fluid mt-3">
                                    <div class="row">

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="cargo_nombre">Descripción &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-99áéíóúÁÉÍÓÚñÑ ]{3,40}" class="form-control" name="cargo_nombre_reg" id="cargo_nombre" maxlength="40">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="cargo_estado">Estado del Cargo</label>
                                                <select class="form-control" name="cargo_estado_reg" id="cargo_estado">
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
    <!-- End Fila -->