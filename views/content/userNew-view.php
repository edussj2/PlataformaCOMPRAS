    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-user-tie"></i> &nbsp; Trabajadores
        </h1>
        <p class="text-gray-700 mb-4 text-justify">
            En el módulo TRABAJADORES podrá registrar nuevos usuarios en el sistema ya sea un administrador, vendedor, almacenista, entreo otros, también podrá ver la lista de usuarios registrados, buscar usuarios en el sistema, actualizar datos de otros usuarios y los suyos.
        </p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>userNew/" class="text-gray-700 h5 text-uppercase activo"><i class="fas fa-user-tie"></i> &nbsp; Nuevo</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>userList/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>userSearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar</a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Fila -->
    <div class="row">

        <!-- Nuevo trabajador -->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/userAjax.php" method="POST" data-form="save" autocomplete="off">
                    
                        <fieldset>
                                <legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
                                <div class="container-fluid mt-3">
                                    <div class="row">

                                        <div class="col-12 col-md-4">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="usuario_tipo_documento" class="bmd-label-floating">Tipo de documento &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <select class="form-control" name="usuario_tipo_documento_reg" id="usuario_tipo_documento">
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
                                                <label for="usuario_numero_documento" class="bmd-label-floating">Numero de documento &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-9-]{7,15}" class="form-control" name="usuario_numero_documento_reg" id="usuario_numero_documento" maxlength="15">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="usuario_cargo" class="bmd-label-floating">Cargo &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <select class="form-control" name="usuario_cargo_reg" id="usuario_cargo">
                                                    <option value="Sin Registro"> Seleccione un cargo</option>
                                                    <?php 
                                                        require_once "./controllers/cargoControlador.php";

                                                        $insCargo = new cargoControlador();

                                                        $cargo = $insCargo->datos_cargo_controlador("Select",0);
                                                        $contador = 1;

                                                        while ($rowD = $cargo->fetch()) {
                                                            echo '<option value="'.$rowD['idTrabajador'].'">'.$contador.' - '.$rowD['descripcion'].'</option>';
                                                            $contador++;
                                                        }
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_nombre" class="bmd-label-floating">Nombres &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}" class="form-control" name="usuario_nombre_reg" id="usuario_nombre" maxlength="35">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_apellido" class="bmd-label-floating">Apellidos &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,50}" class="form-control" name="usuario_apellido_reg" id="usuario_apellido" maxlength="50">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_telefono" class="bmd-label-floating">Teléfono</label>
                                                <input type="text" pattern="[0-9()+]{8,9}" class="form-control" name="usuario_telefono_reg" id="usuario_telefono" maxlength="9">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <legend><i class="fas fa-user-friends"></i> &nbsp; Genero</legend>
                                            <div class="form-group bmd-form-group is-filled">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="usuario_genero_reg" value="Masculino" checked=""><span class="bmd-radio"></span>
                                                        <i class="fas fa-male fa-fw"></i> &nbsp; Masculino
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="usuario_genero_reg" value="Femenino"><span class="bmd-radio"></span>
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
                                                <input type="text" pattern="[a-zA-Z0-9]{4,20}" class="form-control" name="usuario_usuario_reg" id="usuario_usuario" maxlength="20">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_email" class="bmd-label-floating">Email</label>
                                                <input type="email" class="form-control" name="usuario_email_reg" id="usuario_email" maxlength="50">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_clave_1" class="bmd-label-floating">Contraseña &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="password" class="form-control" name="usuario_clave_1_reg" id="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,16}" maxlength="16">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="usuario_clave_2" class="bmd-label-floating">Repetir contraseña &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="password" class="form-control" name="usuario_clave_2_reg" id="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,16}" maxlength="16">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="usuario_estado" class="bmd-label-floating">Estado de la cuenta &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <select class="form-control" name="usuario_estado_reg" id="usuario_estado">
                                                    <option value="Habilitada" selected="">1 - Habilitada</option>
                                                    <option value="Deshabilitada">2 - Deshabilitada</option>
                                                </select>
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
                                                                    <input type="radio" name="usuario_avatar_reg" value="avatar1.png" checked="">
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar1.png" class="img-fluid img-avatar-form">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-6 col-md-4 col-lg-2">
                                                            <div class="radio radio-avatar-form">
                                                                <label>
                                                                    <input type="radio" name="usuario_avatar_reg" value="avatar2.png">
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar2.png" class="img-fluid img-avatar-form">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-6 col-md-4 col-lg-2">
                                                            <div class="radio radio-avatar-form">
                                                                <label>
                                                                    <input type="radio" name="usuario_avatar_reg" value="avatar3.png">
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar3.png" class="img-fluid img-avatar-form">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-6 col-md-4 col-lg-2">
                                                            <div class="radio radio-avatar-form">
                                                                <label>
                                                                    <input type="radio" name="usuario_avatar_reg" value="avatar4.png">
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar4.png" class="img-fluid img-avatar-form">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-6 col-md-4 col-lg-2">
                                                            <div class="radio radio-avatar-form">
                                                                <label>
                                                                    <input type="radio" name="usuario_avatar_reg" value="avatar5.png">
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar5.png" class="img-fluid img-avatar-form">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-6 col-md-4 col-lg-2">
                                                            <div class="radio radio-avatar-form">
                                                                <label>
                                                                    <input type="radio" name="usuario_avatar_reg" value="avatar6.png">
                                                                    <img src="<?php echo SERVERURL; ?>views/img/avatars/avatar6.png"" class="img-fluid img-avatar-form">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    
                                    </div>
                                </div>
                        </fieldset>

                        <p class="text-center" style="margin-top: 40px;">
                            <button type="reset" class="btn btn-raised btn-secondary btn-sm">
                                <i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR
                            </button>
                            &nbsp; &nbsp;
                            <button type="submit" class="btn btn-raised btn-info btn-sm">
                                <i class="far fa-save"></i> &nbsp; GUARDAR
                            </button>
                        </p>
                        <p class="text-center">
                            <small>
                                Los campos marcados con &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp; son obligatorios
                            </small>
                        </p>
                        <div class="RespuestaAjax"></div>
                    </form>
                    <!-- Formulario -->

                </div>
            </div>
        </div>
  
    </div>
    <!-- End Fila -->