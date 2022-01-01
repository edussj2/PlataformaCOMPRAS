    <?php
	    if($_SESSION['tipo_pernos']=="Administrador" || $_SESSION['tipo_pernos']=="Personal de Logística"){
    ?>

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-info-circle"></i> &nbspDetalles de Compra</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo COMPRAS usted podrá registrar compras de productos ya sea nuevos o ya registrados en sistema. También puede ver la lista de todas las compras realizadas, buscar compras y ver información más detallada de cada compra.</p>
    </div>

    <div class="container-fluid">
        <p class="text-right">
            <a href="<?php echo SERVERURL ?>shopList/" class="btn btn-raised btn-info btn-go-back"><i class="fas fa-reply"></i> &nbsp; Regresar</a>
        </p>  
    </div>

    
    <!-- Agregar Presentacion -->
    <div class="row">

        <!-- Nuevo Presentacion -->
        <div class="col-lg-12">
            <div class="card shadow mb-4 pb-4" id="detalleCompra">
                <div class="card-body">
                <?php

                $datos = explode("/", $_GET['views']);
                require_once "./controllers/compraControlador.php";
                $classcompra = new compraControlador();

                $filesC = $classcompra->datos_compra_controlador("Unico",$datos[1]);

                if($filesC->rowCount()==1){
                    $campos = $filesC->fetch();

                    require_once "./controllers/empresaControlador.php";
                    $classempresa = new empresaControlador();

                    $filesE = $classempresa->datos_empresa_controlador("Unico",1);

                    $datosEmpresa = $filesE->fetch();
                ?>
                    <!-- DETALLES -->
                    <h4 class="text-center font-weight-bold mt-3">Compra N° <?php echo $campos['idCompra'] ?></h4>
                    <div class="container mt-3">
                        <p>Empresa: <?php echo $datosEmpresa['razSocial'];?> - RUC: <?php echo $datosEmpresa['ruc'];?></p>
                        <p>Dirección: <?php echo $datosEmpresa['direccion'];?> - Teléfono <?php echo $datosEmpresa['telefono'];?></p>
                    </div>
                    <div class="container mb-5 mt-4">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <p class="text-center text-uppercase font-weight-bold bg-danger" style="color: #FFF;">Datos de Compra</p>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-calendar-week"></i> Fecha :</span> 
                                        <span><?php echo $campos['fecha'];?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-user-tie"></i> Compra registrada por :</span>
                                        <span><?php echo $campos['nombres'];?> <?php echo $campos['apellidos'];?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <p class="text-center text-uppercase font-weight-bold bg-warning" style="color: #FFF;">Proveedor</p>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-building"></i> Razón Social : </span> 
                                        <span><?php echo $campos['razSocial'];?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-street-view"></i> Dirección : </span>
                                        <span><?php echo $campos['direccion'];?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead style="background:#03a9f4; color:#fff">
                                    <tr class="text-center text-uppercase">
                                        <th scope="col">#</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Devolución</th>
                                    </tr>
                                </thead>
                                <tbody>
                                            
                                    <?php 
                                        require_once "./controllers/detalleCompraControlador.php";
                                        $insdetalleCompra = new detalleCompraControlador();
                                        echo $insdetalleCompra->paginador_detalleCompra_controlador($datos[1]);
                                    ?>
                                                        
                                    <tr class="text-center text-uppercase font-weight-bold">
                                        <td colspan="3"></td>
                                        <td>Subtotal</td>
                                        <td>S/ <?php echo $campos['subtotal'];?> SOLES</td>
                                        <td></td>
                                    </tr>
                                    <tr class="text-center text-uppercase font-weight-bold">
                                        <td colspan="3"></td>
                                        <td>IVA 12%</td>
                                        <td>S/ <?php echo $campos['montoTotal']-$campos['subtotal'];?> SOLES</td>
                                        <td></td>
                                    </tr>
                                    <tr class="text-center text-uppercase font-weight-bold">
                                        <td colspan="3"></td>
                                        <td>Total</td>
                                        <td>S/ <?php echo $campos['montoTotal'];?> SOLES</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                        


                    <!-- Version futura 
                    <h4 class="text-center">Devoluciones realizadas</h4>
                    <div class="container-fluid mb-5">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-success" style="color: #fff;">
                                        <tr class="text-center text-uppercase">
                                            <th scope="col">#</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Vendedor</th>
                                            <th scope="col">Caja</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center text-uppercase"><td colspan="8">No hay datos para mostrar</td></tr>                
                                </tbody>
                            </table>
                        </div>
                    </div>-->

            
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
            <p class="text-center">
                <a  class="btn btn-success print-barcode" onclick="printPage()"><i class="fas fa-print"></i> &nbsp; Imprimir</a>
            </p>
        </div>
  
    </div>

    <?php    
        }else{
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>

    <script>
        function printPage(){
            var body = document.getElementById('page-top').innerHTML;
            var data = document.getElementById('detalleCompra').innerHTML;
            document.getElementById('page-top').innerHTML=data;
            window.print();
            document.getElementById('page-top').innerHTML=body;
        }
    </script>

