<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../models/empresaModelo.php";
	}else{
		require_once "./models/empresaModelo.php";
	}

	class empresaControlador extends empresaModelo
	{
        /*DATOS*/
        public function datos_empresa_controlador($tipo,$codigo){

            $codigo = mainModel::limpiar_cadena($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return empresaModelo::datos_empresa_modelo($tipo, $codigo);
        }

        /*ACTUALIZAR */
        public function actualizar_empresa_controlador(){ 

            $id = mainModel::decryption($_POST['empresa_id_up']);
			$ruc = mainModel::limpiar_cadena($_POST['empresa_numero_documento_up']);
			$razSocial = mainModel::limpiar_cadena($_POST['empresa_razSocial_up']);
			$direccion = mainModel::limpiar_cadena($_POST['empresa_direccion_up']);
			$nomComercial = mainModel::limpiar_cadena($_POST['empresa_nombre_up']);
			$telefono = mainModel::limpiar_cadena($_POST['empresa_telefono_up']);
			$email = mainModel::limpiar_cadena($_POST['empresa_email_up']);

            if($id == "" || $ruc == "" || $razSocial == "" || $direccion == "" || $telefono == "" || $email == "" || $nomComercial == ""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos correctamente","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            if(strlen( $razSocial ) > 60){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la razón social no es válida","Tipo"=>"warning"];   
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            if(strlen( $ruc ) > 15){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud del RUC no es válida","Tipo"=>"warning"];   
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            if(strlen( $nomComercial ) > 60){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud del nombre comercial no es válido","Tipo"=>"warning"];   
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El correo electrónico ingresado no es válido","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            if(is_numeric($telefono)==false || strlen($telefono) > 9){
                
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El teléfono no es válido (Solo números y 9 carácteres como máximo)","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            $Datosempresa= [    "razSocial"=>$razSocial,
                                "ruc"=>$ruc,
                                "direccion"=>$direccion,
                                "nomComercial"=>$nomComercial,
                                "telefono"=>$telefono,
                                "email"=>$email,
                                "codigo"=>$id ];

            if(empresaModelo::actualizar_empresa_modelo($Datosempresa)->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"EMPRESA ACTUALIZADO","Texto"=>"Los datos fueron actualizados con éxito","Tipo"=>"success"];

            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudieron actualizar los datos de la empresa, intenté nuevamente","Tipo"=>"error"];

            }
            return mainModel::sweet_alert($alerta);
        }
	}
    