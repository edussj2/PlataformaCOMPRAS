<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['documento_nombre_reg']) || isset($_POST['documento_id_del']) || isset($_POST['documento_id_up'])){
		
		require_once "../controllers/documentoControlador.php";
		$insDocumento = new documentoControlador();

		/*AGREGAR*/
		if(isset($_POST['documento_nombre_reg']) && isset($_POST['documento_estado_reg'])){
			echo $insDocumento->agregar_documento_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['documento_id_del'])){
			echo $insDocumento->eliminar_documento_controlador();
		}

		/*ACTUALIZAR GENERAL*/
		if(isset($_POST['documento_id_up']) && isset($_POST['documento_nombre_up'])){
			echo $insDocumento->actualizar_documento_controlador();
		}
		
	}else{
		session_start(['name'=>'PERNOS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}