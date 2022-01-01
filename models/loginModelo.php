<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class loginModelo extends mainModel
	{

		/**-----FUNCION PARA INICIAR SESIÓN-----**/
		protected function iniciar_sesion_modelo($datos){
			$sql = mainModel::conectar()->prepare("SELECT * FROM usuario WHERE usuario = :usuario AND clave = :clave AND vigencia = 'Habilitada'");

			$sql->bindParam(":usuario",$datos['usuario']);
			$sql->bindParam(":clave",$datos['clave']);
			$sql->execute();

			return $sql;
		}

		/**-----FUNCION PARA CERRAR SESIÓN-----**/
		protected function cerrar_sesion_modelo($datos){
			if ($datos['usuario']!="" && $datos['token_S']==$datos['token']) {

				session_unset();
				session_destroy();
				$respuesta = "true";
	
			}else{
				$respuesta = "false";
			}

			return $respuesta;
		}
	}