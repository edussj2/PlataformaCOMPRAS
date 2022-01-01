    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fab fa-product-hunt"></i> &nbsp; Presentaciones</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo PRESENTACIONES usted podrá registrar las Presentaciones que servirán para identificar a los productos que se registren. Además de lo antes mencionado, puede actualizar los datos de los Presentaciones, realizar búsquedas de Presentaciones o eliminarlas si así lo desea.</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>presentationNew/" class="text-gray-700 h5 text-uppercase"><i class="fab fa-product-hunt"></i> &nbsp; Nuevo
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>presentationList/" class="text-gray-700 activo h5 text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>presentationSearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar
            </a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Instancia al controlador -->
    <?php 
		require_once "./controllers/presentacionControlador.php";
		$inspresentacion = new presentacionControlador();
	?>
    <!-- Instancia al controlador -->

    <!-- Lista -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $inspresentacion->paginador_presentacion_controlador($pagina[1],10,"");
		?>
    </div>
    <!-- Lista -->