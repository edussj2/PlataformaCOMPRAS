    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-sync fa-fw"></i> &nbspActualizar Proveedor
        </h1>
    </div>
    <!-- Cabecera de página-->

    <!-- Regresar -->
    <div class="container-fluid">
        <p class="text-right">
            <a href="<?php echo SERVERURL ?>providerList/" class="btn btn-raised btn-info btn-go-back"><i class="fas fa-reply"></i> &nbsp; Regresar</a>
        </p>  
    </div>
    <!-- Regresar -->

    <!-- Fila -->
    <div class="row">

        <!-- Editar Tipo Trabajador -->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

            <?php

                $datos = explode("/", $_GET['views']);
                require_once "./controllers/proveedorControlador.php";
                $classproveedor = new proveedorControlador();

                $filesC = $classproveedor->datos_proveedor_controlador("Unico",$datos[1]);

                if($filesC->rowCount()==1){
                    $campos = $filesC->fetch();
            ?>

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/proveedorAjax.php" method="POST" data-form="update" autocomplete="off">

                        <input type="hidden" name="proveedor_id_up" value="<?php echo $datos[1];?>">
                        <fieldset>
                            <legend><i class="far fa-address-card"></i> &nbsp; Datos del proveedor</legend>
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="proveedor_tipo_documento" class="bmd-label-floating">Tipo de documento &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <select class="form-control" name="proveedor_tipo_documento_up" id="proveedor_tipo_documento" required>
                                                <option value="Sin Registro"> Seleccione un tipo de documento</option>
                                                <?php 
                                                    require_once "./controllers/documentoControlador.php";

                                                    $insDocumento = new documentoControlador();

                                                    $doc = $insDocumento->datos_documento_controlador("Select",0);
                                                    $contador = 1;

                                                    while ($rowD = $doc->fetch()) {
                                                        echo '<option value="'.$rowD['idDocumento'].'"'.($rowD['idDocumento']  == $campos['idDocumento'] ? 'selected' : '').'>'.$contador.' - '.$rowD['descripcion'].'</option>';
                                                        $contador++;
                                                    }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_numero_documento" class="bmd-label-floating">Numero de documento &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-9-]{7,15}" class="form-control" name="proveedor_numero_documento_up" id="proveedor_numero_documento" maxlength="15" required value="<?php echo $campos['numDocumento']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_nombre" class="bmd-label-floating">Razón Social &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ., ]{4,50}" class="form-control" name="proveedor_nombre_up" id="proveedor_nombre" maxlength="50" required value="<?php echo $campos['razSocial']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_direccion" class="bmd-label-floating">Dirección</label>
                                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,80}" class="form-control" name="proveedor_direccion_up" id="proveedor_direccion" maxlength="80" value="<?php echo $campos['direccion']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_cuenta" class="bmd-label-floating">Nº de Cuenta &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" class="form-control" name="proveedor_cuenta_up" id="proveedor_cuenta" maxlength="20" minlength="20" onkeypress="return valideKey(event);" value="<?php echo $campos['cuenta']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="proveedor_estado" class="bmd-label-floating">Estado &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <select class="form-control" name="proveedor_estado_up" id="proveedor_estado">
                                                    <option value="Habilitada" <?php if($campos['vigencia']=="Habilitada"){echo 'selected=""' ; }?>>1 - Habilitada</option>
                                                    <option value="Deshabilitada" <?php if($campos['vigencia']=="Deshabilitada"){echo 'selected=""' ; }?>>2 - Deshabilitada</option>
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
                                            <input type="text" pattern="[a-zA-Z ]{4,80}" class="form-control" name="proveedor_encargado_up" id="proveedor_encargado" maxlength="80" required value="<?php echo $campos['contNombres']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_telefono" class="bmd-label-floating">Teléfono &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9()+]{6,9}" class="form-control" name="proveedor_telefono_up" id="proveedor_telefono" maxlength="9" required value="<?php echo $campos['contTelefono']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_email" class="bmd-label-floating">Email</label>
                                            <input type="email" class="form-control" name="proveedor_email_up" id="proveedor_email" maxlength="50" value="<?php echo $campos['contEmail']; ?>">
                                        </div>
                                    </div> 
                                    
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="proveedor_puesto" class="bmd-label-floating">Puesto &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z ]{4,20}" class="form-control" name="proveedor_puesto_up" id="proveedor_puesto" maxlength="20" required value="<?php echo $campos['contPuesto']; ?>">
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