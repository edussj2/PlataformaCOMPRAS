    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Almacén" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>
    
    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-th-list"></i> &nbspProductos en Almacén</h1>
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
            <a href="<?php echo SERVERURL;?>productCategory/" class="text-gray-700 h5 activo"><i class="fas fa-th-list"></i> Productos por Categoría</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>productSearch/" class="text-gray-700 h5"><i class="fas fa-search"></i> Buscar Producto  </a>
        </div>
    </div>
    <!-- Opciones -->
    
    <!-- Lista -->
    <div class="container-fluid">
        <div class="product-container">

            <div class="product-category">
                <h5 class="text-uppercase text-center"><i class="fas fa-tags"></i> &nbsp; Categorías</h5>
                <ul class="list-unstyled text-center product-category-list">
                    <?php 
                        require_once "./controllers/categoriaControlador.php";

                        $inscategoria = new categoriaControlador();

                        $categoria = $inscategoria->datos_categoria_controlador("Select",0);

                        while ($rowD = $categoria->fetch()) {
                            echo '  <li>
                                        <a href="'.SERVERURL.'productCategory/'.$rowD['idCategoria'].'/">'.$rowD['nombre'].' <span class="badge badge-pill badge-success">';
                            
                            require_once "./controllers/productoControlador.php";
                            $insproducto2 = new productoControlador();
                            $producto2 = $insproducto2->datos_producto_controlador("Especial",mainModel::encryption($rowD['idCategoria']));

                            echo $producto2->rowCount();

                            echo' </span></a>
                                    </li>';
                                                
                        }
                    ?> 
                </ul>
            </div>  
            
            <!-- Instancia al controlador -->
            <?php 
                require_once "./controllers/productoControlador.php";
                $insproducto = new productoControlador();
                $pagina = explode("/", $_GET['views']);
            ?>
            <!-- Instancia al controlador -->

            <div class="product-list">
            <?php 
                if(isset($pagina[1]) && $pagina[1]!=""){

                    $inscategoria2 = new categoriaControlador();
                    $categoria2 = $inscategoria2->datos_categoria_controlador("Unico",mainModel::encryption($pagina[1]));
                    $data = $categoria2->fetch();
                    echo '<h3 class="text-center text-uppercase">Productos en categoría <strong>"'.$data['nombre'].'"</strong></h3>
                    <br>';
                    echo $insproducto->paginador_producto_controlador($pagina[2],10,"",$pagina[1]);
                }else{
            ?>
                <div class="alert text-verde text-center" role="alert">
                    <p><i class="fab fa-shopify fa-fw fa-5x"></i></p>
                    <h4 class="alert-heading">Categoría no seleccionada</h4>
                    <p class="mb-0">Por favor seleccione una categoría para empezar a buscar productos.</p>
                </div>
                
            <?php 
                } 
		    ?>               
            </div>

        </div>
    </div>

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>