<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class cajaModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_caja_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO caja(numero, descripcion, vigencia, efectivo) 
			VALUES(:numero, :descripcion, :vigencia, :efectivo)");

            $sql->bindParam(":numero",$datos['numero']);
            $sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":efectivo",$datos['efectivo']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_caja_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM caja WHERE idCaja=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_caja_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM caja WHERE idCaja = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idCaja FROM caja");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idCaja, descripcion FROM caja WHERE vigencia='Habilitada' ORDER BY descripcion ASC"); 
				$sql->execute();
			}

			return $sql;
		}

		/*ACTUALIZAR DATOS*/
		protected function actualizar_caja_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE caja SET numero=:numero, descripcion=:descripcion, vigencia=:vigencia, efectivo=:efectivo WHERE idCaja=:codigo");

            $sql->bindParam(":numero",$datos['numero']);
            $sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":efectivo",$datos['efectivo']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}