    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-user-tag"></i> &nbsp; Tipo de Trabajadores
        </h1>
        <p class="text-gray-700 mb-4 text-justify">
            En el módulo TIPO DE TRABAJADORES usted podrá registrar los tipos de Trabajadores que servirán para identificar a los trabajadores que se registren y los módulos al que tendrán acceso. Además de lo antes mencionado, puede actualizar los datos de los tipo de trabajadores, realizar búsquedas de tipo de trabajadores o eliminarlas si así lo desea.
        </p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>positionNew/" class="text-gray-700 h5 text-uppercase">
                <i class="fas fa-user-tag"></i> &nbsp; Nuevo 
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>positionList/" class="text-gray-700 h5 text-uppercase activo">
                <i class="fas fa-list"></i> &nbsp; Lista
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>positionSearch/" class="text-gray-700 h5 text-uppercase">
                <i class="fas fa-search"></i> &nbsp; Buscar
            </a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Instancia al controlador -->
    <?php 
		require_once "./controllers/cargoControlador.php";
		$insCargo = new cargoControlador();
	?>
    <!-- Instancia al controlador -->


    <!-- Lista -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $insCargo->paginador_cargo_controlador($pagina[1],10,"");
		?>
    </div>
    <!-- Lista -->