    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-sync fa-fw"></i> &nbspActualizar Tipo de Trabajador
        </h1>
    </div>

    <div class="container-fluid">
        <p class="text-right">
            <a href="<?php echo SERVERURL ?>positionList/" class="btn btn-raised btn-info btn-go-back"><i class="fas fa-reply"></i> &nbsp; Regresar</a>
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
                require_once "./controllers/cargoControlador.php";
                $classCargo = new cargoControlador();

                $filesC = $classCargo->datos_cargo_controlador("Unico",$datos[1]);

                if($filesC->rowCount()==1){
                    $campos = $filesC->fetch();
            ?>

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/cargoAjax.php" method="POST" data-form="update" autocomplete="off">

                        <input type="hidden" name="cargo_id_up" value="<?php echo $datos[1];?>">
                        <fieldset>
                            <legend><i class="fas fa-server"></i> &nbsp; Información del Cargo</legend>
                            <div class="container-fluid mt-3">
                                <div class="row">

                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="cargo_nombre" class="bmd-label-floating">Descripción &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-99áéíóúÁÉÍÓÚñÑ ]{3,40}" class="form-control" name="cargo_nombre_up" value="<?php echo $campos['descripcion']?>" id="cargo_nombre" maxlength="40">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="cargo_estado" class="bmd-label-floating">Estado del Cargo</label>
                                            <select class="form-control" name="cargo_estado_up" id="cargo_estado">
                                                <option value="Habilitada" <?php if($campos['vigencia']=="Habilitada"){echo 'selected=""' ; }?>>1 - Habilitada (Actual)</option>
                                                <option value="Deshabilitada" <?php if($campos['vigencia']=="Deshabilitada"){echo 'selected=""' ; }?>>2 - Deshabilitado<option>                            
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