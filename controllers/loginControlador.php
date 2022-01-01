<?php 
	if($peticionAjax){
		require_once "../models/loginModelo.php";
	}else{
		require_once "./models/loginModelo.php";
	}

	class loginControlador extends loginModelo
	{
		
		/**-----FUNCION PARA INICIAR SESIÓN-----**/
		public function iniciar_sesion_controlador(){

			$usuario = mainModel::limpiar_cadena($_POST['usuario']);
			$clave = mainModel::limpiar_cadena($_POST['clave']);

			$clave = mainModel::encryption($clave);

			$datosLogin = ["usuario"=> $usuario,"clave"=>$clave];

			$datosCuenta = loginModelo::iniciar_sesion_modelo($datosLogin);

			if($datosCuenta->rowCount()==1){

				session_start(['name'=>'PERNOS']);
				$row = $datosCuenta->fetch();

				$query = mainModel::ejecutar_consulta_simple("SELECT * FROM tipo_trabajador WHERE idTrabajador ='".$row['idTrabajador']."'");
				$cargoData= $query->fetch();


				$_SESSION['nombres_pernos'] = $row['nombres'];	
				$_SESSION['apellidos_pernos'] = $row['apellidos'];
				$_SESSION['avatar_pernos'] = $row['avatar'];
				$_SESSION['tipo_pernos'] = $cargoData['descripcion'];
				$_SESSION['usuario_pernos']=$row['usuario'];
				$_SESSION['id_pernos']=$row['idUsuario'];
				$_SESSION['token_pernos']=md5(uniqid(mt_rand(),true));

			
				$url = SERVERURL."home/";

				return $urlLocation='<script> window.location="'.$url.'"</script>';

			}else{
               $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Las credenciales no son válidas o su cuenta esta deshabilitada intente nuevamente.","Tipo"=>"error"];
               return mainModel::sweet_alert($alerta);
			}
		}

		/**-----FUNCION PARA CERRAR SESIÓN-----**/
		public function cerrar_sesion_controlador(){
			session_start(['name'=>'PERNOS']);
			$token = mainModel::decryption($_GET['Token']);
			$datos=["usuario"=>$_SESSION['usuario_pernos'], "token_S"=>$_SESSION['token_pernos'],"token"=>$token];

			return loginModelo::cerrar_sesion_modelo($datos);
		}

		/**-----FUNCION PARA FORZAR CIERRE DE SESIÓN-----**/
		public function forzar_cierre_sesion_controlador(){
			session_unset();
			session_destroy();
			$redirect = '<script> window.location.href="'.SERVERURL.'login/"</script>';
			return $redirect;
		}

	}