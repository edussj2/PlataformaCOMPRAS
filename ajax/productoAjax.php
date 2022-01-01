<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['producto_nombre_reg']) || isset($_POST['producto_id_del']) || isset($_POST['producto_id_up']) || isset($_POST['producto_img_id_del']) || isset($_POST['producto_img_id_up'])){
		
		require_once "../controllers/productoControlador.php";
		$insproducto = new productoControlador();

		/*AGREGAR*/
		if(isset($_POST['producto_nombre_reg']) && isset($_POST['producto_estado_reg'])){
			echo $insproducto->agregar_producto_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['producto_id_del'])){
			echo $insproducto->eliminar_producto_controlador();
		}

		/*ELMINAR IMAGEN*/
		if(isset($_POST['producto_img_id_del'])){
			echo $insproducto->eliminar_imagen_producto_controlador();
		}

		/*ACTUALIZAR IMAGEN*/
		if(isset($_POST['producto_img_id_up'])){
			echo $insproducto->actualizar_imagen_producto_controlador();
		}

		/*ACTUALIZAR GENERAL*/
		if(isset($_POST['producto_id_up']) && isset($_POST['producto_nombre_up'])){
			echo $insproducto->actualizar_producto_controlador();
		}
		
	}else{
		session_start(['name'=>'PERNOS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}