    <?php
        $datos = explode("/", $_GET['views']);

	    if($_SESSION['id_pernos']!=mainModel::decryption($datos[1])){
		    echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-cogs"></i> &nbspActualizar Contraseña
        </h1>
    </div>


    <!-- Fila -->
    <div class="row">

        <!-- Editar Tipo Trabajador -->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

            <?php

                require_once "./controllers/userControlador.php";
                $classuser = new userControlador();

                $filesC = $classuser->datos_user_controlador("Unico",$datos[1]);

                if($filesC->rowCount()==1){
                    $campos = $filesC->fetch();
            ?>

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/userAjax.php" method="POST" data-form="update" autocomplete="off">

                        <input type="hidden" name="usuario_id_new" value="<?php echo $datos[1];?>">
                        <fieldset>
                            <legend><i class="fas fa-key"></i> &nbsp; Nueva Contraseña</legend>
                            
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="usuario_clave_1" class="bmd-label-floating">Contraseña Nueva &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="password" class="form-control" name="usuario_clave_1_new" id="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,16}" maxlength="16">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="usuario_clave_2" class="bmd-label-floating">Repita Contraseña &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="password" class="form-control" name="usuario_clave_2_new" id="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,16}" maxlength="16">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend><i class="fas fa-user-lock"></i> &nbsp; Confirmar Identidad</legend>
                            
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                                <label for="usuario_usuario" class="bmd-label-floating">Nombre de usuario &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-9]{4,20}" class="form-control" name="usuario_usuario_new" id="usuario_usuario" maxlength="20">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="usuario_clave_2" class="bmd-label-floating">Repita Contraseña Nueva &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="password" class="form-control" name="usuario_clave_new" id="usuario_clave" pattern="[a-zA-Z0-9$@.-]{7,16}" maxlength="16">
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