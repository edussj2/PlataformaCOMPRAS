<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['cargo_nombre_reg']) || isset($_POST['cargo_id_del']) || isset($_POST['cargo_id_up'])){
		
		require_once "../controllers/cargoControlador.php";
		$insCargo = new cargoControlador();

		/*AGREGAR*/
		if(isset($_POST['cargo_nombre_reg']) && isset($_POST['cargo_estado_reg'])){
			echo $insCargo->agregar_cargo_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['cargo_id_del'])){
			echo $insCargo->eliminar_cargo_controlador();
		}

		/*ACTUALIZAR GENERAL*/
		if(isset($_POST['cargo_id_up']) && isset($_POST['cargo_nombre_up'])){
			echo $insCargo->actualizar_cargo_controlador();
		}
		
	}else{
		session_start(['name'=>'PERNOS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}