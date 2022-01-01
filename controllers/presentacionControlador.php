<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../models/presentacionModelo.php";
	}else{
		require_once "./models/presentacionModelo.php";
	}

	class presentacionControlador extends presentacionModelo
	{
		/*AGREGAR*/
		public function agregar_presentacion_controlador(){

			/*--DATOS DEL PRESENTACIONES--*/
			$descripcion = mainModel::limpiar_cadena($_POST['presentacion_nombre_reg']);
			$vigencia = mainModel::limpiar_cadena($_POST['presentacion_estado_reg']);


            /*--VALIDACIONES--*/

            /*Que los campos no esten vacios*/
            if($descripcion == "" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada") ){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
                
                /*Consulta*/
                $consulta1 = mainModel::ejecutar_consulta_simple("SELECT descripcion FROM presentacion WHERE descripcion='$descripcion'");
                    
                /*CONTAMOS SI EXISTE*/
                if($consulta1->rowCount()>=1){
                        
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La descripción que ingresaste ya se encuentra registrada, intente nuevamente","Tipo"=>"warning"];
                    
                }else{

                    /* LONGITUD DE CARCATRES*/
                    if(strlen( $descripcion ) > 20){

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la descripción no es válida","Tipo"=>"warning"];
                            
                    }else{

                        /* LONGITUD DE CARCATRES*/
                        if(strlen( $vigencia ) > 15){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El estado seleccionado no es válido","Tipo"=>"warning"];

                        }else{

                            $Datospresentacion= [ "descripcion"=>$descripcion,
                                                  "vigencia"=>$vigencia   ];

                            $Guardarpresentacion = presentacionModelo::agregar_presentacion_modelo($Datospresentacion);

                            if($Guardarpresentacion->rowCount()>=1){

                                $alerta = ["Alerta"=>"limpiar", "Titulo"=>"PRESENTACIÓN REGISTRADA","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];

                            }else{
                                                
                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro del presentacion, intente nuevamente","Tipo"=>"error"];

                            }
                                
                        }
                    }
                        
                }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_presentacion_controlador($pagina,$registros,$busqueda){
       
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

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM presentacion WHERE descripcion LIKE '%$busqueda%' ORDER BY descripcion ASC LIMIT $inicio,$registros";

                $paginaURL = "presentationSearch";

            }else{

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM presentacion ORDER BY descripcion ASC LIMIT $inicio,$registros";

                $paginaURL = "presentationList";

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
                                            '.$rows['vigencia'].'
                                        </td>
                                        <td>
                                            <a href="'.SERVERURL.'presentationEdit/'.mainModel::encryption($rows['idPresentacion']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Datos" data-placement="bottom">
                                                <i class="fas fa-sync fa-fw"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="'.SERVERURL.'ajax/presentacionAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data">
                                                <input type="hidden" name="presentacion_id_del" value="'.mainModel::encryption($rows['idPresentacion']).'">
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
                                        <td colspan="5" class="text-center">
                                            <a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info">
                                                <i class="fas fa-retweet"></i> Haga clic acá para actualizar el listado 
                                            </a>
                                        </td>
                                    </tr>';
                }else{
                    $tabla .= '     <tr>
                                        <td colspan="5" class="text-center"> 
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
            
            $tabla .= '<p class="text-right">Total de presentacions : <strong> '.$total.'</strong></p>';

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
        public function eliminar_presentacion_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['presentacion_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT idProducto FROM producto WHERE idPresentacion='$id'");

            if($consulta1->rowCount()>=1){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la presentación, esta asociado a otros registros, se recomienda cambiar el estado","Tipo"=>"error"];
            
            }else{

                $Eliminarpresentacion = presentacionModelo::eliminar_presentacion_modelo($id);

                if($Eliminarpresentacion->rowCount()>=1){

                    $alerta = ["Alerta"=>"recargar", "Titulo"=>"PRESENTACIÓN ELIMINADA","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
        
                }else{

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la presentacion,  intenté nuevamente","Tipo"=>"error"];

                }
            }

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_presentacion_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return presentacionModelo::datos_presentacion_modelo($tipo, $codigo);
        }

        /*ACTUALIZAR */
        public function actualizar_presentacion_controlador(){ 

            $id = mainModel::decryption($_POST['presentacion_id_up']);
            $descripcion = mainModel::limpiar_cadena($_POST['presentacion_nombre_up']);
            $vigencia = mainModel::limpiar_cadena($_POST['presentacion_estado_up']);

            if($id == "" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada")){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos correctamente","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM presentacion WHERE idPresentacion ='$id'");

            $datos = $consulta1->fetch();

            if($descripcion != $datos['descripcion']){

                $consulta2 = mainModel::ejecutar_consulta_simple("SELECT descripcion FROM presentacion WHERE descripcion ='$descripcion'");

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

            $datospresentacion= ["descripcion"=>$descripcion, "vigencia"=>$vigencia, "codigo"=>$id];

            if(presentacionModelo::actualizar_presentacion_modelo($datospresentacion)->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"PRESENTACIÓN ACTUALIZADA","Texto"=>"Los datos fueron actualizados con éxito","Tipo"=>"success"];

            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudieron actualizar los datos de la presentación, intenté nuevamente","Tipo"=>"error"];

            }
            return mainModel::sweet_alert($alerta);
        }
	}
    