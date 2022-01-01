<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class productoModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_producto_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO producto(codigo, nombre, stockTotal, stockMinimo, precioCompra, precioVenta, modelo, estado, imagen, diametro, longitud, idPresentacion, idCategoria, identificador) 
			VALUES(:codigo, :nombre, :stockTotal, :stockMinimo, :precioCompra, :precioVenta, :modelo, :estado, :imagen, :diametro, :longitud, :idPresentacion, :idCategoria, :identificador)");

            $sql->bindParam(":codigo",$datos['codigo']);
            $sql->bindParam(":nombre",$datos['nombre']);
			$sql->bindParam(":stockMinimo",$datos['stockMinimo']);
			$sql->bindParam(":stockTotal",$datos['stockTotal']);
			$sql->bindParam(":precioCompra",$datos['precioCompra']);
			$sql->bindParam(":precioVenta",$datos['precioVenta']);
			$sql->bindParam(":modelo",$datos['modelo']);
			$sql->bindParam(":estado",$datos['estado']);
			$sql->bindParam(":imagen",$datos['imagen']);
			$sql->bindParam(":diametro",$datos['diametro']);
			$sql->bindParam(":longitud",$datos['longitud']);
			$sql->bindParam(":idPresentacion",$datos['idPresentacion']);
			$sql->bindParam(":idCategoria",$datos['idCategoria']);
			$sql->bindParam(":identificador",$datos['identificador']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_producto_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM producto WHERE idProducto=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_producto_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM producto  WHERE idProducto = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idProducto FROM producto");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idProducto, nombre FROM producto WHERE estado='Habilitada' ORDER BY nombre ASC"); 
				$sql->execute();
			}elseif($tipo=="Especial"){
				$sql = mainModel::conectar()->prepare("SELECT idProducto FROM producto WHERE idCategoria = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}

			return $sql;
		}

		/*ACTUALIZAR DATOS*/
		protected function actualizar_producto_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE producto SET codigo=:codigo, nombre=:nombre, stockMinimo=:stockMinimo, stockTotal=:stockTotal, precioCompra=:precioCompra, precioVenta=:precioVenta, modelo=:modelo, estado=:estado, diametro=:diametro, longitud=:longitud, idPresentacion=:idPresentacion,idCategoria=:idCategoria WHERE idProducto=:id");

            $sql->bindParam(":codigo",$datos['codigo']);
            $sql->bindParam(":nombre",$datos['nombre']);
			$sql->bindParam(":stockMinimo",$datos['stockMinimo']);
			$sql->bindParam(":stockTotal",$datos['stockTotal']);
			$sql->bindParam(":precioCompra",$datos['precioCompra']);
			$sql->bindParam(":precioVenta",$datos['precioVenta']);
			$sql->bindParam(":modelo",$datos['modelo']);
			$sql->bindParam(":estado",$datos['estado']);
			$sql->bindParam(":diametro",$datos['diametro']);
			$sql->bindParam(":longitud",$datos['longitud']);
			$sql->bindParam(":idPresentacion",$datos['idPresentacion']);
			$sql->bindParam(":idCategoria",$datos['idCategoria']);
			$sql->bindParam(":id",$datos['id']);
			$sql->execute();
			
			return $sql;
		}

		/*ACTUALIZAR IMAGEN*/
		protected function actualizar_imagen_producto_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE producto SET imagen=:imagen WHERE idProducto=:codigo");

			$sql->bindParam(":codigo",$datos['codigo']);
            $sql->bindParam(":imagen",$datos['imagen']);
			$sql->execute();
			
			return $sql;
		}
	}