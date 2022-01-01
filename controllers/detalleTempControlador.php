<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../models/detalleTempModelo.php";
	}else{
		require_once "./models/detalleTempModelo.php";
	}

	class detalleTempControlador extends detalleTempModelo
	{
		/*AGREGAR*/
		public function agregar_detalleTemp_controlador(){

			$producto = mainModel::limpiar_cadena($_POST['compra_producto_detalle_reg']);
			$cantidad = mainModel::limpiar_cadena($_POST['compra_cantidad_detalle_reg']);
			$precio = mainModel::limpiar_cadena($_POST['compra_precio_detalle_reg']);


            /*--VALIDACIONES--*/
            if($producto == "Sin Registro"  || $cantidad =="" || $precio =="" || $cantidad<0 || $cantidad ==0){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
        

                if(is_numeric($cantidad)==false){

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La cantidad ingresada no es válida","Tipo"=>"warning"];
                            
                }else{

                    if($precio == 0 || $precio == 0.0 || $precio < 0){

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El precio ingresado no es válido","Tipo"=>"warning"];

                    }else{

                        $subtotal= $cantidad * $precio;

                        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM temp_detalle WHERE idProducto='$producto'");
                    
                        if($consulta1->rowCount()>=1){

                            $dataUp = $consulta1->fetch();

                            $detalleUP = [ "cantidad"=>$cantidad,"precio"=>$precio,"subtotal"=>$subtotal,"idProducto"=>$producto,"codigo"=>$dataUp['idTempDetalle'] ];

                            $ActualizarDetalleTemp = detalleTempModelo::actualizar_detalleTemp_modelo($detalleUP);

                            if($ActualizarDetalleTemp->rowCount()>=1){

                                $alerta = ["Alerta"=>"recargar", "Titulo"=>"DETALLE ACTUALIZADO","Texto"=>"Los datos se actualizarón con éxito.","Tipo"=>"success"];

                            }else{
                                                    
                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con la actualización de los datos, intente nuevamente","Tipo"=>"error"];

                            }

                        }else{

                            $detalleREG = [ "cantidad"=>$cantidad,"precio"=>$precio,"subtotal"=>$subtotal,"idProducto"=>$producto];

                            $GuardarDetalleTemp = detalleTempModelo::agregar_detalleTemp_modelo($detalleREG);

                            if($GuardarDetalleTemp->rowCount()>=1){

                                $alerta = ["Alerta"=>"recargar", "Titulo"=>"DETALLE AGREGADO","Texto"=>"Los datos se agregarón con éxito.","Tipo"=>"success"];

                            }else{
                                                    
                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con agregar los datos, intente nuevamente","Tipo"=>"error"];

                            }

                        }
                                
                    }

                }
                        
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_detalleTemp_controlador($pagina,$registros,$busqueda){
       
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

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM temp_detalle WHERE idProducto LIKE '%$busqueda%' ORDER BY idProducto ASC LIMIT $inicio,$registros";

                $paginaURL = "Search";

            }else{

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM temp_detalle INNER JOIN producto ON temp_detalle.idProducto = producto.idProducto ORDER BY producto.nombre ASC LIMIT $inicio,$registros";

                $paginaURL = "shopNew";

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
            $tabla .= ' <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead style="background:#03a9f4; color:#fff">
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Código</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio S/.</th>
                                        <th scope="col">Subtotal S/.</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>';

            if($total>=1 && $pagina <= $Npaginas){

                $contador = $inicio+1;

                foreach ($datos as $rows) {

                    $tabla.= '      <tr class="text-center">
                                        <th scope="row">'.$contador.'</th>
                                        <td>
                                            '.$rows['codigo'].'
                                        </td>
                                        <td>
                                            '.$rows['nombre'].'
                                        </td>
                                        <td>
                                            '.$rows['cantidad'].'
                                        </td>
                                        <td>
                                            S/ '.$rows['precio'].' 
                                        </td>
                                        <td>
                                            S/ '.$rows['subtotal'].'
                                        </td>
                                        <td>
                                            <form action="'.SERVERURL.'ajax/detalleTempAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data">
                                                <input type="hidden" name="detalle_id_del" value="'.mainModel::encryption($rows['idTempDetalle']).'">
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
                                        <td colspan="8">
                                            <a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info">
                                                <i class="fas fa-retweet"></i> Haga clic acá para actualizar el listado 
                                            </a>
                                        </td>
                                    </tr>';
                }else{
                    $tabla .= '     <tr class="text-center">
                                        <th colspan="8">No hay productos agregados</th>
                                    </tr>';
                }
            }

            $tabla .= '         </tbody>
                            </table>
                        </div>';

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
        public function eliminar_detalleTemp_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['detalle_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);


            $EliminarDetalle = detalleTempModelo::eliminar_detalleTemp_modelo($id);

            if($EliminarDetalle->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"DETALLE ELIMINADO","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
    
            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la el detalle, intenté nuevamente","Tipo"=>"error"];

            }
     

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_detalleTemp_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return detalleTempModelo::datos_detalleTemp_modelo($tipo, $codigo);
        }

	}
    