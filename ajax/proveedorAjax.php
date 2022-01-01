<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['proveedor_numero_documento_reg']) || isset($_POST['proveedor_id_del']) || isset($_POST['proveedor_id_up'])){
		
		require_once "../controllers/proveedorControlador.php";
		$insproveedor = new proveedorControlador();

		/*AGREGAR*/
		if(isset($_POST['proveedor_numero_documento_reg']) && isset($_POST['proveedor_nombre_reg'])){
			echo $insproveedor->agregar_proveedor_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['proveedor_id_del'])){
			echo $insproveedor->eliminar_proveedor_controlador();
		}

		/*ACTUALIZAR GENERAL*/
		if(isset($_POST['proveedor_id_up']) && isset($_POST['proveedor_nombre_up'])){
			echo $insproveedor->actualizar_proveedor_controlador();
		}
		
	}else{
		session_start(['name'=>'PERNOS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}