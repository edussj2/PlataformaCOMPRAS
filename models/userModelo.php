<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class userModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_user_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO usuario(numDocumento,nombres,apellidos,telefono, genero,usuario, clave, email, vigencia, avatar, idDocumento, idTrabajador) 
			VALUES(:numDocumento,:nombres,:apellidos,:telefono, :genero, :usuario, :clave, :email, :vigencia, :avatar, :documento, :cargo)");

			$sql->bindParam(":numDocumento",$datos['numDocumento']);
			$sql->bindParam(":nombres",$datos['nombres']);
			$sql->bindParam(":apellidos",$datos['apellidos']);
			$sql->bindParam(":telefono",$datos['telefono']);
			$sql->bindParam(":genero",$datos['genero']);
			$sql->bindParam(":usuario",$datos['usuario']);
			$sql->bindParam(":clave",$datos['clave']);
			$sql->bindParam(":email",$datos['email']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":avatar",$datos['avatar']);
			$sql->bindParam(":documento",$datos['documento']);
			$sql->bindParam(":cargo",$datos['cargo']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_user_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM usuario WHERE idUsuario=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_user_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM usuario WHERE idUsuario = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idUsuario FROM usuario WHERE idUsuario!='1'");
				$sql->execute();
			}elseif($tipo=="Logistica"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM usuario WHERE idTrabajador!='4' AND idTrabajador!='2'");
				$sql->execute();
			}
			return $sql;
		}

		/*ACTUALIZAR DATOS*/
		protected function actualizar_user_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE usuario SET numDocumento=:numDocumento, nombres=:nombres, apellidos=:apellidos, telefono = :telefono, genero=:genero, usuario = :usuario,clave = :clave, vigencia = :vigencia, email=:email, avatar=:avatar, idDocumento=:documento, idTrabajador=:cargo WHERE idUsuario=:codigo");

			$sql->bindParam(":numDocumento",$datos['numDocumento']);
			$sql->bindParam(":nombres",$datos['nombres']);
			$sql->bindParam(":apellidos",$datos['apellidos']);
			$sql->bindParam(":telefono",$datos['telefono']);
			$sql->bindParam(":genero",$datos['genero']);
			$sql->bindParam(":usuario",$datos['usuario']);
			$sql->bindParam(":clave",$datos['clave']);
			$sql->bindParam(":email",$datos['email']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":avatar",$datos['avatar']);
			$sql->bindParam(":documento",$datos['documento']);
			$sql->bindParam(":cargo",$datos['cargo']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}

		/*ACTUALIZAR 2 DATOS*/
		protected function actualizar2_user_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE usuario SET nombres=:nombres, apellidos=:apellidos, telefono = :telefono, genero=:genero, usuario = :usuario, email=:email, avatar=:avatar WHERE idUsuario=:codigo");

			$sql->bindParam(":nombres",$datos['nombres']);
			$sql->bindParam(":apellidos",$datos['apellidos']);
			$sql->bindParam(":telefono",$datos['telefono']);
			$sql->bindParam(":genero",$datos['genero']);
			$sql->bindParam(":usuario",$datos['usuario']);
			$sql->bindParam(":email",$datos['email']);
			$sql->bindParam(":avatar",$datos['avatar']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}

        /*ACTUALIZAR CONTRASEÑA*/
		protected function actualizar_clave_user_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE usuario SET clave=:clave WHERE idUsuario=:codigo");

			$sql->bindParam(":clave",$datos['clave']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}