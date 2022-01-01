    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="far fa-credit-card"></i> &nbsp; Tipo de Pagos</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo TIPO DE PAGOS usted podrá registrar los Tipo de Pagos que se registren las ventas. Además de lo antes mencionado, puede actualizar los datos de los cargos, realizar búsquedas de cargos o eliminarlas si así lo desea.</p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>wayPayNew/" class="text-gray-700 h5 text-uppercase"><i class="far fa-credit-card"></i> &nbsp; NUEVO</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>wayPayList/" class="text-gray-700 h5 text-uppercase activo"><i class="fas fa-list"></i> &nbsp; Lista</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>wayPaySearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar</a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Instancia al controlador -->
    <?php 
		require_once "./controllers/formaPagoControlador.php";
		$insformaPago = new formaPagoControlador();
	?>
    <!-- Instancia al controlador -->


    <!-- Lista formaPagos -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $insformaPago->paginador_formaPago_controlador($pagina[1],10,"");
		?>
    </div>
    <!-- Lista formapago -->
