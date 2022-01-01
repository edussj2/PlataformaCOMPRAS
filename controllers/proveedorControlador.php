<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../models/proveedorModelo.php";
	}else{
		require_once "./models/proveedorModelo.php";
	}

	class proveedorControlador extends proveedorModelo
	{
		/*AGREGAR*/
		public function agregar_proveedor_controlador(){

			/*--DATOS DEL user--*/
			$documento = mainModel::limpiar_cadena($_POST['proveedor_tipo_documento_reg']);
			$numero = mainModel::limpiar_cadena($_POST['proveedor_numero_documento_reg']);
			$razSocial = mainModel::limpiar_cadena($_POST['proveedor_nombre_reg']);
			$direccion = mainModel::limpiar_cadena($_POST['proveedor_direccion_reg']);
			$encargado = mainModel::limpiar_cadena($_POST['proveedor_encargado_reg']);
			$telefono = mainModel::limpiar_cadena($_POST['proveedor_telefono_reg']);
			$email = mainModel::limpiar_cadena($_POST['proveedor_email_reg']);
			$puesto = mainModel::limpiar_cadena($_POST['proveedor_puesto_reg']);
			$cuenta = mainModel::limpiar_cadena($_POST['proveedor_cuenta_reg']);
			$vigencia = mainModel::limpiar_cadena($_POST['proveedor_estado_reg']);


            /*--VALIDACIONES--*/
            if($documento == "Sin Registro" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada") || $numero == "" || $razSocial == "" || $encargado == "" || $telefono == "" || $puesto == "" || $cuenta == ""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos ","Tipo"=>"warning"];

            }else{
        
                $consulta1 = mainModel::ejecutar_consulta_simple("SELECT razSocial FROM proveedor WHERE razSocial='$razSocial'");
                    
                if($consulta1->rowCount()>=1){
                        
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La Razón Social que ingresaste ya se encuentra registrada, intente nuevamente","Tipo"=>"warning"];
                    
                }else{

                    if(strlen( $razSocial ) > 50){

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la razón social no es válida","Tipo"=>"warning"];
                            
                    }else{

                        if(strlen( $numero ) > 15){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud del número de documento ingresada no es válida","Tipo"=>"warning"];

                        }else{

                            $consulta2 = mainModel::ejecutar_consulta_simple("SELECT numDocumento FROM proveedor WHERE numDocumento='$numero'");

                            if($consulta2->rowCount()>=1){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El número de documento que ingresaste ya se encuentra registrado, intente nuevamente","Tipo"=>"warning"];

                            }else{

                                if($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)==false){

                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El correo electrónico ingresado no es válido","Tipo"=>"warning"];

                                }else{

                                    if(is_numeric($telefono)==false || strlen($telefono) > 9){

                                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El teléfono no es válido (Solo números y 9 carácteres como máximo)","Tipo"=>"warning"];

                                    }else{

                                        $Datosproveedor= [  "numDocumento"=>$numero,
                                                            "razSocial"=>$razSocial,
                                                            "direccion"=>$direccion,
                                                            "vigencia"=>$vigencia,
                                                            "contNombres"=>$encargado,
                                                            "contTelefono"=>$telefono,
                                                            "contEmail"=>$email,
                                                            "contPuesto"=>$puesto,
                                                            "cuenta"=>$cuenta,
                                                            "documento"=>$documento   
                                                        ];

                                        $Guardarproveedor = proveedorModelo::agregar_proveedor_modelo($Datosproveedor);

                                        if($Guardarproveedor->rowCount()>=1){

                                            $alerta = ["Alerta"=>"limpiar", "Titulo"=>"PROVEEDOR REGISTRADO","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];

                                        }else{
                                                            
                                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro del proveedor, intente nuevamente","Tipo"=>"error"];

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
        public function paginador_proveedor_controlador($pagina,$registros,$busqueda){
       
            /**-----LIMPIAMOS PARAMETROS RECIBIDOS-----**/
            $pagina = mainModel::limpiar_cadena($pagina);
            $registros = mainModel::limpiar_cadena($registros);
            $busqueda = mainModel::limpiar_cadena($busqueda);
            $tabla = "";

            /**-----VALIDAMOS LAS PAGINAS Y EL ORDEN DE LOS REGISTROS----**/
            $pagina = (isset($pagina) && $pagina>0) ? (int)$pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros) - $registros): 0;

            /**-----VALIDAMOS SI ES UNA BUSQUEDA O SI ES LA LISTA---**/
            if(isset($busqueda) && $busqueda!=""){

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM proveedor WHERE razSocial LIKE '%$busqueda%' ORDER BY razSocial ASC LIMIT $inicio,$registros";

                $paginaURL = "providerSearch";

            }else{

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM proveedor ORDER BY razSocial ASC LIMIT $inicio,$registros";

                $paginaURL = "providerList";

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
                            <table class="table">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Razón Social</th>
                                        <th>Encargado</th>
                                        <th>Teléfono</th>
                                        <th>Estado</th>
                                        <th>Actualizar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>';

            if($total>=1 && $pagina <= $Npaginas){

                $contador = $inicio+1;

                foreach ($datos as $rows) {

                    $tabla.= '      <tr class="text-center">
                                        <th scope="row">'.$contador.'</th>
                                        <td>
                                            '.$rows['razSocial'].'
                                        </td>
                                        <td>
                                            '.$rows['contNombres'].'
                                        </td>
                                        <td>
                                            '.$rows['contTelefono'].'
                                        </td>
                                        <td>
                                            '.$rows['vigencia'].'
                                        </td>
                                        <td>
                                            <a href="'.SERVERURL.'providerEdit/'.mainModel::encryption($rows['idProveedor']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Datos" data-placement="bottom">
                                                <i class="fas fa-sync fa-fw"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="'.SERVERURL.'ajax/proveedorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data">
                                                <input type="hidden" name="proveedor_id_del" value="'.mainModel::encryption($rows['idProveedor']).'">
                                                <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Eliminar" data-placement="bottom">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                                <div class="RespuestaAjax"></div>
                                            </form>
                                        </td>
                                    </tr>';
                    $contador++;
                }
            }else{
                if($total>=1){
                    $tabla .= '     <tr> 
                                        <td colspan="7" class="text-center">
                                            <a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info">
                                                <i class="fas fa-retweet"></i> Haga clic acá para actualizar el listado 
                                            </a>
                                        </td>
                                    </tr>';
                }else{
                    $tabla .= '     <tr>
                                        <td colspan="7" class="text-center"> 
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
            
            $tabla .= '<p class="text-right">Total de proveedors : <strong> '.$total.'</strong></p>';

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
        public function eliminar_proveedor_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['proveedor_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT idProveedor FROM compra WHERE idProveedor='$id'");

            if($consulta1->rowCount()>=1){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar el proveedor, esta asociado a otros registros, se recomienda cambiar el estado","Tipo"=>"error"];
            
            }else{

                $Eliminarproveedor = proveedorModelo::eliminar_proveedor_modelo($id);

                if($Eliminarproveedor->rowCount()>=1){

                    $alerta = ["Alerta"=>"recargar", "Titulo"=>"PROVEEDOR ELIMINADO","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
        
                }else{

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar el proveedor, puede que este asociado a otros registros, se recomienda cambiar el estado o intenté nuevamente","Tipo"=>"error"];

                }
            }
     

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_proveedor_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return proveedorModelo::datos_proveedor_modelo($tipo, $codigo);
        }

        /*ACTUALIZAR */
        public function actualizar_proveedor_controlador(){ 

            $id = mainModel::decryption($_POST['proveedor_id_up']);
			$documento = mainModel::limpiar_cadena($_POST['proveedor_tipo_documento_up']);
			$numero = mainModel::limpiar_cadena($_POST['proveedor_numero_documento_up']);
			$razSocial = mainModel::limpiar_cadena($_POST['proveedor_nombre_up']);
			$direccion = mainModel::limpiar_cadena($_POST['proveedor_direccion_up']);
			$encargado = mainModel::limpiar_cadena($_POST['proveedor_encargado_up']);
			$telefono = mainModel::limpiar_cadena($_POST['proveedor_telefono_up']);
			$email = mainModel::limpiar_cadena($_POST['proveedor_email_up']);
			$puesto = mainModel::limpiar_cadena($_POST['proveedor_puesto_up']);
			$cuenta = mainModel::limpiar_cadena($_POST['proveedor_cuenta_up']);
			$vigencia = mainModel::limpiar_cadena($_POST['proveedor_estado_up']);

            if($id == "" || $documento == "Sin Registro" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada") || $numero == "" || $razSocial == "" || $encargado == "" || $telefono == "" || $puesto == "" || $cuenta==""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos correctamente","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM proveedor WHERE idProveedor ='$id'");

            $datos = $consulta1->fetch();

            if($razSocial != $datos['razSocial']){

                $consulta2 = mainModel::ejecutar_consulta_simple("SELECT razSocial FROM proveedor WHERE razSocial ='$razSocial'");

                if($consulta2->rowCount()>=1){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La Razón Social ya ha sido registrada en el sistema, intenté nuevamente","Tipo"=>"error"];
                    return mainModel::sweet_alert($alerta);
                    exit();

                }
            }

            if($numero != $datos['numDocumento']){

                $consulta3 = mainModel::ejecutar_consulta_simple("SELECT numDocumento FROM proveedor WHERE numDocumento ='$numero'");

                if($consulta3->rowCount()>=1){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El número de documento ya ha sido registrado en el sistema, intenté nuevamente","Tipo"=>"error"];
                    return mainModel::sweet_alert($alerta);
                    exit();

                }
            }

            if(strlen( $razSocial ) > 50){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la razón social no es válida","Tipo"=>"warning"];   
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            if(strlen( $numero ) > 15){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud del número de documento no es válida","Tipo"=>"warning"];   
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            if($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)==false){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El correo electrónico ingresado no es válido","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            if(is_numeric($telefono)==false || strlen($telefono) > 9){
                
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El teléfono no es válido (Solo números y 9 carácteres como máximo)","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            $DatosProveedor= [  "numDocumento"=>$numero,"razSocial"=>$razSocial,"direccion"=>$direccion,"vigencia"=>$vigencia,"contNombres"=>$encargado,"contTelefono"=>$telefono,"contEmail"=>$email,"contPuesto"=>$puesto,"cuenta"=>$cuenta, "documento"=>$documento,"codigo"=>$id ];

            if(proveedorModelo::actualizar_proveedor_modelo($DatosProveedor)->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"PROVEEDOR ACTUALIZADO","Texto"=>"Los datos fueron actualizados con éxito","Tipo"=>"success"];

            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudieron actualizar los datos del Documento, intenté nuevamente","Tipo"=>"error"];

            }
            return mainModel::sweet_alert($alerta);
        }
	}
    