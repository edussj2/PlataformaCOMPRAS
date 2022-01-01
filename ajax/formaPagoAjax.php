<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['forma_pago_nombre_reg']) || isset($_POST['forma_pago_id_del']) || isset($_POST['forma_pago_id_up'])){
		
		require_once "../controllers/formaPagoControlador.php";
		$insforma_pago = new formaPagoControlador();

		/*AGREGAR*/
		if(isset($_POST['forma_pago_nombre_reg']) && isset($_POST['forma_pago_estado_reg'])){
			echo $insforma_pago->agregar_formaPago_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['forma_pago_id_del'])){
			echo $insforma_pago->eliminar_formaPago_controlador();
		}

		/*ACTUALIZAR*/
		if(isset($_POST['forma_pago_id_up']) && isset($_POST['forma_pago_nombre_up'])){
			echo $insforma_pago->actualizar_formaPago_controlador();
		}
		
	}else{
		session_start(['name'=>'PERNOS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}