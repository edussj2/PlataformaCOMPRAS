<?php
	session_start(['name'=>'PERNOS']);
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST)){

		/*MOUDLO DOCUMENTOS*/
		if(isset($_POST['busqueda_documentos'])){
			$_SESSION['busqueda_documentos']= $_POST['busqueda_documentos'];
		}

		if(isset($_POST['eliminar_busqueda_documentos'])){
			unset($_SESSION['busqueda_documentos']);
			$url = "documentSearch";
		}

		/*MODULO CARGOS*/
		if(isset($_POST['busqueda_cargo'])){
			$_SESSION['busqueda_cargo']= $_POST['busqueda_cargo'];
		}

		if(isset($_POST['eliminar_busqueda_cargo'])){
			unset($_SESSION['busqueda_cargo']);
			$url = "positionSearch";
		}

		/*MODULO TRABAJADORES*/
		if(isset($_POST['busqueda_user'])){
			$_SESSION['busqueda_user']= $_POST['busqueda_user'];
		}

		if(isset($_POST['eliminar_busqueda_user'])){
			unset($_SESSION['busqueda_user']);
			$url = "userSearch";
		}

		/*MODULO CAJAS*/
		if(isset($_POST['busqueda_caja'])){
			$_SESSION['busqueda_caja']= $_POST['busqueda_caja'];
		}

		if(isset($_POST['eliminar_busqueda_caja'])){
			unset($_SESSION['busqueda_caja']);
			$url = "cashierSearch";
		}

		/*MODULO PROVEEDORES*/
		if(isset($_POST['busqueda_proveedor'])){
			$_SESSION['busqueda_proveedor']= $_POST['busqueda_proveedor'];
		}

		if(isset($_POST['eliminar_busqueda_proveedor'])){
			unset($_SESSION['busqueda_proveedor']);
			$url = "providerSearch";
		}

		/*MODULO FORMA DE PAGO*/
		if(isset($_POST['busqueda_formaPago'])){
			$_SESSION['busqueda_formaPago']= $_POST['busqueda_formaPago'];
		}

		if(isset($_POST['eliminar_busqueda_formaPago'])){
			unset($_SESSION['busqueda_formaPago']);
			$url = "wayPaySearch";
		}

		/*MODULO PRESENTACION*/
		if(isset($_POST['busqueda_presentacion'])){
			$_SESSION['busqueda_presentacion']= $_POST['busqueda_presentacion'];
		}

		if(isset($_POST['eliminar_busqueda_presentacion'])){
			unset($_SESSION['busqueda_presentacion']);
			$url = "presentationSearch";
		}

		/*MODULO CATEGORIA*/
		if(isset($_POST['busqueda_categoria'])){
			$_SESSION['busqueda_categoria']= $_POST['busqueda_categoria'];
		}

		if(isset($_POST['eliminar_busqueda_categoria'])){
			unset($_SESSION['busqueda_categoria']);
			$url = "categorySearch";
		}

		/*MODULO PRODUCTO*/
		if(isset($_POST['busqueda_producto'])){
			$_SESSION['busqueda_producto']= $_POST['busqueda_producto'];
		}

		if(isset($_POST['eliminar_busqueda_producto'])){
			unset($_SESSION['busqueda_producto']);
			$url = "productSearch";
		}

		/*MODULO KARDEX*/
		if(isset($_POST['busqueda_kardex'])){
			$_SESSION['busqueda_kardex']= $_POST['busqueda_kardex'];
		}

		if(isset($_POST['eliminar_busqueda_kardex'])){
			unset($_SESSION['busqueda_kardex']);
			$url = "kardexSearch";
		}

		/*MODULO COMPRA*/
		if(isset($_POST['busqueda_compra'])){
			$_SESSION['busqueda_compra']= $_POST['busqueda_compra'];
		}

		if(isset($_POST['eliminar_busqueda_compra'])){
			unset($_SESSION['busqueda_compra']);
			$url = "shopSearch";
		}

		/*MODULO PARA REDICIONAR*/
		if(isset($url)){
			echo '<script> window.location.href="'.SERVERURL.$url.'/"</script>';
		}else{
			echo '<script> location.reload();</script>';
		}

	}else{
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}