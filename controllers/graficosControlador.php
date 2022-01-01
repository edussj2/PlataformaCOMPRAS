<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class graficosControlador extends mainModel
	{
		/*DATOS NOMBRE DE LOS PORUDUCTOS 5 */
        public function datos_graficos_producto1_mayor_stock_controlador(){

            $arreglo = array();
            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT nombre FROM producto ORDER BY stockTotal DESC LIMIT 5");

            while($row = $consulta1->fetch()){
                $arreglo[]=$row['nombre'];
            }
        
            return $arreglo;
        }

        /*DATOS NUMERO DE LOS PRODUCTOS */
        public function datos_graficos_producto2_mayor_stock_controlador(){

            $arreglo = array();
            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT stockTotal FROM producto ORDER BY stockTotal DESC LIMIT 5");

            while($row = $consulta1->fetch()){
                $arreglo[]=$row['stockTotal'];
            }
        
            return $arreglo;
        }

        /*NUMERO DE TRABAJADORES POR CARGO CARGOS */
        public function datos_graficos_trabajadores_controlador(){

            $arreglo = array();
            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT idUsuario FROM usuario WHERE idTrabajador=1");
            $numeroAdmins = $consulta1->rowCount();

            $consulta2 = mainModel::ejecutar_consulta_simple("SELECT idUsuario FROM usuario WHERE idTrabajador=2");
            $numeroAlmacen = $consulta2->rowCount();

            $consulta3 = mainModel::ejecutar_consulta_simple("SELECT idUsuario FROM usuario WHERE idTrabajador=3");
            $numerologistica = $consulta3->rowCount();

            $consulta4 = mainModel::ejecutar_consulta_simple("SELECT idUsuario FROM usuario WHERE idTrabajador=4");
            $numeroventas = $consulta4->rowCount();

            $arreglo = [$numeroAdmins,$numeroAlmacen,$numerologistica,$numeroventas];
        
            return $arreglo;
        }

	}