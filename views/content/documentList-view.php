    <?php
        if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
        }
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="far fa-id-card"></i> &nbsp; Tipo de Documentos
        </h1>
        <p class="text-gray-700 mb-4 text-justify">
            En el módulo TIPO DE DOCUMENTOS usted podrá registrar los Tipo de Documentos que servirán para identificar a las distintas entidades que se registren. Además de lo antes mencionado, puede actualizar los datos de los documentos, realizar búsquedas de documentos o eliminarlas si así lo desea.
        </p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>documentNew/" class="text-gray-700 h5 text-uppercase">
                <i class="far fa-id-card"></i> &nbsp; Nuevo 
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>documentList/" class="text-gray-700 activo h5 text-uppercase">
                <i class="fas fa-list"></i> &nbsp; Lista 
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>documentSearch/" class="text-gray-700 h5 text-uppercase"> 
                <i class="fas fa-search"></i> &nbsp; Buscar 
            </a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Instancia al controlador -->
    <?php 
		require_once "./controllers/documentoControlador.php";
		$insDocumento = new documentoControlador();
	?>
    <!-- Instancia al controlador -->


    <!-- Lista Documentos -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $insDocumento->paginador_documento_controlador($pagina[1],10,"");
		?>
    </div>
    <!-- Lista Documentos -->