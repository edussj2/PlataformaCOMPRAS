<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['compra_proveedor_reg'])){
		
		require_once "../controllers/compraControlador.php";
		$inscompra = new compraControlador();

		/*AGREGAR*/
		if(isset($_POST['compra_proveedor_reg']) && isset($_POST['compra_fecha_reg'])){
			echo $inscompra->agregar_compra_controlador();
		}
		
	}else{
		session_start(['name'=>'PERNOS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}