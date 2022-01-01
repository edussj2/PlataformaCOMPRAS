<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['usuario_numero_documento_reg']) || isset($_POST['usuario_id_del']) || isset($_POST['usuario_id_up']) || isset($_POST['usuario_id_new']) || isset($_POST['usuario_id_up2'])){
		
		require_once "../controllers/userControlador.php";
		$insUsuario = new userControlador();

		/*AGREGAR*/
		if(isset($_POST['usuario_numero_documento_reg']) && isset($_POST['usuario_nombre_reg']) && isset($_POST['usuario_usuario_reg']) && isset($_POST['usuario_clave_1_reg'])){
			echo $insUsuario->agregar_user_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['usuario_id_del'])){
			echo $insUsuario->eliminar_user_controlador();
		}

		/*ACTUALIZAR*/
		if(isset($_POST['usuario_id_up']) && isset($_POST['usuario_numero_documento_up'])){
			echo $insUsuario->actualizar_user_controlador();
		}

		/*ACTUALIZAR 2*/
		if(isset($_POST['usuario_id_up2']) && isset($_POST['usuario_nombre_up2'])){
			echo $insUsuario->actualizar2_user_controlador();
		}

		/*ACTUALIZAR PASS*/
		if(isset($_POST['usuario_id_new']) && isset($_POST['usuario_usuario_new']) && isset($_POST['usuario_clave_new'])){
			echo $insUsuario->actualizar_clave_user_controlador();
		}
		
	}else{
		session_start(['name'=>'PERNOS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}