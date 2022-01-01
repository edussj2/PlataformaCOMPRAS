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
            <a href="<?php echo SERVERURL; ?>positionList/" class="text-gray-700 h5 text-uppercase">
                <i class="fas fa-list"></i> &nbsp; Lista
            </a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>positionSearch/" class="text-gray-700 activo h5 text-uppercase">
                <i class="fas fa-search"></i> &nbsp; Buscar
            </a>
        </div>
    </div>
    <!-- Opciones -->

    <?php 
	    if(!isset($_SESSION['busqueda_cargo']) && empty($_SESSION['busqueda_cargo'])):
    ?>

    <!-- Buscar -->
    <div class="container-fluid pt-5 pb-4 border-left-success border mb-2">
        <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="default" method="POST" autocomplete="off">
            <input type="hidden" name="modulo" value="">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group bmd-form-group">
                            <input type="text" class="form-control" name="busqueda_cargo" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" id="inputSearch" maxlength="30" placeholder="¿Qué cargo estas buscando?">
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
            <input type="hidden" name="eliminar_busqueda_cargo" value="1">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <p class="text-center" style="font-size: 20px;">
                            Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_cargo'];?>”</strong>
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
		require_once "./controllers/cargoControlador.php";
		$insCargo = new cargoControlador();
	?>
    <!-- Instancia al controlador -->

    <!-- Lista -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $insCargo->paginador_cargo_controlador($pagina[1],10,$_SESSION['busqueda_cargo']);
		?>
    </div>
    <!-- Lista -->

    <?php endif; ?>