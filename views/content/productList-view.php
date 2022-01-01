    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Almacén" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-dolly-flatbed"></i> &nbspProductos en Almacén</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo PRODUCTOS podrá agregar nuevos productos al sistema, actualizar datos de los productos, eliminar o actualizar la imagen de los productos, imprimir códigos de barras de cada producto, buscar productos en el sistema, ver todos los productos en almacén y filtrar productos por categoría.</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones2">
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productNew/" class="text-gray-700 h5"><i class="fas fa-box-open"></i> Nuevo Producto</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productList/" class="text-gray-700 activo h5"><i class="fas fa-dolly-flatbed"></i> Productos en Almacén</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productCategory/" class="text-gray-700 h5"><i class="fas fa-th-list"></i> Productos por Categoría</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productSearch/" class="text-gray-700 h5"><i class="fas fa-search"></i> Buscar Producto  </a>
        </div>
    </div>
    <!-- Opciones -->
	
	<!-- Instancia al controlador -->
	<?php 
		require_once "./controllers/productoControlador.php";
		$insproducto = new productoControlador();
	?>
    <!-- Instancia al controlador -->

    <div class="container-fluid" style="background-color: #FFF; padding-bottom: 20px;">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $insproducto->paginador_producto_controlador($pagina[1],10,"","");
		?>
    </div>

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>