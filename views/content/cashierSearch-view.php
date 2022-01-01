    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-cash-register"></i> &nbsp; Cajas</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo CAJAS usted podrá registrar cajas de ventas en el sistema para poder realizar ventas, además podrá actualizar los datos de las cajas de venta, realizar búsquedas de cajas o eliminarlas si lo desea.</p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>cashierNew/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-cash-register"></i> &nbsp; Nuevo
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>cashierList/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>cashierSearch/" class="text-gray-700 h5 activo text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar
            </a>
        </div>
    </div>
    <!-- Opciones -->


    <?php 
	    if(!isset($_SESSION['busqueda_caja']) && empty($_SESSION['busqueda_caja'])):
    ?>

    <!-- Buscar -->
    <div class="container-fluid pt-5 pb-4 border-left-success border mb-2">
        <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="default" method="POST" autocomplete="off">
            <input type="hidden" name="modulo" value="">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group bmd-form-group">
                            <input type="text" class="form-control" name="busqueda_caja" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" id="inputSearch" maxlength="30" placeholder="¿Qué caja estas buscando?">
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
    <!-- Buscar -->

    <?php else: ?>

    <!-- Eliminar busqueda -->
    <div class="container-fluid pt-5 pb-4 border-left-danger border mb-2">
        <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="search" method="POST" autocomplete="off">
            <input type="hidden" name="eliminar_busqueda_caja" value="1">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <p class="text-center" style="font-size: 20px;">
                            Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_caja'];?>”</strong>
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
		require_once "./controllers/cajaControlador.php";
		$inscaja = new cajaControlador();
	?>
    <!-- Instancia al controlador -->

    <!-- Lista -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $inscaja->paginador_caja_controlador($pagina[1],10,$_SESSION['busqueda_caja']);
		?>
    </div>
    <!-- Lista -->

    <?php endif; ?>