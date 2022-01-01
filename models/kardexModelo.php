<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class kardexModelo extends mainModel
	{

		/*DATOS*/
		protected function datos_kardex_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM kardex INNER JOIN producto ON kardex.idProducto = producto.idProducto WHERE kardex.idKardex = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idKardex FROM kardex");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idKardex, descripcion FROM kardex ORDER BY idKardex ASC"); 
				$sql->execute();
			}

			return $sql;
		}

	}