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
            <a href="<?php echo SERVERURL; ?>presentationList/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>presentationSearch/" class="text-gray-700 h5 text-uppercase activo"><i class="fas fa-search"></i> &nbsp; Buscar
            </a>
        </div>
    </div>
    <!-- Opciones -->

    <?php 
	    if(!isset($_SESSION['busqueda_presentacion']) && empty($_SESSION['busqueda_presentacion'])):
    ?>

    <!-- BUSCAR -->
    <div class="container-fluid pt-5 pb-4 border-left-success border mb-2">
        <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="default" method="POST" autocomplete="off">
            <input type="hidden" name="modulo" value="">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group bmd-form-group">
                            <input type="text" class="form-control" name="busqueda_presentacion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" id="inputSearch" maxlength="30" placeholder="¿Qué presentacion estas buscando?">
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
    <!-- BUSCAR -->

    <?php else: ?>

    <!-- Eliminar busqueda -->
    <div class="container-fluid pt-5 pb-4 border-left-danger border mb-2">
        <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="search" method="POST" autocomplete="off">
            <input type="hidden" name="eliminar_busqueda_presentacion" value="1">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <p class="text-center" style="font-size: 20px;">
                            Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_presentacion'];?>”</strong>
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
		require_once "./controllers/presentacionControlador.php";
		$inspresentacion = new presentacionControlador();
	?>
    <!-- Instancia al controlador -->

    <!-- Lista presentacion -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $inspresentacion->paginador_presentacion_controlador($pagina[1],10,$_SESSION['busqueda_presentacion']);
		?>
    </div>
    <!-- Lista Presentacion -->

    <?php endif; ?>