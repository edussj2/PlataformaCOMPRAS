    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-sync fa-fw"></i> &nbspActualizar Caja
        </h1>
    </div>
    <!-- Cabecera de página-->

    <!--Regresar-->
    <div class="container-fluid">
        <p class="text-right">
            <a href="<?php echo SERVERURL ?>cashierList/" class="btn btn-raised btn-info btn-go-back"><i class="fas fa-reply"></i> &nbsp; Regresar</a>
        </p>  
    </div>
    <!--Regresar-->
    
    <!-- Fila -->
    <div class="row">

        <!-- Editar Tipo Trabajador -->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

            <?php

                $datos = explode("/", $_GET['views']);
                require_once "./controllers/cajaControlador.php";
                $classcaja = new cajaControlador();

                $filesC = $classcaja->datos_caja_controlador("Unico",$datos[1]);

                if($filesC->rowCount()==1){
                    $campos = $filesC->fetch();
            ?>

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/cajaAjax.php" method="POST" data-form="update" autocomplete="off">

                        <input type="hidden" name="caja_id_up" value="<?php echo $datos[1];?>">
                        <fieldset>
                            <legend><i class="far fa-address-card"></i> &nbsp; Información de la caja</legend>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="caja_numero" class="bmd-label-floating">Numero de caja &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9]{1,5}" class="form-control" name="caja_numero_up" value="<?php echo $campos['numero'];?>" id="caja_numero" maxlength="5">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="caja_nombre" class="bmd-label-floating">Nombre o código de caja &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ:# ]{3,70}" class="form-control" name="caja_nombre_up" value="<?php echo $campos['descripcion'];?>" id="caja_nombre" maxlength="70">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="caja_estado" class="bmd-label-floating">Estado de la Caja</label>
                                            <select class="form-control" name="caja_estado_up" id="documento_estado">
                                                <option value="Habilitada" <?php if($campos['vigencia']=="Habilitada"){echo 'selected=""' ; }?>>1 - Habilitada (Actual)</option>
                                                <option value="Deshabilitada" <?php if($campos['vigencia']=="Deshabilitada"){echo 'selected=""' ; }?>>2 - Deshabilitado<option>                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="caja_efectivo" class="bmd-label-floating">Efectivo en caja</label>
                                            <input type="text" pattern="[0-9.]{1,25}" class="form-control" name="caja_efectivo_up" value="<?php echo $campos['efectivo'];?>" id="caja_efectivo" maxlength="25">
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