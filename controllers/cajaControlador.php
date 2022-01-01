<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../models/cajaModelo.php";
	}else{
		require_once "./models/cajaModelo.php";
	}

	class cajaControlador extends cajaModelo
	{
		/*AGREGAR*/
		public function agregar_caja_controlador(){

			/*--DATOS DE LA CAJA--*/
			$numero = mainModel::limpiar_cadena($_POST['caja_numero_reg']);
			$descripcion = mainModel::limpiar_cadena($_POST['caja_nombre_reg']);
			$efectivo = mainModel::limpiar_cadena($_POST['caja_efectivo_reg']);
			$vigencia = mainModel::limpiar_cadena($_POST['caja_estado_reg']);


            /*--VALIDACIONES--*/
            if($descripcion == "" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada") || $efectivo =="" || $numero ==""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
        
                $consulta1 = mainModel::ejecutar_consulta_simple("SELECT descripcion FROM caja WHERE descripcion='$descripcion'");
                    
                if($consulta1->rowCount()>=1){
                        
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La descripción que ingresaste ya se encuentra registrada, intente nuevamente","Tipo"=>"warning"];
                    
                }else{

                    if(strlen( $descripcion ) > 40){

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la descripción no es válida","Tipo"=>"warning"];
                            
                    }else{

                        if(strlen( $numero ) > 5){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El número ingresado no es válido","Tipo"=>"warning"];

                        }else{

                            $Datoscaja= [       "numero"=>$numero,
                                                "descripcion"=>$descripcion,
                                                "efectivo"=>$efectivo,
                                                "vigencia"=>$vigencia   ];

                            $GuardarCaja = cajaModelo::agregar_caja_modelo($Datoscaja);

                            if($GuardarCaja->rowCount()>=1){

                                $alerta = ["Alerta"=>"limpiar", "Titulo"=>"CAJA REGISTRADA","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];

                            }else{
                                                
                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro de la caja, intente nuevamente","Tipo"=>"error"];

                            }
                                
                        }
                    }
                        
                }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_caja_controlador($pagina,$registros,$busqueda){
       
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

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM caja WHERE descripcion LIKE '%$busqueda%' ORDER BY descripcion ASC LIMIT $inicio,$registros";

                $paginaURL = "cashierSearch";

            }else{

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM caja ORDER BY descripcion ASC LIMIT $inicio,$registros";

                $paginaURL = "cashierList";

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
                                        <th>Efectivo</th>
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
                                        <th scope="row">'.$rows['numero'].'</th>
                                        <td>
                                            '.$rows['descripcion'].'
                                        </td>
                                        <td>
                                            S/ '.$rows['efectivo'].' Soles
                                        </td>
                                        <td>
                                            '.$rows['vigencia'].'
                                        </td>
                                        <td>
                                            <a href="'.SERVERURL.'cashierEdit/'.mainModel::encryption($rows['idCaja']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Datos" data-placement="bottom">
                                                <i class="fas fa-sync fa-fw"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="'.SERVERURL.'ajax/cajaAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data">
                                                <input type="hidden" name="caja_id_del" value="'.mainModel::encryption($rows['idCaja']).'">
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
        public function eliminar_caja_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['caja_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT idCaja FROM compra WHERE idCaja='$id'");

            if($consulta1->rowCount()>=1){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la caja, esta asociado a otros registros, se recomienda cambiar el estado","Tipo"=>"error"];

            }else{
                $Eliminarcaja = cajaModelo::eliminar_caja_modelo($id);

                if($Eliminarcaja->rowCount()>=1){

                    $alerta = ["Alerta"=>"recargar", "Titulo"=>"CAJA ELIMINADA","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
        
                }else{

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la caja, puede que este asociado a otros registros, se recomienda cambiar el estado o intenté nuevamente","Tipo"=>"error"];

                }
            }
     

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_caja_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return cajaModelo::datos_caja_modelo($tipo, $codigo);
        }

        /*ACTUALIZAR */
        public function actualizar_caja_controlador(){ 

            $id = mainModel::decryption($_POST['caja_id_up']);
            $descripcion = mainModel::limpiar_cadena($_POST['caja_nombre_up']);
            $vigencia = mainModel::limpiar_cadena($_POST['caja_estado_up']);
            $numero = mainModel::limpiar_cadena($_POST['caja_numero_up']);
			$efectivo = mainModel::limpiar_cadena($_POST['caja_efectivo_up']);

            if($descripcion == "" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada") || $efectivo =="" || $numero =="" || $id ==""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos correctamente","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM caja WHERE idCaja ='$id'");

            $datos = $consulta1->fetch();

            if($descripcion != $datos['descripcion']){

                $consulta2 = mainModel::ejecutar_consulta_simple("SELECT descripcion FROM caja WHERE descripcion ='$descripcion'");

                if($consulta2->rowCount()>=1){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La descripción ya ha sido registrada en el sistema, intenté nuevamente","Tipo"=>"error"];
                    return mainModel::sweet_alert($alerta);
                    exit();

                }
            }

            if(strlen( $descripcion ) > 40){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la descripción no es válida","Tipo"=>"warning"];   
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            if(strlen( $numero) > 5){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud del número de caja no es válido","Tipo"=>"warning"];   
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            $datoscaja= ["numero"=>$numero, "descripcion"=>$descripcion, "efectivo"=>$efectivo, "vigencia"=>$vigencia, "codigo"=>$id];

            if(cajaModelo::actualizar_caja_modelo($datoscaja)->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"CAJA ACTUALIZADA","Texto"=>"Los datos fueron actualizados con éxito","Tipo"=>"success"];

            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudieron actualizar los datos del caja, intenté nuevamente","Tipo"=>"error"];

            }
            return mainModel::sweet_alert($alerta);
        }
	}
    