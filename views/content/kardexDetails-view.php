    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']!="Personal de Logística"){
    ?> 

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800">
            <i class="fas fa-luggage-cart fa-fw"></i> &nbspKardex Detalles
        </h1>
    </div>

    <div class="container-fluid">
        <p class="text-right">
            <a href="<?php echo SERVERURL ?>kardex/" class="btn btn-raised btn-info btn-go-back"><i class="fas fa-reply"></i> &nbsp; Regresar</a>
        </p>  
    </div>

    <?php

        $datos = explode("/", $_GET['views']);
        require_once "./controllers/kardexControlador.php";
        $classkardex = new kardexControlador();

        $filesD = $classkardex->datos_kardex_controlador("Unico",$datos[1]);

        if($filesD->rowCount()==1){
            $campos = $filesD->fetch();
    ?>

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-uppercase font-weight-bold text-center">kardex de <?php echo $campos['nombre'];?></p>
                </div>
                <div class="col-12 col-lg-4">
                    <p class="text-center text-uppercase font-weight-bold bg-success" style="color: #FFF;">Entradas</p>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Entrada de unidades
                            <span><?php echo $campos['uniEntrada'];?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Costo de unidades
                            <span>S/ <?php echo $campos['dinerEntrada'];?> SOLES</span>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-lg-4">
                    <p class="text-center text-uppercase font-weight-bold bg-danger" style="color: #FFF;">Salidas</p>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Salida de unidades
                            <span><?php echo $campos['uniSalida'];?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Costo de unidades
                            <span>S/ <?php echo $campos['dinerSalida'];?> SOLES</span>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-lg-4">
                    <p class="text-center text-uppercase font-weight-bold bg-primary" style="color: #FFF;">Existencias</p>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Inventario inicial
                            <span><?php echo $campos['invenInicial'];?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Inventario actual
                            <span><?php echo $campos['invenActual'];?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-5 mb-5">
            <p class="text-uppercase font-weight-bold text-center">Detalles de kardex</p>
            <?php 
                require_once "./controllers/kardexDetalleControlador.php";
                $inskardexDetalle = new kardexDetalleControlador();
                $pagina = explode("/", $_GET['views']);
			    echo $inskardexDetalle->paginador_kardexDetalle_controlador($pagina[2],10,$campos['idKardex']);
            ?>
        </div>
    </div>

    <?php 
        }else{
    ?>
        <div class="alert alert-dimissible alert-warning text-center border mt-3">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <i class="fas fa-exclamation-triangle" style="font-size:4rem;"></i>
            <h4>!LO SENTIMOS!</h4>
            <p>No pudimos mostrar la información buscada</p>
        </div>
    <?php   
        }
    ?> 

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>