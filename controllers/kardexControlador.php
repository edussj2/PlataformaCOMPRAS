<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../models/kardexModelo.php";
	}else{
		require_once "./models/kardexModelo.php";
	}

	class kardexControlador extends kardexModelo
	{

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_kardex_controlador($pagina,$registros,$busqueda){
       
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

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM kardex INNER JOIN producto ON kardex.idProducto = producto.idProducto WHERE producto.nombre LIKE '%$busqueda%' ORDER BY producto.nombre ASC LIMIT $inicio,$registros";

                $paginaURL = "kardexSearch";

            }else{

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM kardex ORDER BY idKardex DESC LIMIT $inicio,$registros";

                $paginaURL = "kardex";

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
                                        <th>Producto</th>
                                        <th>U. Entrada</th>
                                        <th>C/U Entrada</th>
                                        <th>U. Salida</th>
                                        <th>C/U Salida</th>
                                        <th>Inv. Inicial</th>
                                        <th>Inv. Actual</th>
                                        <th>DETALLES</th>
                                    </tr>
                                </thead>
                                <tbody>';

            if($total>=1 && $pagina <= $Npaginas){

                $contador = $inicio+1;

                foreach ($datos as $rows) {
                    
                    $query1 = mainModel::ejecutar_consulta_simple("SELECT * FROM producto WHERE idProducto ='".$rows['idProducto']."'");
                    $datosProducto= $query1->fetch();

                    $tabla.= '      <tr class="text-center">
                                        <th scope="row">'.$contador.'</th>
                                        <td>
                                            '.$datosProducto['nombre'].'
                                        </td>
                                        <td>
                                            '.$rows['uniEntrada'].'
                                        </td>
                                        <td>
                                            S/ '.$rows['dinerEntrada'].' Soles
                                        </td>
                                        <td>
                                            '.$rows['uniSalida'].'
                                        </td>
                                        <td>
                                            S/ '.$rows['dinerSalida'].' Soles
                                        </td>
                                        <td>
                                            '.$rows['invenInicial'].'
                                        </td>
                                        <td>
                                            '.$rows['invenActual'].'
                                        </td>
                                        <td>
                                            <a href="'.SERVERURL.'kardexDetails/'.mainModel::encryption($rows['idKardex']).'/" class="btn btn-info" data-toggle="tooltip" title="Detalles" data-placement="bottom">
                                                <i class="fas fa-luggage-cart"></i>
                                            </a>
                                        </td>
                                        
                                    </tr>';
                    $contador++;
                }
            }else{
                if($total>=1){
                    $tabla .= '     <tr> 
                                        <td colspan="9" class="text-center">
                                            <a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info">
                                                <i class="fas fa-retweet"></i> Haga clic acá para actualizar el listado 
                                            </a>
                                        </td>
                                    </tr>';
                }else{
                    $tabla .= '     <tr>
                                        <td colspan="9" class="text-center"> 
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
            
            $tabla .= '<p class="text-right">Total de kardexs : <strong> '.$total.'</strong></p>';

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

        /*DATOS*/
        public function datos_kardex_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return kardexModelo::datos_kardex_modelo($tipo, $codigo);
        }

	}
    