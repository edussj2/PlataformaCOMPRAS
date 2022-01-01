<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class presentacionModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_presentacion_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO presentacion(descripcion, vigencia) 
			VALUES(:descripcion,:vigencia)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_presentacion_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM presentacion WHERE idPresentacion=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_presentacion_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM presentacion WHERE idPresentacion = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idPresentacion FROM presentacion");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idPresentacion, descripcion FROM presentacion WHERE vigencia='Habilitada' ORDER BY descripcion ASC"); 
				$sql->execute();
			}

			return $sql;
		}

		/*ACTUALIZAR DATOS*/
		protected function actualizar_presentacion_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE presentacion SET descripcion=:descripcion, vigencia=:vigencia WHERE idPresentacion=:codigo");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}