<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../models/compraModelo.php";
	}else{
		require_once "./models/compraModelo.php";
	}

	class compraControlador extends compraModelo
	{
		/*AGREGAR*/
		public function agregar_compra_controlador(){

			/*--DATOS DE LA compra--*/
			$fecha = mainModel::limpiar_cadena($_POST['compra_fecha_reg']);
			$proveedor = mainModel::limpiar_cadena($_POST['compra_proveedor_reg']);
			$caja = mainModel::limpiar_cadena($_POST['compra_caja_reg']);
			$subtotal = mainModel::limpiar_cadena($_POST['compra_subtotal_reg']);
			$total = mainModel::limpiar_cadena($_POST['compra_total_reg']);
			$usuario = mainModel::decryption($_POST['compra_usuario_reg']);
			$idPago = mainModel::limpiar_cadena($_POST['compra_pago_reg']);
            $estado = "Registrada";


            /*--VALIDACIONES--*/
            if($proveedor == "Sin Registro" || $fecha == "" || $caja == "Sin Registro" || $usuario=="" || $idPago =="Sin Registro"){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
        
                $consultarCaja = mainModel::ejecutar_consulta_simple("SELECT * FROM caja WHERE idCaja='$caja'");

                $cajaData = $consultarCaja->fetch();
                
                if( $total > $cajaData['efectivo']){
                        
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No hay suficiente efectivo en la caja seleccionada","Tipo"=>"warning"];
                    
                }else{

                    $consulta1 = mainModel::ejecutar_consulta_simple("SELECT idCompra FROM compra");
                    $numero = ($consulta1->rowCount())+1;

                    $codigoCompra= mainModel::generar_codigo_aleatorio("COMPRA",10,$numero);

                    $DatosCompra= [ "codigo"=>$codigoCompra,
                                    "fecha"=>$fecha,
                                    "subtotal"=>$subtotal,
                                    "montoTotal"=>$total,
                                    "estado"=>$estado,
                                    "idProveedor"=>$proveedor,
                                    "idCaja"=>$caja,
                                    "idUsuario"=>$usuario,
                                    "idEmpresa"=>1,
                                    "idPago"=>$idPago];

                    $GuardarCompra = compraModelo::agregar_compra_modelo($DatosCompra);

                    if($GuardarCompra->rowCount()>=1){

                        $efectivo = $cajaData['efectivo'] - $total;
                        $actualizarCaja = mainModel::actualizar_efectivo_caja_modelo($efectivo,$caja);

                        $consulta2 = mainModel::ejecutar_consulta_simple("SELECT idCompra FROM compra WHERE CodigoCompra='$codigoCompra'");
                        $dataCompra = $consulta2->fetch();
                        $idCompra = $dataCompra['idCompra'];


                        $consulta3 = mainModel::ejecutar_consulta_simple("SELECT * FROM temp_detalle");

                        $numeroDetalles = $consulta3->rowCount();
                        $banderaDetalles = 0;
                        $banderaProducto = 0;
                        $banderaKardex = 0;

                        while($row = $consulta3->fetch()){

                            $productoDetalle = $row['idProducto'];
                            $subtotalDetalle = $row['subtotal'];
                            $precioDetalle = $row['precio'];
                            $cantidadDetalle = $row['cantidad'];

                            $datosDetalleCompra = [
                                "idCompra" => $idCompra,
                                "idProducto" => $productoDetalle,
                                "CodigoCompra"=> $codigoCompra,
                                "cantidad" => $cantidadDetalle,
                                "precio" => $precioDetalle,
                                "subTotal" => $subtotalDetalle];

                            $GuardarDetalleCompra = mainModel::agregar_detalle_compra_modelo($datosDetalleCompra);

                            if($GuardarDetalleCompra->rowCount()>=1){
                               
                                $banderaDetalles++;

                                $consulta5 = mainModel::ejecutar_consulta_simple("SELECT stockTotal FROM producto WHERE idProducto=$productoDetalle");
                                $dataProducto = $consulta5->fetch();

                                $stockNuevo = $dataProducto['stockTotal'] + $cantidadDetalle;

                                $ActualizarStock = mainModel::actualizar_stock_producto_modelo($stockNuevo,$productoDetalle,$precioDetalle);

                                if($ActualizarStock->rowCount()>=1){
                                    $banderaProducto++;

                                    $consulta6 = mainModel::ejecutar_consulta_simple("SELECT * FROM kardex WHERE idProducto=$productoDetalle");
                                    $dataKardex = $consulta6->fetch();

                                    $nuevaUnidades = $dataKardex['uniEntrada']+ $cantidadDetalle;
                                    $nuevoMonto = $dataKardex['dinerEntrada']+$subtotalDetalle;
                                    $inventario = $dataKardex['invenActual']+$nuevaUnidades;

                                    $datosEntrada = ["uniEntrada"=> $nuevaUnidades,
                                    "dinerEntrada"=> $nuevoMonto,
                                    "invenActual"=>$inventario,
                                    "codigo"=>$dataKardex['mesxyear']
                                   ];

                                    $ActualizarKardex = mainModel::actualizar_kardex_entrada_modelo($datosEntrada);

                                    $consulta7 = mainModel::ejecutar_consulta_simple("SELECT * FROM kardex WHERE idProducto ='$productoDetalle'");

                                    $datosDK = $consulta7->fetch();

                                    $RegDetKardex =  [
                                        "fecha"=>$fecha,
                                        "tipo"=>"Entrada",
                                        "descripcion"=>"Compra de Producto",
                                        "unidades"=>$cantidadDetalle,
                                        "precio"=>$precioDetalle,
                                        "total"=>$subtotalDetalle,
                                        "kardex"=>$datosDK['idKardex']
                                    ];
                                                    
                                    $RegistrarDetalleKardex = mainModel::agregar_kadexDetalle_modelo($RegDetKardex);

                                    if($ActualizarKardex->rowCount()>=1 && $RegistrarDetalleKardex->rowCount()>=1){
                                        $banderaKardex++;
                                    }else{
                                        $banderaKardex--;
                                    }

                                }else{
                                    $banderaProducto--;
                                }

                            }else{            
                                $banderaDetalles--;
                            }

                        }

                        if($numeroDetalles==$banderaDetalles && $banderaProducto==$numeroDetalles && $banderaKardex == $numeroDetalles){

                            $consulta4 = mainModel::ejecutar_consulta_simple("DELETE FROM temp_detalle");
                            $alerta = ["Alerta"=>"recargar", "Titulo"=>"COMPRA REGISTRADA","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];

                        }else{
                            $eliminarCompra = compraModelo::eliminar_compra_modelo($idCompra); 
                            $eliminarDetalleCompra = mainModel::eliminar_detalle_compra_modelo($idCompra);            
                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro de los detalles de la compra, intente nuevamente","Tipo"=>"error"];
                        }

                    }else{
                                                
                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro de la compra, intente nuevamente","Tipo"=>"error"];

                    }    
                        
                }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_compra_controlador($pagina,$registros,$busqueda){
       
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

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM compra INNER JOIN proveedor ON compra.idProveedor = proveedor.idProveedor INNER JOIN usuario ON compra.idUsuario = usuario.idUsuario WHERE fecha = '$busqueda' ORDER BY fecha DESC LIMIT $inicio,$registros";

                $paginaURL = "shopSearch";

            }else{

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM compra INNER JOIN proveedor ON compra.idProveedor = proveedor.idProveedor INNER JOIN usuario ON compra.idUsuario = usuario.idUsuario ORDER BY fecha DESC LIMIT $inicio,$registros";

                $paginaURL = "shopList";

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
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Proveedor</th>
                                        <th>Trabajador</th>
                                        <th>Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>';

            if($total>=1 && $pagina <= $Npaginas){

                $contador = $inicio+1;

                foreach ($datos as $rows) {

                    $tabla.= '      <tr class="text-center">
                                        <th scope="row">'.$contador.'</th>
                                        <td>
                                            '.$rows['fecha'].'
                                        </td>
                                        <td>
                                            '.$rows['montoTotal'].'
                                        </td>
                                        <td>
                                            '.$rows['razSocial'].'
                                        </td>
                                        <td>
                                            '.$rows['nombres'].' '.$rows['apellidos'].'
                                        </td>
                                        <td>
                                            <a href="'.SERVERURL.'shopDetails/'.mainModel::encryption($rows['idCompra']).'/" class="btn btn-info" data-toggle="tooltip" title="Detalles de la compra" data-placement="bottom">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
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
            
            $tabla .= '<p class="text-right">Total de compras : <strong> '.$total.'</strong></p>';

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
        public function datos_compra_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return compraModelo::datos_compra_modelo($tipo, $codigo);
        }

        /*COMPLETAR COMPRA*/
        public function completar_compra($datos){

        }
	}
    