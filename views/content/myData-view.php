<?php
        $datos = explode("/", $_GET['views']);

	    if($_SESSION['id_pernos']!=mainModel::decryption($datos[1])){
		    echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-user"></i> &nbspActualizar Mis Datos
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
                                <input type="hidden" name="usuario_id_up2" value="<?php echo $datos[1];?>">
                                <legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
                                <div class="container-fluid mt-3">
                                    <div class="row">

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="usuario_tipo_documento" class="bmd-label-floating">Tipo de documento &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <select class="form-control" name="usuario_tipo_documento_up2" id="usuario_tipo_documento" disabled>
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

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_numero_documento" class="bmd-label-floating">Numero de documento &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-9-]{7,15}" class="form-control" name="usuario_numero_documento_up2" id="usuario_numero_documento" maxlength="15" value="<?php echo $campos['numDocumento']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_nombre" class="bmd-label-floating">Nombres &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}" class="form-control" name="usuario_nombre_up2" id="usuario_nombre" maxlength="35" value="<?php echo $campos['nombres']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_apellido" class="bmd-label-floating">Apellidos &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,50}" class="form-control" name="usuario_apellido_up2" id="usuario_apellido" maxlength="50" value="<?php echo $campos['apellidos']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_telefono" class="bmd-label-floating">Teléfono</label>
                                                <input type="text" pattern="[0-9()+]{8,9}" class="form-control" name="usuario_telefono_up2" id="usuario_telefono" maxlength="9" value="<?php echo $campos['telefono']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <legend><i class="fas fa-user-friends"></i> &nbsp; Genero</legend>
                                            <div class="form-group bmd-form-group is-filled">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="usuario_genero_up2" value="Masculino" <?php if($campos['genero']=="Masculino"){echo 'checked=""' ; }?>><span class="bmd-radio"></span>
                                                        <i class="fas fa-male fa-fw"></i> &nbsp; Masculino
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="usuario_genero_up2" value="Femenino" <?php if($campos['genero']=="Femenino"){echo 'checked=""' ; }?>><span class="bmd-radio"></span>
                                                        <i class="fas fa-female fa-fw"></i> &nbsp; Femenino
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </fieldset>
                            
                        <fieldset>
                                <legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
                                <div class="container-fluid mt-3">
                                    <div class="row">

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_usuario" class="bmd-label-floating">Nombre de usuario &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-9]{4,20}" class="form-control" name="usuario_usuario_up2" id="usuario_usuario" maxlength="20" value="<?php echo $campos['usuario']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_email" class="bmd-label-floating">Email</label>
                                                <input type="email" class="form-control" name="usuario_email_up2" id="usuario_email" maxlength="50" value="<?php echo $campos['email']; ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </fieldset>
                        <br>

                        <fieldset>
                                <div class="container-fluid">
                                <legend><i class="fas fa-portrait"></i> &nbsp; Avatar</legend>
                                    <div class="row mt-3">
                                        
                                                        <div class="col-6 col-md-4 col-lg-2">
                                                            <div class="radio radio-avatar-form">
                                                                <label>
                                                                    <input type="radio" name="usuario_avatar_up2" value="avatar1.png" <?php if($campos['avatar']=="avatar1.png"){echo 'checked=""' ; }?>>
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar1.png" class="img-fluid img-avatar-form">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-6 col-md-4 col-lg-2">
                                                            <div class="radio radio-avatar-form">
                                                                <label>
                                                                    <input type="radio" name="usuario_avatar_up2" value="avatar2.png" <?php if($campos['avatar']=="avatar2.png"){echo 'checked=""' ; }?>>
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar2.png" class="img-fluid img-avatar-form">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-6 col-md-4 col-lg-2">
                                                            <div class="radio radio-avatar-form">
                                                                <label>
                                                                    <input type="radio" name="usuario_avatar_up2" value="avatar3.png" <?php if($campos['avatar']=="avatar3.png"){echo 'checked=""' ; }?>>
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar3.png" class="img-fluid img-avatar-form">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-6 col-md-4 col-lg-2">
                                                            <div class="radio radio-avatar-form">
                                                                <label>
                                                                    <input type="radio" name="usuario_avatar_up2" value="avatar4.png" <?php if($campos['avatar']=="avatar4.png"){echo 'checked=""' ; }?>>
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar4.png" class="img-fluid img-avatar-form">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-6 col-md-4 col-lg-2">
                                                            <div class="radio radio-avatar-form">
                                                                <label>
                                                                    <input type="radio" name="usuario_avatar_up2" value="avatar5.png" <?php if($campos['avatar']=="avatar5.png"){echo 'checked=""' ; }?>>
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar5.png" class="img-fluid img-avatar-form">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-6 col-md-4 col-lg-2">
                                                            <div class="radio radio-avatar-form">
                                                                <label>
                                                                    <input type="radio" name="usuario_avatar_up2" value="avatar6.png" <?php if($campos['avatar']=="avatar6.png"){echo 'checked=""' ; }?>>
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar6.png"" class="img-fluid img-avatar-form">
                                                                </label>
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