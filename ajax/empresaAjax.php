<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['empresa_id_up'])){
		
		require_once "../controllers/empresaControlador.php";
		$insempresa = new empresaControlador();


		/*ACTUALIZAR GENERAL*/
		if(isset($_POST['empresa_id_up']) && isset($_POST['empresa_nombre_up'])){
			echo $insempresa->actualizar_empresa_controlador();
		}
		
	}else{
		session_start(['name'=>'PERNOS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}