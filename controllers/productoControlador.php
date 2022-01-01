<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../models/productoModelo.php";
	}else{
		require_once "./models/productoModelo.php";
	}

	class productoControlador extends productoModelo
	{
		/*AGREGAR*/
		public function agregar_producto_controlador(){

			/*--DATOS DEL PRODUCTO--*/
			$codigo = mainModel::limpiar_cadena($_POST['producto_codigo_reg']);
			$nombre = mainModel::limpiar_cadena($_POST['producto_nombre_reg']);
			$stockTotal = mainModel::limpiar_cadena($_POST['producto_stock_total_reg']);
			$stockMin = mainModel::limpiar_cadena($_POST['producto_stock_minimo_reg']);
			$precioCompra = mainModel::limpiar_cadena($_POST['producto_precio_compra_reg']);
			$precioVenta = mainModel::limpiar_cadena($_POST['producto_precio_venta_reg']);
			$diametro = mainModel::limpiar_cadena($_POST['producto_diametro_reg']);
			$longitud = mainModel::limpiar_cadena($_POST['producto_longitud_reg']);
			$modelo = mainModel::limpiar_cadena($_POST['producto_modelo_reg']);
			$presentacion = mainModel::limpiar_cadena($_POST['producto_presentacion_reg']);
			$categoria = mainModel::limpiar_cadena($_POST['producto_categoria_reg']);
			$vigencia = mainModel::limpiar_cadena($_POST['producto_estado_reg']);

            /*--VALIDACIONES--*/
            if($codigo == "" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada") || $nombre =="" || $stockTotal =="" || $stockMin == "" || $precioCompra == "" || $precioVenta =="" || $categoria=="Sin Registro" || $presentacion=="Sin Registro"){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
        
                $consulta1 = mainModel::ejecutar_consulta_simple("SELECT nombre, idPresentacion FROM producto WHERE nombre='$nombre' AND idPresentacion = '$presentacion'");
                    
                if($consulta1->rowCount()>=1){
                        
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Ya existe un producto con el nombre ingresado y la presentación seleccionada, intente nuevamente con otra presentación o actualize el existente","Tipo"=>"warning"];
                    
                }else{

                    $consulta5 = mainModel::ejecutar_consulta_simple("SELECT codigo FROM producto WHERE codigo='$codigo'");

                    if($consulta5->rowCount()>=1){

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El código de producto debe ser único, el ingresado ya existe en el sistema","Tipo"=>"warning"];
                            
                    }else{

                        if(is_numeric($stockMin)==false || is_numeric($stockTotal)==false || $stockTotal == 0 ){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El número ingresado en los stocks no son válidos","Tipo"=>"warning"];

                        }else{
                            
                            $consulta2 = mainModel::ejecutar_consulta_simple("SELECT idProducto FROM producto");
                            $numero = ($consulta2->rowCount())+1;

                            $codigoIden= mainModel::generar_codigo_aleatorio("PROD",10,$numero);

                            $foto1 = $_FILES['producto_foto_reg']['name'];
                            $ruta1 = $_FILES['producto_foto_reg']['tmp_name'];
                            
                            if($foto1 != ""){
                                $fotoProd="../files/".$codigoIden."-".$foto1;
                                copy($ruta1,$fotoProd);
                                $nombreFoto= $codigoIden."-".$foto1;
                            }else{
                                $nombreFoto = "producto.png";
                            }

                            $Datosproducto= [   
                                                "codigo"=>$codigo,
                                                "nombre"=>$nombre,
                                                "stockMinimo"=>$stockMin,
                                                "stockTotal"=>$stockTotal,
                                                "precioCompra"=>$precioCompra,
                                                "precioVenta"=>$precioVenta,
                                                "modelo"=>$modelo,
                                                "estado"=>$vigencia,
                                                "imagen"=>$nombreFoto,
                                                "diametro"=>$diametro,
                                                "longitud"=>$longitud,
                                                "idPresentacion"=>$presentacion,
                                                "idCategoria"=>$categoria,
                                                "identificador"=>$codigoIden   
                                            ];

                            $Guardarproducto = productoModelo::agregar_producto_modelo($Datosproducto);

                            if($Guardarproducto->rowCount()>=1){

                                $consulta3 = mainModel::ejecutar_consulta_simple("SELECT * FROM producto WHERE identificador='$codigoIden'");

                                $datosProdReg = $consulta3->fetch();

                                $MontoTotal = $stockTotal * $precioCompra;

                                $datosKardex =  [
                                                    "uniEntrada"=>$stockTotal,
                                                    "uniSalida"=>0,
                                                    "dinerEntrada"=>$MontoTotal,
                                                    "dinerSalida"=>0,
                                                    "invenInicial"=>$stockTotal,
                                                    "invenActual"=>$stockTotal,
                                                    "mesxyear"=>$codigoIden,
                                                    "idProducto"=>$datosProdReg['idProducto']
                                                ];

                                $GuardarKardex = mainModel::agregar_kardex_modelo($datosKardex);

                                if($GuardarKardex->rowCount()>=1){
                                    $consulta4 = mainModel::ejecutar_consulta_simple("SELECT * FROM kardex WHERE mesxyear='$codigoIden'");

                                    $datosKarReg = $consulta4->fetch();

                                    $fechaActual = date('Y-m-d');

                                    $datosdetalleKardex =  [
                                        "fecha"=>$fechaActual,
                                        "tipo"=>"Entrada",
                                        "descripcion"=>"Compra de producto (Mediante registro)",
                                        "unidades"=>$stockTotal,
                                        "precio"=>$precioCompra,
                                        "total"=>$MontoTotal,
                                        "kardex"=>$datosKarReg['idKardex']
                                    ];

                                    $GuardardetalleKardex = mainModel::agregar_kadexDetalle_modelo($datosdetalleKardex);

                                    if($GuardardetalleKardex->rowCount()>=1){
                                        $alerta = ["Alerta"=>"limpiar", "Titulo"=>"PRODUCTO REGISTRADO","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];
                                    }else{
                                        if($nombreFoto != "producto.png"){
                                            @unlink('../files/'.$nombreFoto);  
                                        } 
                                        $eliminarkardexDetalle = mainModel::eliminar_kardexDetalle_modelo($datosKarReg['idKardex']);
                                        $eliminarProducto = productoModelo::eliminar_producto_modelo($datosProdReg['idProducto']); 
                                        $eliminarkardex = mainModel::eliminar_kardex_modelo($datosProdReg['idProducto']);             
                                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro del DETALLE DEL KARDEX, intente nuevamente","Tipo"=>"error"];
                                    }
  
                                }else{
                                    if($nombreFoto != "producto.png"){
                                        @unlink('../files/'.$nombreFoto);  
                                    } 
                                    $eliminarProducto = productoModelo::eliminar_producto_modelo($datosProdReg['idProducto']);             
                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro del KARDEX, intente nuevamente","Tipo"=>"error"];
                                }   

                            }else{
                                if($nombreFoto != "producto.png"){
                                    @unlink('../files/'.$nombreFoto);  
                                }           
                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro del producto, intente nuevamente","Tipo"=>"error"];

                            }
                                
                        }
                    }
                        
                }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_producto_controlador($pagina,$registros,$busqueda,$categoria){
       
            /**-----LIMPIAMOS PARAMETROS RECIBIDOS-----**/
            $pagina = mainModel::limpiar_cadena($pagina);
            $registros = mainModel::limpiar_cadena($registros);
            $busqueda = mainModel::limpiar_cadena($busqueda);
            $categoria = mainModel::limpiar_cadena($categoria);
            $tabla = "";

            /**-----VALIDAMOS LAS PAGINAS Y EL ORDEN DE LOS REGISTROS----**/
            $pagina = (isset($pagina) && $pagina>0) ? (int)$pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros) - $registros): 0;

            /**-----VALIDAMOS SI ES UNA BUSQUEDA O SI ES LA LISTA---**/
            if(isset($busqueda) && $busqueda!=""){

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM producto WHERE nombre LIKE '%$busqueda%' OR codigo LIKE '%$busqueda%'ORDER BY nombre ASC LIMIT $inicio,$registros";

                $paginaURL = "productSearch";

            }elseif(isset($categoria) && $categoria!=""){
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM producto WHERE idCategoria = $categoria ORDER BY nombre ASC LIMIT $inicio,$registros";

                $paginaURL = "productCategory/".$categoria;
            }else{

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM producto ORDER BY nombre ASC LIMIT $inicio,$registros";

                $paginaURL = "productList";

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
            $tabla .= ' <ul class="list-unstyled" style="padding: 5px;">';

            if($total>=1 && $pagina <= $Npaginas){

                $contador = $inicio+1;

                foreach ($datos as $rows) {

                    $query1 = mainModel::ejecutar_consulta_simple("SELECT * FROM kardex WHERE idProducto ='".$rows['idProducto']."'");
                    $datosKARDEX= $query1->fetch();

                    $tabla.= '  <li class="media media-product">
                                    <img class="img-fluid img-product-list" src="'.SERVERURL.'files/'.$rows['imagen'].'" alt="'.$rows['codigo'].'">
                                    <div class="media-body product-media-body">
                                            <p class="text-uppercase text-center media-product-title"><strong>'.$contador.' - '.$rows['nombre'].'</strong></p>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 col-lg-3 col-product"><i class="fas fa-barcode"></i> <strong>Código de barras:</strong> '.$rows['codigo'].'</div>

                                                    <div class="col-12 col-md-6 col-lg-3 col-product"><i class="far fa-money-bill-alt"></i> <strong>Precio:</strong> S/'.$rows['precioVenta'].' Soles </div>
                                                    
                                                    <div class="col-12 col-md-6 col-lg-3 col-product"><i class="fas fa-clipboard-check"></i> <strong>Estado:</strong> '.$rows['estado'].'</div>

                                                    <div class="col-12 col-md-6 col-lg-3 col-product"><i class="fas fa-box"></i> <strong>Disponibles:</strong> '.$rows['stockTotal'].'</div>

                                                    <div class="col-12 col-md-6 col-lg-3 col-product"><i class="fas fa-box-open"></i> <strong>Diámetro:</strong> '.$rows['diametro'].'</div>

                                                    <div class="col-12 col-md-6 col-lg-3 col-product"><i class="fab fa-buromobelexperte"></i> <strong>Modelo:</strong> '.$rows['modelo'].'</div>
                                                </div>
                                            </div>

                                            <div class="text-right media-product-options">
                                                <span><i class="fas fa-tools"></i> OPCIONES: &nbsp;</span>

                                                <a href="'.SERVERURL.'productDetails/'.mainModel::encryption($rows['idProducto']).'/" class="btn btn-info btn-sm mb-1" data-toggle="tooltip"  data-placement="top" title="Información detallada">
                                                    <i class="fas fa-box-open"></i>
                                                </a>

                                                <a href="'.SERVERURL.'productImg/'.mainModel::encryption($rows['idProducto']).'/" class="btn btn-warning btn-sm mb-1" data-toggle="tooltip" data-placement="top" title="Gestionar imagen">
                                                    <i class="far fa-image"></i>
                                                </a>

                                                <a href="'.SERVERURL.'kardexDetails2/'.mainModel::encryption($datosKARDEX['idKardex']).'/" class="btn btn-primary btn-sm mb-1" data-toggle="tooltip" data-placement="top" title="Kardex">
                                                    <i class="fas fa-luggage-cart"></i>
                                                </a>

                                                <a href="'.SERVERURL.'productEdit/'.mainModel::encryption($rows['idProducto']).'/" class="btn btn-success btn-sm mb-1" data-toggle="tooltip" data-placement="top" title="Actualizar producto">
                                                    <i class="fas fa-sync"></i>
                                                </a>

                                                <form class="FormularioAjax form-product" action="'.SERVERURL.'ajax/productoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                                    <input type="hidden" name="producto_id_del" value="'.mainModel::encryption($rows['idProducto']).'">
                                                    <input type="hidden" name="producto_img_del" value="'.mainModel::encryption($rows['imagen']).'">
                                                    <button type="submit" class="btn btn-danger btn-sm mb-1" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                            <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    <div class="RespuestaAjax"></div>
                                                </form>
                                            </div>
                                    </div>
                                </li>';
                    $contador++;
                }
            }else{
                if($total>=1){
                    $tabla .= '     <li class="media media-product d-flex justify-content-center p-4">
                                            <a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info">
                                                <i class="fas fa-retweet"></i> Haga clic acá para actualizar el listado 
                                            </a>
                                    </li>
                                        ';
                }else{
                    $tabla .= '     <li class="media media-product d-flex justify-content-center p-4"> 
                                            <div class="alert alert-dark" role="alert">
                                                <i class="fas fa-bullhorn"></i> NO HAY REGISTOS EN EL SISTEMA 
                                            </div>
                                    </li>';
                }
            }

            $tabla .= '         </ul>';
            
            $tabla .= '<p class="text-right">Total de productos : <strong> '.$total.'</strong></p>';

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
        public function eliminar_producto_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['producto_id_del']);
            $img = mainModel::decryption($_POST['producto_img_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);

            $consultaCompra = mainModel::ejecutar_consulta_simple("SELECT idCompraDetalle FROM compra_detalle WHERE idProducto ='$id'");

            $consultaVenta = mainModel::ejecutar_consulta_simple("SELECT idVentaDetalle FROM venta_detalle WHERE idProducto ='$id'");

            if($consultaCompra->rowCount()==0 || $consultaVenta->rowCount()==0){
                $Eliminarproducto = productoModelo::eliminar_producto_modelo($id);

                if($Eliminarproducto->rowCount()>=1){
                    if($img != "producto.png"){
                        @unlink('../files/'.$img);
                    }
                    $alerta = ["Alerta"=>"recargar", "Titulo"=>"PRODUCTO ELIMINADO","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
        
                }else{
    
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar el producto, intenté nuevamente","Tipo"=>"error"];
    
                }
            }else{
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se puede eliminar el product porque que este asociado a otros registros, se recomienda cambiar el estado","Tipo"=>"error"];
            }
            
     

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_producto_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return productoModelo::datos_producto_modelo($tipo, $codigo);
        }

        /*ELIMINAR IMAGEN */
        public function eliminar_imagen_producto_controlador(){

            $id = mainModel::decryption($_POST['producto_img_id_del']);
            $img = mainModel::limpiar_cadena($_POST['producto_img_img_del']);

            $dataImgUp = [
                            "codigo"=>$id,
                            "imagen"=>"producto.png",
                        ];
            
            $ProductoImgUP = productoModelo::actualizar_imagen_producto_modelo($dataImgUp);

            if($ProductoImgUP->rowCount()>=1){

                @unlink('../files/'.$img);
                
                $alerta = ["Alerta"=>"recargar", "Titulo"=>"IMAGEN DEL PRODUCTO ELIMINADA","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
    
            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la imagen, intenté nuevamente","Tipo"=>"error"];

            }
            return mainModel::sweet_alert($alerta);
        }

        /*ACTUALIZAR IMAGEN */
        public function actualizar_imagen_producto_controlador(){

            $id = mainModel::decryption($_POST['producto_img_id_up']);
            $img = mainModel::limpiar_cadena($_POST['producto_img_img_up']);

            $foto1 = $_FILES['producto_foto_up']['name'];
            $ruta1 = $_FILES['producto_foto_up']['tmp_name'];

            if($foto1 != "" ){

                $query = mainModel::ejecutar_consulta_simple("SELECT idProducto FROM producto");
                $numero = ($query->rowCount())+1;

                $codigoIden= mainModel::generar_codigo_aleatorio("PROD",10,$numero);

                $fotoProd="../files/".$codigoIden."-".$foto1;
                copy($ruta1,$fotoProd);
                $nombreFoto= $codigoIden."-".$foto1;


                $dataImgUp = [
                    "codigo"=>$id,
                    "imagen"=>$nombreFoto,
                ];
    
                $ProductoImgUP = productoModelo::actualizar_imagen_producto_modelo($dataImgUp);

                if($ProductoImgUP->rowCount()>=1){

                    if($img != "producto.png"){
                        @unlink('../files/'.$img);
                    }
                    $alerta = ["Alerta"=>"recargar", "Titulo"=>"IMAGEN DEL PRODUCTO ACTUALIZADA","Texto"=>"Los datos se actualizarón satisfactoriamente del sistema.","Tipo"=>"success"];

                }else{

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la imagen, intenté nuevamente","Tipo"=>"error"];

                }
            }else{
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se ha cargado ninguna imagen, intente nuevamente","Tipo"=>"error"];
            }

            
            return mainModel::sweet_alert($alerta);
        }

        /* ACTUALIZAR */
        public function actualizar_producto_controlador(){

            /*--DATOS DEL PRODUCTO--*/
            $id = mainModel::decryption($_POST['producto_id_up']);
			$codigo = mainModel::limpiar_cadena($_POST['producto_codigo_up']);
			$nombre = mainModel::limpiar_cadena($_POST['producto_nombre_up']);
			$stockTotal = mainModel::limpiar_cadena($_POST['producto_stock_total_up']);
			$stockMin = mainModel::limpiar_cadena($_POST['producto_stock_minimo_up']);
			$precioCompra = mainModel::limpiar_cadena($_POST['producto_precio_compra_up']);
			$precioVenta = mainModel::limpiar_cadena($_POST['producto_precio_venta_up']);
			$diametro = mainModel::limpiar_cadena($_POST['producto_diametro_up']);
			$longitud = mainModel::limpiar_cadena($_POST['producto_longitud_up']);
			$modelo = mainModel::limpiar_cadena($_POST['producto_modelo_up']);
			$presentacion = mainModel::limpiar_cadena($_POST['producto_presentacion_up']);
			$categoria = mainModel::limpiar_cadena($_POST['producto_categoria_up']);
			$vigencia = mainModel::limpiar_cadena($_POST['producto_estado_up']);

            if($codigo == "" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada") || $nombre =="" || $stockTotal =="" || $stockMin == "" || $precioCompra == "" || $precioVenta =="" || $categoria=="Sin Registro" || $presentacion=="Sin Registro"){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos correctamente","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM producto WHERE idProducto ='$id'");

            $datos = $consulta1->fetch();

            if($nombre != $datos['nombre']){

                $consulta2 = mainModel::ejecutar_consulta_simple("SELECT nombre, idPresentacion FROM producto WHERE nombre='$nombre' AND idPresentacion = '$presentacion'");

                if($consulta2->rowCount()>=1){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Ya hay un producto registrado con este nombre y esta presentación, intenté nuevamente","Tipo"=>"error"];
                    return mainModel::sweet_alert($alerta);
                    exit();

                }
            }

            if($presentacion != $datos['idPresentacion']){

                $consulta3 = mainModel::ejecutar_consulta_simple("SELECT nombre, idPresentacion FROM producto WHERE nombre='$nombre' AND idPresentacion = '$presentacion'");

                if($consulta3->rowCount()>=1){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Ya hay un producto registrado con este nombre y esta presentación, intenté nuevamente","Tipo"=>"error"];
                    return mainModel::sweet_alert($alerta);
                    exit();

                }
            }

            if($codigo != $datos['codigo']){

                $consulta4 = mainModel::ejecutar_consulta_simple("SELECT codigo FROM producto WHERE codigo ='$codigo'");

                if($consulta4->rowCount()>=1){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El código ya ha sido registrada en el sistema, intenté nuevamente","Tipo"=>"error"];
                    return mainModel::sweet_alert($alerta);
                    exit();

                }
            }

            if(is_numeric($stockMin)==false || is_numeric($stockTotal)==false ){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El número en los stocks ingresados no son válidos","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();

            }

            if($stockTotal == 0){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El stock Total debe ser mayor que 0","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();

            }


            $datosproducto= [   "codigo"=>$codigo,
                                "nombre"=>$nombre,
                                "stockMinimo"=>$stockMin,
                                "stockTotal"=>$stockTotal,
                                "precioCompra"=>$precioCompra,
                                "precioVenta"=>$precioVenta,
                                "modelo"=>$modelo,
                                "estado"=>$vigencia,
                                "diametro"=>$diametro,
                                "longitud"=>$longitud,
                                "idPresentacion"=>$presentacion,
                                "idCategoria"=>$categoria,
                                "id"=>$id
                            ];

            if(productoModelo::actualizar_producto_modelo($datosproducto)->rowCount()>=1){

                $consulta5 = mainModel::ejecutar_consulta_simple("SELECT * FROM kardex WHERE idProducto ='$id'");

                $datosK = $consulta5->fetch();

                if($stockTotal == $datos['stockTotal']){

                    $alerta = ["Alerta"=>"recargar", "Titulo"=>"PRODUCTO ACTUALIZADO","Texto"=>"Los datos fueron actualizados con éxito","Tipo"=>"success"];

                }else{
                    if($stockTotal > $datos['stockTotal']){

                        $tipo = "Entrada";
                        $unidades = $stockTotal - $datos['stockTotal'];
                        $nuevaUnidades = $unidades + $datosK['uniEntrada'];
                        $monto = $unidades * $datos['precioCompra'];
                        $nuevoMonto = $monto + $datosK['dinerEntrada'];
                        $inventario = $datosK['invenActual']+$unidades;

                        $datosEntrada = ["uniEntrada"=> $nuevaUnidades,
                                         "dinerEntrada"=> $nuevoMonto,
                                         "invenActual"=>$inventario,
                                         "codigo"=>$datosK['mesxyear']
                                        ];

                        $ActualizarKardex = mainModel::actualizar_kardex_entrada_modelo($datosEntrada);
    
                    }else{

                        $tipo = "Salida";
                        $unidades = $datos['stockTotal'] - $stockTotal;
                        $nuevaUnidades = $unidades + $datosK['uniSalida'];
                        $monto = $unidades * $datos['precioVenta'];
                        $nuevoMonto = $datosK['dinerSalida'] + $monto;
                        $inventario = $datosK['invenActual']-$unidades;

                        $datosSalida = ["uniSalida"=> $nuevaUnidades,
                                         "dinerSalida"=> $nuevoMonto,
                                         "invenActual"=>$inventario,
                                         "codigo"=>$datosK['mesxyear']
                                        ];
                                        
                        $ActualizarKardex = mainModel::actualizar_kardex_salida_modelo($datosSalida);
                    }

                    if($ActualizarKardex->rowCount()>=1){

                        $consulta6 = mainModel::ejecutar_consulta_simple("SELECT * FROM kardex WHERE idProducto ='$id'");

                        $datosDK = $consulta6->fetch();

                        $fechaActual = date('Y-m-d');

                        $RegDetKardex =  [
                            "fecha"=>$fechaActual,
                            "tipo"=>$tipo,
                            "descripcion"=>"Actualización de Producto",
                            "unidades"=>$unidades,
                            "precio"=>$precioCompra,
                            "total"=>$monto,
                            "kardex"=>$datosDK['idKardex']
                        ];
                                        
                        $RegistrarDetalleKardex = mainModel::agregar_kadexDetalle_modelo($RegDetKardex);

                        if($RegistrarDetalleKardex->rowCount()>=1){

                            $alerta = ["Alerta"=>"recargar", "Titulo"=>"PRODUCTO ACTUALIZADO","Texto"=>"Los datos fueron actualizados con éxito","Tipo"=>"success"];

                        }else{

                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudieron registrar los detalles de los datos del Kardex del producto, intenté nuevamente","Tipo"=>"error"];

                        }


                    }else{

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudieron actualizar los datos del Kardex del producto, intenté nuevamente","Tipo"=>"error"];
                        
                    }

                }
                   

            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudieron actualizar los datos del producto, intenté nuevamente","Tipo"=>"error"];

            }
            return mainModel::sweet_alert($alerta);
        }
	}
    