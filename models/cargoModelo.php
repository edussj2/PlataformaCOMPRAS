<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class cargoModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_cargo_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO tipo_trabajador(descripcion, vigencia) 
			VALUES(:descripcion,:vigencia)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_cargo_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM tipo_trabajador WHERE idTrabajador=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_cargo_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM tipo_trabajador WHERE idTrabajador = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idTrabajador FROM tipo_trabajador");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idTrabajador, descripcion FROM tipo_trabajador WHERE vigencia='Habilitada' ORDER BY descripcion ASC"); 
				$sql->execute();
			}

			return $sql;
		}

		/*ACTUALIZAR DATOS*/
		protected function actualizar_cargo_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE tipo_trabajador SET descripcion=:descripcion, vigencia=:vigencia WHERE idTrabajador=:codigo");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}