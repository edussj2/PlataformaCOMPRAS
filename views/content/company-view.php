<?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-building"></i> &nbspDatos de la Empresa</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo EMPRESA usted puede registrar los datos de su compañía, negocio u organización. Una vez que registre los datos de su empresa solo podrá actualizarlos en caso quiera cambiar algún dato, ya no será necesario registrarlos nuevamente.</p>
    </div>

    <!-- Actualizar Empresa-->
    <div class="row">

        <!-- Actualizar Empresa-->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

                <?php

                require_once "./controllers/empresaControlador.php";
                $classempresa = new empresaControlador();

                $filesC = $classempresa->datos_empresa_controlador("Unico",1);

                if($filesC->rowCount()==1){
                    $campos = $filesC->fetch();
                ?>

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/empresaAjax.php" method="POST" data-form="update" autocomplete="off">

                            <input type="hidden" name="empresa_id_up" value="<?php echo mainModel::encryption(1)?>">
                            <fieldset>
                                <legend><i class="far fa-address-card"></i> &nbsp; Datos de la empresa</legend>
                                <div class="container-fluid mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="empresa_numero_documento" class="bmd-label-floating">RUC &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-9-]{10,15}" class="form-control" name="empresa_numero_documento_up" value="<?php echo $campos['ruc']; ?>" id="empresa_numero_documento" maxlength="15">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="empresa_razSocial" class="bmd-label-floating">Razón Social &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ., ]{4,60}" class="form-control" name="empresa_razSocial_up" value="<?php echo $campos['razSocial']; ?>" id="empresa_razSocial" maxlength="60">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="empresa_nombre" class="bmd-label-floating">Nombre Comercial &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ., ]{4,60}" class="form-control" name="empresa_nombre_up" value="<?php echo $campos['nomComercial']; ?>" id="empresa_nombre" maxlength="60">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="empresa_direccion" class="bmd-label-floating">Dirección &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,50}" class="form-control" name="empresa_direccion_up" value="<?php echo $campos['direccion']; ?>" id="empresa_direccion" maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <br><br><br>
                            <fieldset>
                                <legend><i class="fas fa-phone-volume"></i> &nbsp; Información de contacto</legend>
                                <div class="container-fluid mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="empresa_telefono" class="bmd-label-floating">Teléfono &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp; </label>
                                                <input type="text" pattern="[0-9()+]{8,9}" class="form-control" name="empresa_telefono_up" value="<?php echo $campos['telefono']; ?>" id="empresa_telefono" maxlength="9">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="empresa_email" class="bmd-label-floating">Email &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="email" class="form-control" name="empresa_email_up" value="<?php echo $campos['email']; ?>" id="empresa_email" maxlength="50">
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