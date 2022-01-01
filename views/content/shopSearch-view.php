    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>
    <?php 
        $fechaActual = date('Y-m-d');
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-search-dollar"></i> &nbspBuscar Compra</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo COMPRAS usted podrá registrar compras de productos ya sea nuevos o ya registrados en sistema. También puede ver la lista de todas las compras realizadas, buscar compras y ver información más detallada de cada compra..</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>shopNew/" class="text-gray-700 h5"><i class="fas fa-shopping-basket"></i> Nueva Compra</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>shopList/" class="text-gray-700 h5"><i class="fas fa-file-invoice-dollar"></i> Compras Realizadas</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>shopSearch/" class="text-gray-700 activo h5"><i class="fas fa-search-dollar"></i> Buscar Compra</a>
        </div>
    </div>
    <!-- Opciones -->

    <?php 
	    if(!isset($_SESSION['busqueda_compra']) && empty($_SESSION['busqueda_compra'])):
    ?>

    <!-- BUSCAR  -->
    <div class="container-fluid pt-5 pb-4 border-left-success border mb-2">
        <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="default" method="POST" autocomplete="off">
            <input type="hidden" name="modulo" value="">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group bmd-form-group">
                            <input type="date" class="form-control" name="busqueda_compra" id="inputSearch" max="<?php echo $fechaActual; ?>" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="text-center">
                            <button type="submit" class="btn btn-sm btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
    <!-- BUSCAR  -->

    <?php else: ?>

    <!-- Eliminar busqueda -->
    <div class="container-fluid pt-5 pb-4 border-left-danger border mb-2">
        <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="search" method="POST" autocomplete="off">
            <input type="hidden" name="eliminar_busqueda_compra" value="1">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <p class="text-center" style="font-size: 20px;">
                            Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_compra'];?>”</strong>
                        </p>
                    </div>
                    <div class="col-12">
                        <p class="text-center" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
    <!-- Eliminar busqueda -->

    <!-- Instancia al controlador -->
    <?php 
		require_once "./controllers/compraControlador.php";
		$inscompra = new compraControlador();
	?>
    <!-- Instancia al controlador -->

    <!-- Lista  -->
    <div class="container-fluid mt-3">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $inscompra->paginador_compra_controlador($pagina[1],10,$_SESSION['busqueda_compra']);
		?>
    </div>
    <!-- Lista  -->

    <?php endif; ?>
    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?> 