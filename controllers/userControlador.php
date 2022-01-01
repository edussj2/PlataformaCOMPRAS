<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../models/userModelo.php";
	}else{
		require_once "./models/userModelo.php";
	}

	class userControlador extends userModelo
	{
		/*AGREGAR*/
		public function agregar_user_controlador(){

			/*--DATOS DEL user--*/
			$numero = mainModel::limpiar_cadena($_POST['usuario_numero_documento_reg']);
			$nombres = mainModel::limpiar_cadena($_POST['usuario_nombre_reg']);
			$apellidos = mainModel::limpiar_cadena($_POST['usuario_apellido_reg']);
			$telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_reg']);
            $genero = mainModel::limpiar_cadena($_POST['usuario_genero_reg']);
			$usuario = mainModel::limpiar_cadena($_POST['usuario_usuario_reg']);
			$pass1 = mainModel::limpiar_cadena($_POST['usuario_clave_1_reg']);
			$pass2 = mainModel::limpiar_cadena($_POST['usuario_clave_2_reg']);
			$email = mainModel::limpiar_cadena($_POST['usuario_email_reg']);
			$vigencia = mainModel::limpiar_cadena($_POST['usuario_estado_reg']);
			$avatar = mainModel::limpiar_cadena($_POST['usuario_avatar_reg']);
			$documento = mainModel::limpiar_cadena($_POST['usuario_tipo_documento_reg']); 
			$cargo = mainModel::limpiar_cadena($_POST['usuario_cargo_reg']);


            /*--VALIDACIONES--*/
            if($numero == "" || $nombres == "" || $apellidos == "" || $usuario == "" || $pass1 == "" || $pass2 == "" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada") || $documento == "Sin Registro" || $cargo == "Sin Registro"){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
            
                if($pass1!=$pass2){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Las contraseñas no coinciden, intente nuevamente","Tipo"=>"warning"];
                
                }else{

                    $consulta1 = mainModel::ejecutar_consulta_simple("SELECT numDocumento FROM usuario WHERE numDocumento='$numero'");
                    
                    if($consulta1->rowCount()>=1){
                        
                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El número de documento que ingresaste ya se encuentra registrado, intente nuevamente","Tipo"=>"warning"];
                    
                    }else{

                        $consulta2 = mainModel::ejecutar_consulta_simple("SELECT usuario FROM usuario WHERE usuario ='$usuario'");
                        if($consulta2->rowCount()>=1){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El usuario ingresado ya se encuentra registrado, intente nuevamente","Tipo"=>"warning"];
                        
                        }else{

                            if(strlen($pass1) < 7 || strlen($pass1)>16){

                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la contraseña no es válida ( 8 - 16 carácteres )","Tipo"=>"warning"];
                            
                            }else{

                                if($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)==false){

                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El correo electrónico ingresado no es válido","Tipo"=>"warning"];

                                }else{

                                    if($telefono != "" && is_numeric($telefono)==false && strlen($telefono) > 9 ){
                           
                                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El teléfono no es válido (Solo números y 9 carácteres como máximo)","Tipo"=>"warning"];
                                       
                                    }else{

                                        $clave = mainModel::encryption($pass1);

                                        $datosUser=[
                                                "numDocumento"=>$numero,
                                                "nombres"=>$nombres,
                                                "apellidos"=>$apellidos,
                                                "telefono"=>$telefono,
                                                "genero"=>$genero,
                                                "usuario"=>$usuario,
                                                "clave"=>$clave,
                                                "email"=>$email,
                                                "vigencia"=>$vigencia,
                                                "avatar"=>$avatar,
                                                "documento"=>$documento,
                                                "cargo"=>$cargo
                                        ];

                                        $GuardarUsuario = userModelo::agregar_user_modelo($datosUser);

                                        if($GuardarUsuario->rowCount()>=1){

                                            $alerta = ["Alerta"=>"limpiar", "Titulo"=>"TRABAJADOR REGISTRADO","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];

                                        }else{

                                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro del trabajador, intente nuevamente","Tipo"=>"error"];

                                        } 
                                    }
                                }
                            }
                        }
                    }
                }
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_user_controlador($pagina,$registros,$codigo,$busqueda){
            /**-----LIMPIAMOS PARAMETROS RECIBIDOS-----**/
            $pagina = mainModel::limpiar_cadena($pagina);
            $registros = mainModel::limpiar_cadena($registros);
            $busqueda = mainModel::limpiar_cadena($busqueda);
            $codigo = mainModel::limpiar_cadena($codigo);
            $tabla = "";

            /**-----VALIDAMOS LAS PAGINAS Y EL ORDEN DE LOS REGISTROS----**/
            $pagina = (isset($pagina) && $pagina>0) ? (int)$pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros) - $registros): 0;

            /**-----VALIDAMOS SI ES UNA BUSQUEDA O SI ES LA LISTA---**/
            if(isset($busqueda) && $busqueda!=""){

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE ((idUsuario != '$codigo')AND (idUsuario != 1) AND (nombres LIKE '%$busqueda%' OR apellidos LIKE '%$busqueda%' OR numDocumento LIKE '%$busqueda%')) ORDER BY apellidos ASC LIMIT $inicio,$registros";

                $paginaURL = "userSearch";

            }else{

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE idUsuario != '$codigo' AND idUsuario != 1 ORDER BY apellidos ASC LIMIT $inicio,$registros";

                $paginaURL = "userList";

            }

            /**-----CONECTAMOS Y GUARDAMOS LOS DATOS----**/
            $conexion = mainModel::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();

            /**-----CALCULAMOS EL TOTAL DE REGISTROS----**/
            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();

            /**-----CALCULAMOS EL TOTAL DE PAGINAS----**/
            $Npaginas = ceil($total/$registros);

            /**-----GENERAMOS TABLA---**/
            $tabla .= ' <div class="table-responsive mb-3">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>DOCUMENTO</th>
                                        <th>CARGO</th>
                                        <th>NOMBRE</th>
                                        <th>USUARIO</th>
                                        <th>ACTUALIZAR</th>
                                    </tr>
                                </thead>
                                <tbody>';

            if($total>=1 && $pagina <= $Npaginas){

                $contador = $inicio+1;

                foreach ($datos as $rows) {

                    $query1 = mainModel::ejecutar_consulta_simple("SELECT * FROM tipo_documento WHERE idDocumento ='".$rows['idDocumento']."'");
                    $datosDocumento= $query1->fetch();

                    $query2 = mainModel::ejecutar_consulta_simple("SELECT * FROM tipo_trabajador WHERE idTrabajador ='".$rows['idTrabajador']."'");
                    $datosCargo= $query2->fetch();

                    $tabla.= '      <tr class="text-center">
                                        <th scope="row">'.$contador.'</th>
                                        <td>
                                            '.$datosDocumento['descripcion'].' : '.$rows['numDocumento'].'
                                        </td>
                                        <td>
                                            '.$datosCargo['descripcion'].'
                                        </td>
                                        <td>
                                            '.$rows['nombres'].' '.$rows['apellidos'].'
                                        </td>
                                        <td>
                                            '.$rows['usuario'].'
                                        </td>
                                        <td>
                                            <a href="'.SERVERURL.'userEdit/'.mainModel::encryption($rows['idUsuario']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Datos" data-placement="bottom">
                                                <i class="fas fa-sync fa-fw"></i>
                                            </a>
                                        </td>
                                    </tr>';
                    $contador++;
                }
            }else{
                if($total>=1){
                    $tabla .= '     <tr> 
                                        <td colspan="9">
                                            <a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info">
                                                <i class="fas fa-retweet"></i> Haga clic acá para actualizar el listado 
                                            </a>
                                        </td>
                                    </tr>';
                }else{
                    $tabla .= '     <tr>
                                        <td colspan="9"> 
                                            <div class="alert alert-dark" role="alert">
                                                <i class="fas fa-bullhorn"></i> NO HAY REGISTOS EN EL SISTEMA 
                                            </div>
                                        </td>
                                    </tr>';
                }
            }

            $tabla .= '         </tbody>
                            </table>
                        </div>';
            
            $tabla .= '<p class="text-right">Total de Cargos : <strong> '.$total.'</strong></p>';

            /**-----GENERAMOS PAGINADOR---**/
            if($total>=1 && $pagina <= $Npaginas){

                $tabla.='<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';

                if($pagina==1){
                    $tabla.= '<li class="page-item disabled"><a class="page-link"><i class="fas fa-angle-double-left"></i></a></li>';
                }else{
                    $tabla.= '<li class="page-item"><a href="'.SERVERURL.$paginaURL.'/'.($pagina-1).'/" class="page-link"><i class="fas fa-angle-double-left"></i></a></li>';
                }

                /*BOTONES QUE MOSTRARAS*/
                $ci=0;
                $botones = 5;

                for ($i=$pagina; $i <= $Npaginas ; $i++) {
                    if($ci >=$botones){
                        break;
                    } 
                    if($pagina == $i){
                        $tabla.= '<li class="page-item"><a class="page-link active" href="'.SERVERURL.$paginaURL.'/'.$i.'/">'.$i.'</a></li>';
                    }else{
                        $tabla.= '<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaURL.'/'.$i.'/">'.$i.'</a></li>';
                    }
                    $ci++;
                }

                if($pagina==$Npaginas){
                    $tabla.= '<li class="page-item disabled"><a class="page-link"><i class="fas fa-angle-double-right"></i></a></li>';
                }else{
                    $tabla.= '<li class="page-item"><a href="'.SERVERURL.$paginaURL.'/'.($pagina+1).'/" class="page-link"><i class="fas fa-angle-double-right"></i></a></li>';
                }

                $tabla.='</ul></nav>';
            }
            return $tabla;
        }

        /*ELIMINAR*/
        public function eliminar_user_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['usuario_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);

                $query1=mainModel::ejecutar_consulta_simple("SELECT idUsuario FROM usuario WHERE idUsuario = '$id'");

                $datosAD = $query1->fetch();

                if($datosAD['idUsuario']!=1){

                    $EliminarUsuario = userModelo::eliminar_user_modelo($id);

                    if($EliminarUsuario->rowCount()>=1){

                            $alerta = ["Alerta"=>"recargar", "Titulo"=>"TRABAJADOR ELIMINADO","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
                        
                    }else{
                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar completamente la cuenta, avisar a soporte técnico","Tipo"=>"info"];
                    }
 
                }else{
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El usuario que desea eliminar no es válido para eliminación","Tipo"=>"error"];
                }

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_user_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return userModelo::datos_user_modelo($tipo, $codigo);
        }

        /*ACTUALIZAR */
        public function actualizar_user_controlador(){ 

			/*--DATOS DEL user--*/
            $id = mainModel::decryption($_POST['usuario_id_up']);
			$numero = mainModel::limpiar_cadena($_POST['usuario_numero_documento_up']);
			$nombres = mainModel::limpiar_cadena($_POST['usuario_nombre_up']);
			$apellidos = mainModel::limpiar_cadena($_POST['usuario_apellido_up']);
			$telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_up']);
            $genero = mainModel::limpiar_cadena($_POST['usuario_genero_up']);
			$usuario = mainModel::limpiar_cadena($_POST['usuario_usuario_up']);
			$pass1 = mainModel::limpiar_cadena($_POST['usuario_clave_1_up']);
			$email = mainModel::limpiar_cadena($_POST['usuario_email_up']);
			$vigencia = mainModel::limpiar_cadena($_POST['usuario_estado_up']);
			$avatar = mainModel::limpiar_cadena($_POST['usuario_avatar_up']);
			$documento = mainModel::limpiar_cadena($_POST['usuario_tipo_documento_up']); 
			$cargo = mainModel::limpiar_cadena($_POST['usuario_cargo_up']);


            if($numero == "" || $nombres == "" || $apellidos == "" || $usuario == "" || $pass1 == "" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada") || $documento == "Sin Registro" || $cargo == "Sin Registro"){
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE idUsuario ='$id'");

            $datosUsuario = $consulta1->fetch();

            if($numero!=$datosUsuario['numDocumento']){

                $consulta2 = mainModel::ejecutar_consulta_simple("SELECT numDocumento FROM usuario WHERE 	numDocumento ='$numero'");

                if($consulta2->rowCount()>=1){
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El número de documento ingresado ya ha sido registrado en el sistema, intenté nuevamente","Tipo"=>"error"];
                    return mainModel::sweet_alert($alerta);
                    exit();
                }
            }

            
            if($usuario!=$datosUsuario['usuario']){
               
                $consulta3 = mainModel::ejecutar_consulta_simple("SELECT usuario FROM usuario WHERE usuario ='$usuario'");

                if($consulta3->rowCount()>=1){
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El usuario ingresado ya ha sido registrado en el sistema, intenté nuevamente","Tipo"=>"error"];
                    return mainModel::sweet_alert($alerta);
                    exit();
                }
            }
            

            if($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)==false){
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El correo electrónico ingresado no es válido","Tipo"=>"warning"]; 
                return mainModel::sweet_alert($alerta);
                exit();          
            }

            if(strlen($pass1) < 7 || strlen($pass1)>16){          
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la contraseña no es válida ( 8 - 16 carácteres )","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();    
            }

            if($telefono != "" && is_numeric($telefono)==false && strlen($telefono) > 9){          
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El teléfono no es válido (Solo números y 9 carácteres como máximo)","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();    
            }

            $clave = mainModel::encryption($pass1);

            $datosUser=["numDocumento"=>$numero, "nombres"=>$nombres, "apellidos"=>$apellidos,              "telefono"=>$telefono, "genero"=>$genero, "usuario"=>$usuario, "clave"=>$clave, "email"=>$email,"vigencia"=>$vigencia, "avatar"=>$avatar, "documento"=>$documento, "cargo"=>$cargo, "codigo"=>$id ];

            if(userModelo::actualizar_user_modelo($datosUser)->rowCount()>=1){
                $alerta = ["Alerta"=>"recargar", "Titulo"=>"TRABAJADOR ACTUALIZADO","Texto"=>"Los datos fueron actualizados con éxito","Tipo"=>"success"];
            }else{
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudieron actualizar los datos del trabajador, intenté nuevamente","Tipo"=>"error"];
            }
            return mainModel::sweet_alert($alerta);
        }

        /*ACTUALIZAR */
        public function actualizar_clave_user_controlador(){ 

			/*--DATOS DEL user--*/
            $id = mainModel::decryption($_POST['usuario_id_new']);
			$pass1 = mainModel::limpiar_cadena($_POST['usuario_clave_1_new']);
			$pass2 = mainModel::limpiar_cadena($_POST['usuario_clave_2_new']);
			$usuario = mainModel::limpiar_cadena($_POST['usuario_usuario_new']);
			$clave = mainModel::limpiar_cadena($_POST['usuario_clave_new']);


            if($pass1 == "" || $pass2 == "" || $usuario == "" || $clave == "" || $id == ""){
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE idUsuario ='$id'");

            $datosUsuario = $consulta1->fetch();

            if($usuario != $datosUsuario['usuario'] && $clave != $datosUsuario['clave']){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El usuario o la contraseña no son correctas, intenté nuevamente","Tipo"=>"error"];
                return mainModel::sweet_alert($alerta);
                exit();
                
            }

            if($pass1 == $pass2){

                $cuentaClave = mainModel::encryption($pass1);
            }else{

                 $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Las contraseñas no coinciden, intenté nuevamente porfavor.","Tipo"=>"error"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            $datosUser=["clave"=>$cuentaClave, "codigo"=>$id ];

            if(userModelo::actualizar_clave_user_modelo($datosUser)->rowCount()>=1){
                $alerta = ["Alerta"=>"recargar", "Titulo"=>"CONTRASEÑA ACTUALIZADA","Texto"=>"Los datos fueron actualizados con éxito","Tipo"=>"success"];
            }else{
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo actualizar la contraseña, intenté nuevamente","Tipo"=>"error"];
            }
            return mainModel::sweet_alert($alerta);
        }

        /*ACTUALIZAR 2 */
        public function actualizar2_user_controlador(){ 

			/*--DATOS DEL user--*/
            $id = mainModel::decryption($_POST['usuario_id_up2']);
			$nombres = mainModel::limpiar_cadena($_POST['usuario_nombre_up2']);
			$apellidos = mainModel::limpiar_cadena($_POST['usuario_apellido_up2']);
			$telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_up2']);
            $genero = mainModel::limpiar_cadena($_POST['usuario_genero_up2']);
			$usuario = mainModel::limpiar_cadena($_POST['usuario_usuario_up2']);
			$email = mainModel::limpiar_cadena($_POST['usuario_email_up2']);
			$avatar = mainModel::limpiar_cadena($_POST['usuario_avatar_up2']);


            if($nombres == "" || $apellidos == "" || $usuario == ""){
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE idUsuario ='$id'");

            $datosUsuario = $consulta1->fetch();
            
            if($usuario!=$datosUsuario['usuario']){
               
                $consulta3 = mainModel::ejecutar_consulta_simple("SELECT usuario FROM usuario WHERE usuario ='$usuario'");

                if($consulta3->rowCount()>=1){
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El usuario ingresado ya ha sido registrado en el sistema, intenté nuevamente","Tipo"=>"error"];
                    return mainModel::sweet_alert($alerta);
                    exit();
                }
            }
            

            if($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)==false){
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El correo electrónico ingresado no es válido","Tipo"=>"warning"]; 
                return mainModel::sweet_alert($alerta);
                exit();          
            }


            if($telefono != "" && is_numeric($telefono)==false && strlen($telefono) > 9){          
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El teléfono no es válido (Solo números y 9 carácteres como máximo)","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();    
            }


            $datosUser=["nombres"=>$nombres, "apellidos"=>$apellidos,"telefono"=>$telefono, "genero"=>$genero, "usuario"=>$usuario, "email"=>$email,"avatar"=>$avatar,"codigo"=>$id ];

            if(userModelo::actualizar2_user_modelo($datosUser)->rowCount()>=1){
                $alerta = ["Alerta"=>"recargar", "Titulo"=>"DATOS ACTUALIZADOS","Texto"=>"Los datos fueron actualizados con éxito","Tipo"=>"success"];
                session_start(['name'=>'PERNOS']);
				$_SESSION['avatar_pernos']=$avatar;
            }else{
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudieron actualizar los datos, intenté nuevamente","Tipo"=>"error"];
            }
            return mainModel::sweet_alert($alerta);
        }
	}
    