<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['caja_nombre_reg']) || isset($_POST['caja_id_del']) || isset($_POST['caja_id_up'])){
		
		require_once "../controllers/cajaControlador.php";
		$inscaja = new cajaControlador();

		/*AGREGAR*/
		if(isset($_POST['caja_nombre_reg']) && isset($_POST['caja_estado_reg'])){
			echo $inscaja->agregar_caja_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['caja_id_del'])){
			echo $inscaja->eliminar_caja_controlador();
		}

		/*ACTUALIZAR GENERAL*/
		if(isset($_POST['caja_id_up']) && isset($_POST['caja_nombre_up'])){
			echo $inscaja->actualizar_caja_controlador();
		}
		
	}else{
		session_start(['name'=>'PERNOS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}