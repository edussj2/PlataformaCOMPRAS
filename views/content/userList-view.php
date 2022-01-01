    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-user-tie"></i> &nbsp; Trabajadores
        </h1>
        <p class="text-gray-700 mb-4 text-justify">
            En el módulo TRABAJADORES podrá registrar nuevos usuarios en el sistema ya sea un administrador, vendedor, almacenista, entreo otros, también podrá ver la lista de usuarios registrados, buscar usuarios en el sistema, actualizar datos de otros usuarios y los suyos.
        </p>
    </div>
    <!-- Cabecera de página-->

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>userNew/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-user-tie"></i> &nbsp; Nuevo</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>userList/" class="text-gray-700 activo h5 text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>userSearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar</a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Instancia al controlador -->
    <?php 
		require_once "./controllers/userControlador.php";
		$insUser = new userControlador();
	?>
    <!-- Instancia al controlador -->

    <!-- Lista -->
    <div class="container-fluid">
        <?php 
			$pagina = explode("/", $_GET['views']);
			echo $insUser->paginador_user_controlador($pagina[1],10,$_SESSION['id_pernos'],"");
		?>
    </div>
    <!-- Lista -->