    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Almacén" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>

    <!-- Regresar -->
    <div class="container-fluid">
        <p class="text-right">
            <a href="<?php echo SERVERURL ?>productList/" class="btn btn-raised btn-info btn-go-back"><i class="fas fa-reply"></i> &nbsp; Regresar</a>
        </p>  
    </div>
    
    <!-- Cabecera de página-->
    <div class="m-3 text-center">
        <h1 class="h3 mb-4 text-gray-800"><i class="far fa-image"></i> &nbsp;Imagen del Producto</h1>
    </div>

    <!-- Fila -->
    <div class="row">

        <!-- VER PRODUCTO -->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

            <?php

                $datos = explode("/", $_GET['views']);
                require_once "./controllers/productoControlador.php";
                $clasproducto = new productoControlador();

                $filesC = $clasproducto->datos_producto_controlador("Unico",$datos[1]);

                if($filesC->rowCount()==1){
                    $campos = $filesC->fetch();
            ?>
                <div class="form-neon">
                    <h3 class="text-center text-info"><?php echo $campos['nombre']?></h3>
                    <hr>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <figure>
                                    <img class="img-fluid img-product-info" src="<?php echo SERVERURL;?>files/<?php echo $campos['imagen']?>" alt="<?php echo $campos['nombre']?>">
                                </figure>
                                <?php if($campos['imagen']!="producto.png"){?>
                                <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/productoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                    <input type="hidden" name="producto_img_id_del" value="<?php echo $datos[1]?>">
                                    <input type="hidden" name="producto_img_img_del" value="<?php echo $campos['imagen']?>">
                                    <p class="text-center" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-raised btn-danger btn-sm">
                                        <i class="far fa-trash-alt"></i> &nbsp; ELIMINAR IMAGEN</button>
                                    </p>
                                    <div class="RespuestaAjax"></div>
                                </form>
                                <?php }?>
                            </div>

                            <div class="col-12 col-md-6">
                                <form class="border p-4 FormularioAjax" action="<?php echo SERVERURL;?>ajax/productoAjax.php" method="POST" data-form="update" autocomplete="off" enctype="multipart/form-data">
                                    <input type="hidden" name="producto_img_id_up" value="<?php echo $datos[1]?>">
                                    <input type="hidden" name="producto_img_img_up" value="<?php echo $campos['imagen']?>">

                                    <fieldset>
                                        <legend><i class="far fa-image"></i> &nbsp; Actualizar foto o imagen del producto</legend>
                                        <div class="container-fluid">
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="file" class="form-control-file" name="producto_foto_up" id="archivoInput" accept=".jpg, .png, .jpeg" onchange="return validarExt()">
                                                        <small class="text-muted">Tipos de archivos permitidos: JPG, JPEG, PNG. Tamaño máximo 3MB. Resolución recomendada 300px X 300px o superior manteniendo el aspecto cuadrado (1:1)</small>
                                                    </div>
                                                    <p class="text-center" style="margin-top: 20px;">
                                                        <button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync"></i> &nbsp; ACTUALIZAR IMAGEN</button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="RespuestaAjax"></div>
                                </form>
                            </div>
                        </div>
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

                </div>
            </div>
        </div>
  
    </div>

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?> 