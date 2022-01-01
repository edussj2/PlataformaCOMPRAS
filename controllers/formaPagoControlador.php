<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../models/formaPagoModelo.php";
	}else{
		require_once "./models/formaPagoModelo.php";
	}

	class formaPagoControlador extends formaPagoModelo
	{
		/*AGREGAR*/
		public function agregar_formaPago_controlador(){

			$descripcion = mainModel::limpiar_cadena($_POST['forma_pago_nombre_reg']);
			$icono = mainModel::limpiar_cadena($_POST['forma_pago_icono_reg']);
			$vigencia = mainModel::limpiar_cadena($_POST['forma_pago_estado_reg']);


            /*--VALIDACIONES--*/
            if($descripcion == "" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada") || $icono ==""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
        
                $consulta1 = mainModel::ejecutar_consulta_simple("SELECT descripcion FROM tipo_pago WHERE descripcion='$descripcion'");
                    
                if($consulta1->rowCount()>=1){
                        
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La descripción que ingresaste ya se encuentra registrada, intente nuevamente","Tipo"=>"warning"];
                    
                }else{

                    if(strlen( $descripcion ) > 20){

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la descripción no es válida","Tipo"=>"warning"];
                            
                    }else{

                        if(strlen( $icono ) > 50){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud del icono no es válido","Tipo"=>"warning"];

                        }else{

                            $DatosformaPago= [  "descripcion"=>$descripcion,
                                                "icono"=>$icono,
                                                "vigencia"=>$vigencia   ];

                            $GuardarformaPago = formaPagoModelo::agregar_formaPago_modelo($DatosformaPago);

                            if($GuardarformaPago->rowCount()>=1){

                                $alerta = ["Alerta"=>"limpiar", "Titulo"=>"TIPO DE PAGO REGISTRADO","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];

                            }else{
                                                
                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro de las modalidad de pago, intente nuevamente","Tipo"=>"error"];

                            }
                                
                        }
                    }
                        
                }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_formaPago_controlador($pagina,$registros,$busqueda){
       
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

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tipo_pago WHERE descripcion LIKE '%$busqueda%' ORDER BY descripcion ASC LIMIT $inicio,$registros";

                $paginaURL = "wayPaySearch";

            }else{

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tipo_pago ORDER BY descripcion ASC LIMIT $inicio,$registros";

                $paginaURL = "wayPayList";

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
                                        <th>Nombre</th>
                                        <th>Icono</th>
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
                                            '.$rows['descripcion'].'
                                        </td>
                                        <td>
                                            <i class="'.$rows['icono'].'"></i>
                                        </td>
                                        <td>
                                            '.$rows['vigencia'].'
                                        </td>
                                        <td>
                                            <a href="'.SERVERURL.'wayPayEdit/'.mainModel::encryption($rows['idTipoPago']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Datos" data-placement="bottom">
                                                <i class="fas fa-sync fa-fw"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="'.SERVERURL.'ajax/formaPagoAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data">
                                                <input type="hidden" name="forma_pago_id_del" value="'.mainModel::encryption($rows['idTipoPago']).'">
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
                                        <td colspan="6" class="text-center">
                                            <a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info">
                                                <i class="fas fa-retweet"></i> Haga clic acá para actualizar el listado 
                                            </a>
                                        </td>
                                    </tr>';
                }else{
                    $tabla .= '     <tr>
                                        <td colspan="6" class="text-center"> 
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
            
            $tabla .= '<p class="text-right">Total de cajas : <strong> '.$total.'</strong></p>';

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
        public function eliminar_formaPago_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['forma_pago_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);


            $EliminarFormaPago = formaPagoModelo::eliminar_formaPago_modelo($id);

            if($EliminarFormaPago->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"MODALIDAD DE PAGO ELIMINADA","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
    
            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la modalidad de pago, puede que este asociado a otros registros, se recomienda cambiar el estado o intenté nuevamente","Tipo"=>"error"];

            }
     

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_formaPago_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return formaPagoModelo::datos_formaPago_modelo($tipo, $codigo);
        }

        /*ACTUALIZAR */
        public function actualizar_formaPago_controlador(){ 

            $id = mainModel::decryption($_POST['forma_pago_id_up']);
			$descripcion = mainModel::limpiar_cadena($_POST['forma_pago_nombre_up']);
			$icono = mainModel::limpiar_cadena($_POST['forma_pago_icono_up']);
			$vigencia = mainModel::limpiar_cadena($_POST['forma_pago_estado_up']);

            if($descripcion == "" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada") || $icono  =="" || $id ==""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos correctamente","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM tipo_pago WHERE idTipoPago ='$id'");

            $datos = $consulta1->fetch();

            if($descripcion != $datos['descripcion']){

                $consulta2 = mainModel::ejecutar_consulta_simple("SELECT descripcion FROM tipo_pago WHERE descripcion ='$descripcion'");

                if($consulta2->rowCount()>=1){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La descripción ya ha sido registrada en el sistema, intenté nuevamente","Tipo"=>"error"];
                    return mainModel::sweet_alert($alerta);
                    exit();

                }
            }

            if(strlen( $descripcion ) > 20){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la descripción no es válida","Tipo"=>"warning"];   
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            if(strlen( $icono) > 50){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud del ícono no es válido","Tipo"=>"warning"];   
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            $datosformaPago= ["descripcion"=>$descripcion, "icono"=>$icono, "vigencia"=>$vigencia, "codigo"=>$id];

            if(formaPagoModelo::actualizar_formaPago_modelo($datosformaPago)->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"FORMA DE PAGO ACTUALIZADA","Texto"=>"Los datos fueron actualizados con éxito","Tipo"=>"success"];

            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudieron actualizar los datos, intenté nuevamente","Tipo"=>"error"];

            }
            return mainModel::sweet_alert($alerta);
        }
	}
    