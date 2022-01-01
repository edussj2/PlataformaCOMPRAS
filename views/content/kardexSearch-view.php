    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>     
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-search"></i> &nbspKARDEX POR PRODUCTO</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo KARDEX puede ver los movimientos y costos de entradas - salidas de productos. Además, puede ver información detallada de los movimientos específicos de un producto.</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>kardex/" class="text-gray-700 h5"><i class="fas fa-cash-register"></i> Kardex General</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>kardexSearch/" class="text-gray-700 activo h5"><i class="fas fa-search"></i> Kardex por Prodcuto</a>
        </div>
    </div>
    <!-- Opciones -->

    <?php 
	    if(!isset($_SESSION['busqueda_kardex']) && empty($_SESSION['busqueda_kardex'])):
    ?>

    <!-- BUSCAR -->
    <div class="container-fluid pt-5 pb-4 border-left-success border mb-2">
        <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="default" method="POST" autocomplete="off">
            <input type="hidden" name="modulo" value="">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group bmd-form-group">
                            <input type="text" class="form-control" name="busqueda_kardex" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" id="inputSearch" maxlength="30" placeholder="¿El kardex de que producto estas buscando?">
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
            <input type="hidden" name="eliminar_busqueda_kardex" value="1">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <p class="text-center" style="font-size: 20px;">
                            Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_kardex'];?>”</strong>
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
		require_once "./controllers/kardexControlador.php";
		$inskardex = new kardexControlador();
	?>
    <!-- Instancia al controlador -->

    <!-- Lista -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $inskardex->paginador_kardex_controlador($pagina[1],10,$_SESSION['busqueda_kardex']);
		?>
    </div>
    <!-- Lista -->

    <?php endif; ?>

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>

  