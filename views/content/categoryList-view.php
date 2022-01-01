    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-tags"></i> &nbsp; Categorías</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo CATEGORÍAS usted podrá registrar las categorías que servirán para agregar productos y también podrá ver los productos que pertenecen a una categoría determinada. Además de lo antes mencionado, puede actualizar los datos de las categorías, realizar búsquedas de categorías o eliminarlas si así lo desea.</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>categoryNew/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-tags"></i> &nbsp; Nuevo</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>categoryList/" class="text-gray-700 activo h5 text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>categorySearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar</a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Instancia al controlador -->
    <?php 
		require_once "./controllers/categoriaControlador.php";
		$inscategoria = new categoriaControlador();
	?>
    <!-- Instancia al controlador -->

    <!-- Lista -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $inscategoria->paginador_categoria_controlador($pagina[1],10,"");
		?>
    </div>
    <!-- Lista -->