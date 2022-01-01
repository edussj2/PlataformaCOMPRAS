    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>   
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-pallet"></i> &nbspKARDEX GENERAL</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo KARDEX puede ver los movimientos y costos de entradas - salidas de productos. Además, puede ver información detallada de los movimientos específicos de un producto.</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>kardex/" class="text-gray-700 activo h5"><i class="fas fa-cash-register"></i> Kardex General</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>kardexSearch/" class="text-gray-700 h5"><i class="fas fa-search"></i> Kardex por Prodcuto</a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Instancia al controlador -->
    <?php 
		require_once "./controllers/kardexControlador.php";
		$inskardex = new kardexControlador();
	?>
    <!-- Instancia al controlador -->

    <!-- Lista kardexs -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $inskardex->paginador_kardex_controlador($pagina[1],10,"");
		?>
    </div>

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>