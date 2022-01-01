<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['compra_producto_detalle_reg']) || isset($_POST['detalle_id_del'])){
		
		require_once "../controllers/detalleTempControlador.php";
		$insdetalleTemp = new detalleTempControlador();

		/*AGREGAR*/
		if(isset($_POST['compra_producto_detalle_reg']) && isset($_POST['compra_cantidad_detalle_reg'])){
			echo $insdetalleTemp->agregar_detalleTemp_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['detalle_id_del'])){
			echo $insdetalleTemp->eliminar_detalleTemp_controlador();
		}
		
	}else{
		session_start(['name'=>'PERNOS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}