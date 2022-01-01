    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>   
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-cash-register"></i> &nbsp; Cajas</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo CAJAS usted podrá registrar cajas de ventas en el sistema para poder realizar ventas, además podrá actualizar los datos de las cajas de venta, realizar búsquedas de cajas o eliminarlas si lo desea.</p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>cashierNew/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-cash-register"></i> &nbsp; Nuevo
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>cashierList/" class="text-gray-700 h5 text-uppercase activo"><i class="fas fa-list"></i> &nbsp; Lista
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>cashierSearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar
            </a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Instancia al controlador -->
    <?php 
		require_once "./controllers/cajaControlador.php";
		$inscaja = new cajaControlador();
	?>
    <!-- Instancia al controlador -->

    <!-- Lista Cajas -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $inscaja->paginador_caja_controlador($pagina[1],10,"");
		?>
    </div>
