    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-truck-moving"></i> &nbsp; Proveedores
        </h1>
        <p class="text-gray-700 mb-4 text-justify">
            En el módulo PROVEEDORES usted podrá registrar los proveedores de productos a los cuales usted les compra productos o mercancía. Además, podrá actualizar los datos de los proveedores, ver todos los proveedores registrados en el sistema, buscar proveedores en el sistema o eliminarlos si así lo desea.
        </p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>providerNew/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-truck-moving"></i> &nbsp; Nuevo</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>providerList/" class="text-gray-700 h5 activo text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>providerSearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar</a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Instancia al controlador -->
    <?php 
		require_once "./controllers/proveedorControlador.php";
		$insproveedor = new proveedorControlador();
	?>
    <!-- Instancia al controlador -->


    <!-- Lista -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $insproveedor->paginador_proveedor_controlador($pagina[1],10,"");
		?>
    </div>
    <!-- Lista -->