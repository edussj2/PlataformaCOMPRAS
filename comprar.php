<?php 
    const SGBD='mysql:dbname=pernosypernos;host=localhost';
    const USER='root';
    const PASS='';
    const SERVERURL = "http://localhost:8080/Proyectos/Pernos&Pernos/";

    $conexion = new PDO(SGBD,USER,PASS);


    /**-----FUNCIONA PARA LIMPIAR CADENA-----**/
    function limpiar_cadena($cadena){
        $cadena = str_ireplace("<script>","", $cadena); //QUITA Y REMPLAZA SEGUN QUERRÁMOS
        $cadena = str_ireplace("</script>","", $cadena);
        $cadena = str_ireplace("<script src","", $cadena);
        $cadena = str_ireplace("<script type","", $cadena);
        $cadena = str_ireplace("SELECT *  FROM","", $cadena);
        $cadena = str_ireplace("DELETE FROM","", $cadena);
        $cadena = str_ireplace("INSERT INTO","", $cadena);
        $cadena = str_ireplace("UPDATE SET","", $cadena);
        $cadena = str_ireplace("[","", $cadena);
        $cadena = str_ireplace("]","", $cadena);
        $cadena = str_ireplace("==","", $cadena);
        $cadena = str_ireplace("DROP TABLE","", $cadena);
        $cadena = str_ireplace("SHOW TABLES","", $cadena);
        $cadena = str_ireplace("SHOW DATABASES","", $cadena);
        $cadena = str_ireplace("<?php","", $cadena);
        $cadena = str_ireplace("?>","", $cadena);
        $cadena = str_ireplace("DELETE administrador","", $cadena);
        $cadena = str_ireplace("DELETE colegiado","", $cadena);
        $cadena = str_ireplace("::","", $cadena);
        $cadena = trim($cadena);//QUITA ESPACIOS EN BLANCO
        $cadena = stripcslashes($cadena);//QUITA BARRAS INVERTIDAS
        return $cadena;
    }

    /**-----FUNCION GENERAR CODIGO ALEATORIO-----**/
    function generar_codigo_aleatorio($letra,$longitud,$num){
        for($i=1 ; $i<=$longitud; $i++){
            $numero = rand(0,9);
            $letra.= $numero;
        }

        return $letra.$num;
    }




	/*--DATOS DE LA compra--*/
	$fecha = limpiar_cadena($_POST['compra_fecha_reg']);
	$proveedor = limpiar_cadena($_POST['compra_proveedor_reg']);
	$caja = limpiar_cadena($_POST['compra_caja_reg']);
	$subtotal = limpiar_cadena($_POST['compra_subtotal_reg']);
	$total = limpiar_cadena($_POST['compra_total_reg']);
	$usuario = limpiar_cadena($_POST['compra_usuario_reg']);
	$idPago = limpiar_cadena($_POST['compra_pago_reg']);
    $estado = "Registrada";

    echo $fecha.'--';
    echo $proveedor.'--';
    echo $caja.'--';
    echo $subtotal.'--';
    echo $total.'--';
    echo $usuario.'--';
    echo $idPago;

    /*--VALIDACIONES--*/
    if($proveedor == "Sin Registro" || $fecha == "" || $caja == "Sin Registro" || $usuario=="" || $idPago =="Sin Registro"){

        $alerta = "error01";

    }else{
        
        $consultarCaja = "SELECT * FROM caja WHERE idCaja=$caja"; 
        $rptaCaja = $conexion->query($consultarCaja);

        $cajaData = $rptaCaja->fetch();
                
        

        if( $total > $cajaData['efectivo']){
                        
            $alerta= "error02";
                    
        }else{

            $consulta1 = "SELECT idCompra FROM compra";
            $rptaconsulta1 = $conexion->query($consulta1);
            $numero = ($rptaconsulta1->rowCount())+1;

            $codigoCompra= generar_codigo_aleatorio("COMPRA",10,$numero);

            $GuardarCompra = "INSERT INTO compra(CodigoCompra, fecha, montoTotal, subtotal, estado, idProveedor, idCaja, idUsuario,idEmpresa,idPago) 
			VALUES('$codigoCompra', '$fecha', $total, $subtotal, '$estado', $proveedor, $caja, $usuario, 1,$idPago)";

            $rptaGuardarCompra = $conexion->query($GuardarCompra);

            if($rptaGuardarCompra->rowCount()>=1){

                $efectivo = $cajaData['efectivo'] - $total;
                $actualizarCaja = "UPDATE caja SET efectivo='$efectivo' WHERE idCaja='$caja'";
                $rptaactualizarCaja = $conexion->query($actualizarCaja);

                $consulta2 = "SELECT idCompra FROM compra WHERE CodigoCompra='$codigoCompra'";
                $rptaconsulta2 = $conexion->query($consulta2);
                $dataCompra = $rptaconsulta2->fetch();
                $idCompra = $dataCompra['idCompra'];

                $consulta3 = "SELECT * FROM temp_detalle";
                $rptaconsulta3 = $conexion->query($consulta3);

                $numeroDetalles = $rptaconsulta3->rowCount();
                $banderaDetalles = 0;
                $banderaProducto = 0;
                $banderaKardex = 0;

                while($row = $rptaconsulta3->fetch()){

                    $productoDetalle = $row['idProducto'];
                    $subtotalDetalle = $row['subtotal'];
                    $precioDetalle = $row['precio'];
                    $cantidadDetalle = $row['cantidad'];

                    echo '<BR>DETALLE'." ".$idCompra."-".$productoDetalle."-".$codigoCompra."-".$cantidadDetalle."-".$precioDetalle."-".$subtotalDetalle."<br>";

                    $GuardarDetalleCompra = "INSERT INTO compra_detalle(idCompra, idProducto, CodigoCompra, cantidad,precio,subTotal) 
			VALUES($idCompra, $productoDetalle, '$codigoCompra', $cantidadDetalle, $precioDetalle, $subtotalDetalle)";
                    $rptaGuardarDetalleCompra = $conexion->query($GuardarDetalleCompra);

                    if($rptaGuardarDetalleCompra->rowCount()==1){
                               
                        $banderaDetalles++;

                        $consulta5 = "SELECT stockTotal FROM producto WHERE idProducto=$productoDetalle";
                        $rptaconsulta5 = $conexion->query($consulta5);
                        $dataProducto = $rptaconsulta5->fetch();

                        $stockNuevo = $dataProducto['stockTotal'] + $cantidadDetalle;

                        $ActualizarStock ="UPDATE producto SET stockTotal='$stockNuevo', precioCompra='$precioDetalle' WHERE idProducto='$productoDetalle'";
                        $rptaActualizarStock = $conexion->query($ActualizarStock);

                        if($rptaActualizarStock->rowCount()>=1){
                            $banderaProducto++;

                            $consulta6 = "SELECT * FROM kardex WHERE idProducto=$productoDetalle";
                            $rptaconsulta6 = $conexion->query($consulta6);
                            $dataKardex = $rptaconsulta6->fetch();
                            $mexyear= $dataKardex['mesxyear'];

                            $nuevaUnidades = $dataKardex['uniEntrada']+ $cantidadDetalle;
                            $nuevoMonto = $dataKardex['dinerEntrada']+$subtotalDetalle;
                            $inventario = $dataKardex['invenActual']+$nuevaUnidades;

                            $ActualizarKardex = "UPDATE kardex SET uniEntrada=$nuevaUnidades,dinerEntrada=$nuevoMonto, invenActual=$inventario WHERE mesxyear='$mexyear'";
                            $rptaActualizarKardex = $conexion->query($ActualizarKardex);

                            $consulta7 = "SELECT * FROM kardex WHERE idProducto ='$productoDetalle'";
                            $rptaconsulta7 = $conexion->query($consulta7);

                            $datosDK = $rptaconsulta7->fetch();
                            $idKardex = $datosDK['idKardex'];
                                                    
                            $RegistrarDetalleKardex = "INSERT INTO kardex_detalle(fecha, tipo, descripcion, unidades,precio,total,idKardex) 
			VALUES('$fecha','Entrada', 'Compra de Producto', $cantidadDetalle, $precioDetalle, $subtotalDetalle, $idKardex)";
                            $rptaRegistrarDetalleKardex = $conexion->query($RegistrarDetalleKardex);

                            if($rptaActualizarKardex->rowCount()>=1 && $rptaRegistrarDetalleKardex->rowCount()>=1){
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

                    $consulta4 = "DELETE FROM temp_detalle";
                    $rptaconsulta4 = $conexion->query($consulta4);
                    $alerta = "exito";

                }else{ 
                    $eliminarDetalleCompra = "DELETE FROM compra_detalle WHERE idCompra='$idCompra'";  
                    $rptaeliminarDetalleCompra = $conexion->query($eliminarDetalleCompra);          
                    $alerta ="error03";
                }

            }else{
                                                
                $alerta = "error04";

            }    
                        
        }
                
    }    
            
     echo '<script> window.location.href="'.SERVERURL.'shopNew/'.$alerta.'"</script>';

  