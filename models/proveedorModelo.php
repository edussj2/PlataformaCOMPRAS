<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class proveedorModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_proveedor_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO proveedor(numDocumento, razSocial, direccion, vigencia, contNombres, contTelefono, contEmail, contPuesto, cuenta, idDocumento) 
			VALUES(:numDocumento, :razSocial, :direccion, :vigencia, :contNombres, :contTelefono, :contEmail,:contPuesto,:cuenta, :documento)");

            $sql->bindParam(":numDocumento",$datos['numDocumento']);
            $sql->bindParam(":razSocial",$datos['razSocial']);
            $sql->bindParam(":direccion",$datos['direccion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":contNombres",$datos['contNombres']);
			$sql->bindParam(":contTelefono",$datos['contTelefono']);
			$sql->bindParam(":contEmail",$datos['contEmail']);
			$sql->bindParam(":contPuesto",$datos['contPuesto']);
			$sql->bindParam(":cuenta",$datos['cuenta']);
			$sql->bindParam(":documento",$datos['documento']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_proveedor_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM proveedor WHERE idProveedor=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_proveedor_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM proveedor WHERE idProveedor = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idProveedor FROM proveedor");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idProveedor, razSocial FROM proveedor WHERE vigencia='Habilitada' ORDER BY razSocial ASC"); 
				$sql->execute();
			}

			return $sql;
		}

		/*ACTUALIZAR*/
		protected function actualizar_proveedor_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE proveedor SET numDocumento=:numDocumento, razSocial=:razSocial, direccion=:direccion, vigencia=:vigencia, contNombres=:contNombres, contTelefono=:contTelefono, contEmail=:contEmail, contPuesto=:contPuesto,cuenta=:cuenta , idDocumento=:documento WHERE idProveedor=:codigo");

            $sql->bindParam(":numDocumento",$datos['numDocumento']);
            $sql->bindParam(":razSocial",$datos['razSocial']);
            $sql->bindParam(":direccion",$datos['direccion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":contNombres",$datos['contNombres']);
			$sql->bindParam(":contTelefono",$datos['contTelefono']);
			$sql->bindParam(":contEmail",$datos['contEmail']);
			$sql->bindParam(":contPuesto",$datos['contPuesto']);
			$sql->bindParam(":documento",$datos['documento']);
			$sql->bindParam(":cuenta",$datos['cuenta']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}