<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class compraModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_compra_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO compra(CodigoCompra, fecha, montoTotal, subtotal, estado, idProveedor, idCaja, idUsuario,idEmpresa,idPago) 
			VALUES(:codigo, :fecha, :montoTotal, :subtotal, :estado, :idProveedor, :idCaja, :idUsuario, :idEmpresa,:idPago)");

            $sql->bindParam(":codigo",$datos['codigo']);
            $sql->bindParam(":fecha",$datos['fecha']);
			$sql->bindParam(":subtotal",$datos['subtotal']);
			$sql->bindParam(":montoTotal",$datos['montoTotal']);
			$sql->bindParam(":estado",$datos['estado']);
			$sql->bindParam(":idProveedor",$datos['idProveedor']);
			$sql->bindParam(":idCaja",$datos['idCaja']);
			$sql->bindParam(":idUsuario",$datos['idUsuario']);
			$sql->bindParam(":idEmpresa",$datos['idEmpresa']);
			$sql->bindParam(":idPago",$datos['idPago']);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_compra_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM compra INNER JOIN proveedor ON compra.idProveedor = proveedor.idProveedor INNER JOIN usuario ON compra.idUsuario = usuario.idUsuario WHERE idCompra = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idCompra FROM compra");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idCompra, fecha FROM compra WHERE estado='Normal' ORDER BY fecha ASC"); 
				$sql->execute();
			}

			return $sql;
		}

        /*ANULAR*/
		protected function anular_compra_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE compra SET estado=:estado WHERE idCompra=:codigo");

			$sql->bindParam(":estado",$datos['estado']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_compra_modelo($codigo){
			$sql = mainModel::conectar()->prepare("DELETE FROM compra WHERE idCompra=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();
			
			return $sql;
		}
	}