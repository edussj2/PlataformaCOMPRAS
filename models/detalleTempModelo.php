<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class detalleTempModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_detalleTemp_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO temp_detalle(cantidad, precio, subtotal, idProducto) 
			VALUES(:cantidad, :precio, :subtotal, :idProducto)");

			$sql->bindParam(":cantidad",$datos['cantidad']);
			$sql->bindParam(":precio",$datos['precio']);
			$sql->bindParam(":subtotal",$datos['subtotal']);
			$sql->bindParam(":idProducto",$datos['idProducto']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_detalleTemp_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM temp_detalle WHERE idTempDetalle =:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

        /*ELIMINAR TOTAL*/
        protected function eliminar_detalleTemp_total_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM temp_detalle");
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_detalleTemp_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM temp_detalle WHERE idTempDetalle = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idTempDetalle FROM temp_detalle");
				$sql->execute();
			}elseif($tipo=="Monto"){
				$sql = mainModel::conectar()->prepare("SELECT subtotal FROM temp_detalle");
				$sql->execute();
			}

			return $sql;
		}

		/*ACTUALIZAR DATOS*/
		protected function actualizar_detalleTemp_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE temp_detalle SET cantidad=:cantidad, precio=:precio, subtotal=:subtotal, idProducto = :idProducto WHERE idTempDetalle=:codigo");

			$sql->bindParam(":cantidad",$datos['cantidad']);
			$sql->bindParam(":precio",$datos['precio']);
			$sql->bindParam(":subtotal",$datos['subtotal']);
			$sql->bindParam(":idProducto",$datos['idProducto']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}