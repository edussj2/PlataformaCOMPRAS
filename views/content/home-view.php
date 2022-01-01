          <!-- Cabecera de página-->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Estadísticas</h1>
          </div>

          <!-- Content Fila -->
          <div class="row">

            <?php
                require "./controllers/proveedorControlador.php";
                $Iproveedor = new proveedorControlador();
                $NP = $Iproveedor->datos_proveedor_controlador("Conteo",0);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-1">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Proveedores</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $NP->rowCount(); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-truck-moving fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php
                require "./controllers/cajaControlador.php";
                $Icaja = new cajaControlador();
                $NC = $Icaja->datos_caja_controlador("Conteo",0);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-1">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Número de Cajas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $NC->rowCount(); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-cash-register fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php
                require "./controllers/productoControlador.php";
                $Iproducto = new productoControlador();
                $NPro = $Iproducto->datos_producto_controlador("Conteo",0);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-1">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Productos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $NPro->rowCount(); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-boxes fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php
                require "./controllers/categoriaControlador.php";
                $Icategoria = new categoriaControlador();
                $NCat = $Icategoria->datos_categoria_controlador("Conteo",0);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-1">
                      <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Categorías</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $NCat->rowCount(); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tags fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php
                require "./controllers/compraControlador.php";
                $Icompra = new compraControlador();
                $NCompra = $Icompra->datos_compra_controlador("Conteo",0);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-1">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Compras Totales</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $NCompra->rowCount(); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-1">
                      <div class="text-xs font-weight-bold text-seborder-left-secondary text-uppercase mb-1">Número de Clientes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-1">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Número de Ventas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-check-alt fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <?php
                require "./controllers/userControlador.php";
                $Iuser = new userControlador();
                $NU = $Iuser->datos_user_controlador("Conteo",0);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-1">
                      <div class="text-xs font-weight-bold text-prborder-left-primary text-uppercase mb-1">Trabajadores</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $NU->rowCount(); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-tie fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- Content Fila -->

          <section class="">
                <div class="row">

                  <div class="col-lg-6 mb-3">
                      <div class="card rounded-0">
                          <div class="card-header bg-light">
                              <h6 class="font-weight-bold mb-0"><i class="fas fa-chart-bar"></i> Productos con mayor Stock</h6>
                          </div>
                          <?php 
                                  require_once "./controllers/graficosControlador.php";

                                  $insgrafico1 = new graficosControlador();

                                  $datos1 = $insgrafico1->datos_graficos_producto1_mayor_stock_controlador();

                                  $label1 = json_encode($datos1);

                                  require_once "./controllers/graficosControlador.php";

                                  $insgrafico2 = new graficosControlador();

                                  $datos2 = $insgrafico2->datos_graficos_producto2_mayor_stock_controlador();

                                  $data1 = json_encode($datos2);
                          ?>
                          <div class="card-body">
                              <canvas id="myChart1" width="300" height="160"></canvas>
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-6 mb-2">
                      <div class="card rounded-0">
                          <div class="card-header bg-light">
                              <h6 class="font-weight-bold mb-0"><i class="fas fa-chart-pie"></i> N° de Trabajadores por cargo</h6>
                              <?php 
                                  require_once "./controllers/graficosControlador.php";

                                  $insgrafico3 = new graficosControlador();

                                  $datos3 = $insgrafico3->datos_graficos_trabajadores_controlador();

                                  $data2 = json_encode($datos3);
                            ?>
                          </div>
                          <div class="card-body">
                              <canvas id="myChart2" width="300" height="160"></canvas>
                          </div>
                      </div>
                  </div>

                </div>
            
          </section>
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <script>
              var titulo1 = <?php echo $label1; ?>;
              var cantidad1 = <?php echo $data1; ?>;
            
              var ctx = document.getElementById('myChart1').getContext('2d');
              var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: titulo1,
                      datasets: [{
                          label: 'Producto con mayor Stock',
                          data: cantidad1,
                          backgroundColor: [
                            'rgba(255, 207, 229)',
                            'rgba(253, 223, 236)',
                            'rgba(244, 237, 255)',
                            'rgba(235, 214, 255)',
                            'rgba(230, 200, 253)'
                          ],
                          borderColor: [
                            'rgb(255, 207, 229)',
                            'rgb(253, 223, 236)',
                            'rgb(244, 237, 255)',
                            'rgb(235, 214, 255)',
                            'rgb(230, 200, 253)'
                          ],
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      }
                  }
              });

              var titulo2 = ["Administrador","Almacén","Logística","Ventas"];
              var cantidad2 = <?php echo $data2; ?>;
            
              var ctx2 = document.getElementById('myChart2').getContext('2d');
              var myChart2 = new Chart(ctx2, {
                  type: 'doughnut',
                  data: {
                      labels: titulo2,
                      datasets: [{
                          label: '# de Trabajadores',
                          data: cantidad2,
                          backgroundColor: [
                              'rgba(255, 99, 132)',
                              'rgba(54, 162, 235)',
                              'rgb(255, 205, 86)',
                              'rgb(149, 125, 173)'
                          ],
                          hoverOffset: 4
                      }]
                  },
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      },
                      aspectRatio:2
                  }
              });

          </script>