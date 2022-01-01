    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Almacén" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-box-open"></i> &nbspNuevo Producto</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo PRODUCTOS podrá agregar nuevos productos al sistema, actualizar datos de los productos, eliminar o actualizar la imagen de los productos, imprimir códigos de barras de cada producto, buscar productos en el sistema, ver todos los productos en almacén y filtrar productos por categoría.</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones2">
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productNew/" class="text-gray-700 h5"><i class="fas fa-box-open"></i> Nuevo Producto</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productList/" class="text-gray-700 h5"><i class="fas fa-dolly-flatbed"></i> Productos en Almacén</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productCategory/" class="text-gray-700 h5"><i class="fas fa-th-list"></i> Productos por Categoría</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productSearch/" class="text-gray-700 activo h5"><i class="fas fa-search"></i> Buscar Producto  </a>
        </div>
    </div>
    <!-- Opciones -->

    <?php 
	    if(!isset($_SESSION['busqueda_producto']) && empty($_SESSION['busqueda_producto'])):
    ?>

    <!-- BUSCAR -->
    <div class="container-fluid pt-5 pb-4 border-left-success border mb-2">
        <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="default" method="POST" autocomplete="off">
            <input type="hidden" name="modulo" value="">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group bmd-form-group">
                            <input type="text" class="form-control" name="busqueda_producto" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" id="inputSearch" maxlength="30" placeholder="¿Qué producto estas buscando?">
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
            <input type="hidden" name="eliminar_busqueda_producto" value="1">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6">
                        <p class="text-center" style="font-size: 20px;">
                            Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_producto'];?>”</strong>
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
		require_once "./controllers/productoControlador.php";
		$insproducto = new productoControlador();
	?>
    <!-- Instancia al controlador -->

    <div class="container-fluid" style="background-color: #FFF; padding-bottom: 20px;">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $insproducto->paginador_producto_controlador($pagina[1],10,$_SESSION['busqueda_producto'],"");
		?>
    </div>

    <?php endif; ?>

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?> 