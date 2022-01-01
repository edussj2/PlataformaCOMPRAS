<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['presentacion_nombre_reg']) || isset($_POST['presentacion_id_del']) || isset($_POST['presentacion_id_up'])){
		
		require_once "../controllers/presentacionControlador.php";
		$inspresentacion = new presentacionControlador();

		/*AGREGAR*/
		if(isset($_POST['presentacion_nombre_reg']) && isset($_POST['presentacion_estado_reg'])){
			echo $inspresentacion->agregar_presentacion_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['presentacion_id_del'])){
			echo $inspresentacion->eliminar_presentacion_controlador();
		}

		/*ACTUALIZAR GENERAL*/
		if(isset($_POST['presentacion_id_up']) && isset($_POST['presentacion_nombre_up'])){
			echo $inspresentacion->actualizar_presentacion_controlador();
		}
		
	}else{
		session_start(['name'=>'PERNOS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}