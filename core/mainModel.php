<?php
	if($peticionAjax){
		require_once "../core/configBaseDatos.php";
	}else{
		require_once "./core/configBaseDatos.php";
	}
	class mainModel
	{

		/*********************************/
		/******* FUNCIONES BASICAS *******/
		/*********************************/

		/*Conectar*/
		protected function conectar(){
		    $conexion = new PDO(SGBD,USER,PASS);

		    return $conexion;
		}

		/*Consultas Simples*/
		protected function ejecutar_consulta_simple($consulta){
			$sql = self::conectar()->prepare($consulta);
			$sql->execute();
			return $sql;
		}

		/*Encryptar*/
		public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}

		/*Desincriptar*/
		public static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}

		/*Código Aleatorio*/
		protected function generar_codigo_aleatorio($letra,$longitud,$num){
			for($i=1 ; $i<=$longitud; $i++){
				$numero = rand(0,9);
				$letra.= $numero;
			}

			return $letra.$num;
		}

		/*Limpiar Cadena*/
		protected function limpiar_cadena($cadena){
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
			$cadena = str_ireplace("DELETE compra","", $cadena);
			$cadena = str_ireplace("DELETE usuario","", $cadena);
			$cadena = str_ireplace("/","", $cadena);
			$cadena = str_ireplace("::","", $cadena);
			$cadena = trim($cadena);//QUITA ESPACIOS EN BLANCO
			$cadena = stripcslashes($cadena);//QUITA BARRAS INVERTIDAS
			return $cadena;
		}

		/*Verificar Fechas*/
		protected function verificar_fecha($fecha){
			$valores = explode('/', $fecha);
			if(count($valores)==3 && checkdate($valores[1], $valores[0], $valores[2])){
				return false;
			}else{
				return true;
			}
		}

        /*Alertas*/
		protected function sweet_alert($datos){
			if($datos['Alerta']=="simple"){
				$alerta = "<script>
							  swal(
								'".$datos['Titulo']."',
								'".$datos['Texto']."',
								'".$datos['Tipo']."'
							  );
						   </script>";
			}elseif ($datos['Alerta']=="recargar") {
				$alerta = "<script>
							  swal({
								title: '".$datos['Titulo']."',
								text: '".$datos['Texto']."',
								type: '".$datos['Tipo']."',
								confirmButtonText: 'Aceptar'
								}).then(function () {
									location = window.location;
								});
						   </script>";
			}elseif ($datos['Alerta']=="limpiar") {
				$alerta = "<script>
							  swal({
								title: '".$datos['Titulo']."',
								text: '".$datos['Texto']."',
								type: '".$datos['Tipo']."',
								confirmButtonText: 'Aceptar'
								}).then(function () {
									$('.FormularioAjax')[0].reset();
								});
						   </script>";
			}elseif ($datos['Alerta']=="redirigir") {
				$alerta = "<script>
							  swal({
								title: '".$datos['Titulo']."',
								text: '".$datos['Texto']."',
								type: '".$datos['Tipo']."',
								confirmButtonText: 'Aceptar'
								}).then(function () {
									window.location.href='".SERVERURL.$datos['Enlace']."';
								});
						   </script>";
			}
			return $alerta;
		}

		/*********************************/
		/***** Fin- FUNCIONES BASICAS ****/
		/*********************************/








		/*******************************/
		/*********** PRODUCTO **********/
		/*******************************/
		/*ACTUALIZAR STOCK PRODUCTO*/
		protected function actualizar_stock_producto_modelo($stock,$codigo,$precioCompra){
			$sql = mainModel::conectar()->prepare("UPDATE producto SET stockTotal=:stock, precioCompra=:precioCompra WHERE idProducto=:codigo");

			$sql->bindParam(":stock",$stock);
			$sql->bindParam(":precioCompra",$precioCompra);
			$sql->bindParam(":codigo",$codigo);
			$sql->execute();
			
			return $sql;
		}










		/*******************************/
		/*********** KARDEX ************/
		/*******************************/

		/*AGREGAR DETALLE KARDEX*/
		protected function agregar_kadexDetalle_modelo($datos){
			$sql=self::conectar()->prepare("INSERT INTO kardex_detalle(fecha, tipo, descripcion, unidades,precio,total,idKardex) 
			VALUES(:fecha, :tipo, :descripcion, :unidades, :precio, :total, :kardex)");

            $sql->bindParam(":fecha",$datos['fecha']);
            $sql->bindParam(":tipo",$datos['tipo']);
			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":unidades",$datos['unidades']);
			$sql->bindParam(":precio",$datos['precio']);
			$sql->bindParam(":total",$datos['total']);
			$sql->bindParam(":kardex",$datos['kardex']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR DETALLE KARDEX*/
		protected function eliminar_kardexDetalle_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM kardex_detalle WHERE idKardex=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*AGREGAR KARDEX*/
		protected function agregar_kardex_modelo($datos){
			$sql=self::conectar()->prepare("INSERT INTO kardex(uniEntrada, uniSalida, dinerEntrada, dinerSalida,invenInicial, invenActual,mesxyear,idProducto ) 
			VALUES(:uniEntrada, :uniSalida, :dinerEntrada, :dinerSalida, :invenInicial, :invenActual, :mesxyear,:idProducto)");

            $sql->bindParam(":uniEntrada",$datos['uniEntrada']);
            $sql->bindParam(":uniSalida",$datos['uniSalida']);
			$sql->bindParam(":dinerEntrada",$datos['dinerEntrada']);
			$sql->bindParam(":dinerSalida",$datos['dinerSalida']);
			$sql->bindParam(":invenInicial",$datos['invenInicial']);
			$sql->bindParam(":invenActual",$datos['invenActual']);
			$sql->bindParam(":mesxyear",$datos['mesxyear']);
			$sql->bindParam(":idProducto",$datos['idProducto']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR KARDEX*/
		protected function eliminar_kardex_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM kardex WHERE idProducto=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*ACTUALIZAR KARDEX SALIDA*/
		protected function actualizar_kardex_salida_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE kardex SET uniSalida=:uniSalida, dinerSalida=:dinerSalida, invenActual=:invenActual WHERE mesxyear=:codigo");

            $sql->bindParam(":uniSalida",$datos['uniSalida']);
            $sql->bindParam(":dinerSalida",$datos['dinerSalida']);
			$sql->bindParam(":invenActual",$datos['invenActual']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}

		/*ACTUALIZAR KARDEX ENTRADA*/
		protected function actualizar_kardex_entrada_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE kardex SET uniEntrada=:uniEntrada, dinerEntrada=:dinerEntrada, invenActual=:invenActual WHERE mesxyear=:codigo");

            $sql->bindParam(":uniEntrada",$datos['uniEntrada']);
            $sql->bindParam(":dinerEntrada",$datos['dinerEntrada']);
			$sql->bindParam(":invenActual",$datos['invenActual']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}









		/***************************************/
		/*********** DETALLE COMPRA ************/
		/***************************************/
		/*AGREGAR*/
		protected function agregar_detalle_compra_modelo($datos){
			$sql=self::conectar()->prepare("INSERT INTO compra_detalle(idCompra, idProducto, CodigoCompra, cantidad,precio,subTotal) 
			VALUES(:idCompra, :idProducto, :CodigoCompra, :cantidad, :precio, :subTotal)");

            $sql->bindParam(":idCompra",$datos['idCompra']);
            $sql->bindParam(":idProducto",$datos['idProducto']);
			$sql->bindParam(":CodigoCompra",$datos['CodigoCompra']);
			$sql->bindParam(":cantidad",$datos['cantidad']);
			$sql->bindParam(":precio",$datos['precio']);
			$sql->bindParam(":subTotal",$datos['subTotal']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_detalle_compra_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM compra_detalle WHERE idCompra=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}






		
		/******************************************/
		/************ ACTUALIZAR CAJA *************/
		/******************************************/
		protected function actualizar_efectivo_caja_modelo($efectivo,$caja){
			$sql=self::conectar()->prepare("UPDATE caja SET efectivo=:efectivo WHERE idCaja=:caja");

            $sql->bindParam(":efectivo",$efectivo);
			$sql->bindParam(":caja",$caja);
			$sql->execute();

			return $sql;
		}
		

	}