    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-truck-moving"></i> &nbsp; Proveedores
        </h1>
        <p class="text-gray-700 mb-4 text-justify">
            En el módulo PROVEEDORES usted podrá registrar los proveedores de productos a los cuales usted les compra productos o mercancía. Además, podrá actualizar los datos de los proveedores, ver todos los proveedores registrados en el sistema, buscar proveedores en el sistema o eliminarlos si así lo desea.
        </p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>providerNew/" class="text-gray-700 h5 text-uppercase activo"><i class="fas fa-truck-moving"></i> &nbsp; Nuevo</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>providerList/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>providerSearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar</a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Content Fila -->
    <div class="row">

        <!-- Nuevo PROVEEDOR -->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/proveedorAjax.php" method="POST" data-form="save" autocomplete="off">

                        <fieldset>
                            <legend><i class="far fa-address-card"></i> &nbsp; Datos del proveedor</legend>
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="proveedor_tipo_documento" class="bmd-label-floating">Tipo de documento &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <select class="form-control" name="proveedor_tipo_documento_reg" id="proveedor_tipo_documento" required>
                                                <option value="Sin Registro"> Seleccione un tipo de documento</option>
                                                <?php 
                                                    require_once "./controllers/documentoControlador.php";

                                                    $insDocumento = new documentoControlador();

                                                    $doc = $insDocumento->datos_documento_controlador("Select",0);
                                                    $contador = 1;

                                                    while ($rowD = $doc->fetch()) {
                                                            echo '<option value="'.$rowD['idDocumento'].'">'.$contador.' - '.$rowD['descripcion'].'</option>';
                                                            $contador++;
                                                    }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_numero_documento" class="bmd-label-floating">Numero de documento &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-9-]{7,15}" class="form-control" name="proveedor_numero_documento_reg" id="proveedor_numero_documento" maxlength="15" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_nombre" class="bmd-label-floating">Razón Social &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ., ]{4,50}" class="form-control" name="proveedor_nombre_reg" id="proveedor_nombre" maxlength="50" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_direccion" class="bmd-label-floating">Dirección</label>
                                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,80}" class="form-control" name="proveedor_direccion_reg" id="proveedor_direccion" maxlength="80">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_cuenta" class="bmd-label-floating">Nº de Cuenta &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" class="form-control" name="proveedor_cuenta_reg" id="proveedor_cuenta" maxlength="20" minlength="20" onkeypress="return valideKey(event);">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="proveedor_estado" class="bmd-label-floating">Estado &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <select class="form-control" name="proveedor_estado_reg" id="proveedor_estado">
                                                <option value="Habilitada" selected="">1 - Habilitado</option>
                                                <option value="Deshabilitada">2 - Deshabilitado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend><i class="fas fa-phone-volume"></i> &nbsp; Información de contacto</legend>
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_encargado" class="bmd-label-floating">Nombre del encargado &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z ]{4,80}" class="form-control" name="proveedor_encargado_reg" id="proveedor_encargado" maxlength="80" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_telefono" class="bmd-label-floating">Teléfono &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9()+]{6,9}" class="form-control" name="proveedor_telefono_reg" id="proveedor_telefono" maxlength="9" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_email" class="bmd-label-floating">Email</label>
                                            <input type="email" class="form-control" name="proveedor_email_reg" id="proveedor_email" maxlength="50">
                                        </div>
                                    </div> 
                                    
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_puesto" class="bmd-label-floating">Puesto &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z ]{4,20}" class="form-control" name="proveedor_puesto_reg" id="proveedor_puesto" maxlength="20" required>
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