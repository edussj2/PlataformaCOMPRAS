<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class formaPagoModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_formaPago_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO tipo_pago(descripcion, vigencia, icono) 
			VALUES(:descripcion, :vigencia, :icono)");

            $sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":icono",$datos['icono']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_formaPago_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM tipo_pago WHERE idTipoPago=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_formaPago_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM tipo_pago WHERE idTipoPago = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idTipoPago FROM tipo_pago");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idTipoPago, descripcion FROM tipo_pago WHERE vigencia='Habilitada' ORDER BY descripcion ASC"); 
				$sql->execute();
			}

			return $sql;
		}

		/*ACTUALIZAR DATOS*/
		protected function actualizar_formaPago_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE tipo_pago SET descripcion=:descripcion, vigencia=:vigencia, icono=:icono WHERE idTipoPago=:codigo");

            $sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":icono",$datos['icono']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}