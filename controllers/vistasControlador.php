<?php
	require_once "./models/vistasModelo.php";

	class vistasControlador extends vistasModelo
	{
		/********* CONTROLADOR OBTENER PLANTILLA***********/
		public function obtener_template_controlador(){
			return require_once "./views/template.php";
		}

		/********* CONTROLADOR OBTENER VISTAS***********/
		public function obtener_vistas_controlador(){
			if(isset($_GET['views'])){
				$ruta = explode("/", $_GET['views']);
				$respuesta = vistasModelo::obtener_vistas_modelo($ruta[0]);
			}else{
				$respuesta = "login";
			}
			return $respuesta;
		}
	}