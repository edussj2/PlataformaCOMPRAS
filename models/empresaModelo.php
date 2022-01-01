<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class empresaModelo extends mainModel
	{
		/*DATOS*/
		protected function datos_empresa_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM empresa WHERE idEmpresa = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idEmpresa FROM empresa");
				$sql->execute();
			}

			return $sql;
		}

		/*ACTUALIZAR DATOS*/
		protected function actualizar_empresa_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE empresa SET razSocial=:razSocial, ruc=:ruc, nomComercial=:nomComercial, direccion=:direccion, telefono = :telefono, email=:email WHERE idEmpresa=:codigo");

            $sql->bindParam(":razSocial",$datos['razSocial']);
            $sql->bindParam(":ruc",$datos['ruc']);
			$sql->bindParam(":direccion",$datos['direccion']);
			$sql->bindParam(":nomComercial",$datos['nomComercial']);
			$sql->bindParam(":telefono",$datos['telefono']);
			$sql->bindParam(":email",$datos['email']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}