<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class documentoModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_documento_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO tipo_documento(descripcion, vigencia) 
			VALUES(:descripcion,:vigencia)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_documento_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM tipo_documento WHERE idDocumento=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_documento_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM tipo_documento WHERE idDocumento = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idDocumento FROM tipo_documento");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idDocumento, descripcion FROM tipo_documento WHERE vigencia='Habilitada' ORDER BY descripcion ASC"); 
				$sql->execute();
			}

			return $sql;
		}

		/*ACTUALIZAR DATOS*/
		protected function actualizar_documento_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE tipo_documento SET descripcion=:descripcion, vigencia=:vigencia WHERE idDocumento=:codigo");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}