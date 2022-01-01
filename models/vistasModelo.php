<?php
	class vistasModelo  
	{
		/********* MODELO OBTENER VISTAS ***********/
		protected static function obtener_vistas_modelo($vistas){
			$listaBlanca = ["home","userNew","userList","userEdit","userSearch","documentNew","documentList","documentSearch","documentEdit","positionNew","positionList","positionSearch","positionEdit","cashierList","cashierNew","cashierSearch","cashierEdit","providerNew","providerList","providerSearch","providerEdit","wayPayNew","wayPayList","wayPaySearch","wayPayEdit","presentationNew","presentationList","presentationSearch","presentationEdit","categoryNew","categoryList","categorySearch","categoryEdit","company","myData","myAccount","clientNew","productNew","productList","productSearch","productCategory","productDetails","productImg","productEdit","kardexDetails","kardexDetails2","kardex","kardexSearch","shopNew","shopList","shopSearch","shopDetails","reports"];

			if (in_array($vistas, $listaBlanca)) {
				if(is_file("./views/content/".$vistas."-view.php")){
					$contenido = "./views/content/".$vistas."-view.php";
				}else{
                    $contenido="404";
				}
			}elseif($vistas=="login" || $vistas=="index"){
				$contenido="login";
			}else{
				$contenido="404";
			}
			return $contenido;
		}
	}