<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class kardexDetalleModelo extends mainModel
	{
		/*DATOS*/
		protected function datos_kardexDetalle_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM kardex_detalle WHERE idKardexDetalle = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idKardexDetalle FROM kardex_detalle");
				$sql->execute();
			}

			return $sql;
		}

	}