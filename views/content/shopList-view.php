    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-file-invoice-dollar"></i> &nbspCompras Realizadas</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo COMPRAS usted podrá registrar compras de productos ya sea nuevos o ya registrados en sistema. También puede ver la lista de todas las compras realizadas, buscar compras y ver información más detallada de cada compra..</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>shopNew/" class="text-gray-700 h5"><i class="fas fa-shopping-basket"></i> Nueva Compra</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>shopList/" class="text-gray-700 activo h5"><i class="fas fa-file-invoice-dollar"></i> Compras Realizadas</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>shopSearch/" class="text-gray-700 h5"><i class="fas fa-search-dollar"></i> Buscar Compra</a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Instancia al controlador -->
        <?php 
		require_once "./controllers/compraControlador.php";
		$inscompra = new compraControlador();
	?>
    <!-- Instancia al controlador -->


    <!-- Lista compras -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $inscompra->paginador_compra_controlador($pagina[1],20,"");
		?>
    </div>
    <!-- Lista compras -->

    <script>
    $(document).ready(function() {
        $('.selectProducto').select2();
    });
    </script>

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?> 