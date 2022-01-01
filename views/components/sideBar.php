    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo SERVERURL; ?>home/">
        <div class="sidebar-brand-icon">
          <i class="fas fa-tools"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo COMPANY; ?></div>
      </a>
    
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVERURL; ?>home/">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Inicio</span></a>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider">

      <?php if($_SESSION['tipo_pernos'] == "Administrador"){?>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-fw fa-cog"></i>
          <span>Administración</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo SERVERURL; ?>documentNew/"><i class="far fa-id-card"></i> Tipo de Documentos</a><!-- Boleta factura o ticket-->
            <a class="collapse-item" href="<?php echo SERVERURL; ?>wayPayNew/"><i class="far fa-credit-card"></i> Tipo de Pagos</a><!-- Contado credito -->
            <a class="collapse-item" href="<?php echo SERVERURL; ?>positionNew/"><i class="fas fa-user-tag"></i> Tipo de Trabajadores</a><!-- Administrador - Almacenista - vendedor - Logistica -->
            <a class="collapse-item" href="<?php echo SERVERURL; ?>cashierNew/"><i class="fas fa-cash-register"></i> Cajas</a><!-- Cajas en la tienda -->
            <a class="collapse-item" href="<?php echo SERVERURL; ?>categoryNew/"><i class="fas fa-tags"></i> Categorías</a><!-- Categoría de prodcutos -->
            <a class="collapse-item" href="<?php echo SERVERURL; ?>presentationNew/"><i class="fab fa-product-hunt"></i> Presentaciones</a><!-- Categoría de prodcutos -->
            <a class="collapse-item" href="<?php echo SERVERURL; ?>providerNew/"><i class="fas fa-truck-moving"></i> Proveedores</a><!-- Proveedores -->
            <a class="collapse-item" href="<?php echo SERVERURL; ?>clientNew/"><i class="fas fa-users"></i> Clientes *</a><!-- Proveedores -->
          </div>
        </div>
      </li>

      <?php }if($_SESSION['tipo_pernos'] == "Administrador" || $_SESSION['tipo_pernos'] == "Personal de Logística" || $_SESSION['tipo_pernos'] == "Personal de Almacén"){?>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-boxes"></i>
          <span>Alamcén</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo SERVERURL?>productNew/"><i class="fas fa-box-open"></i> Nuevo Producto</a>
            <a class="collapse-item" href="<?php echo SERVERURL?>productList/"><i class="fas fa-dolly-flatbed"></i> Productos en Almacén</a>
            <a class="collapse-item" href="<?php echo SERVERURL?>productCategory/"><i class="fas fa-th-list"></i> Prod. por Categoría</a>
            <a class="collapse-item" href="<?php echo SERVERURL?>productSearch/"><i class="fas fa-search"></i> Buscar Productos</a>
          </div>
        </div>
      </li>

      <?php }if($_SESSION['tipo_pernos'] == "Administrador" || $_SESSION['tipo_pernos'] == "Personal de Logística"){?>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-shopping-cart"></i>
          <span>Compras</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo SERVERURL?>shopNew/"><i class="fas fa-shopping-basket"></i> Nueva Compra</a>
            <a class="collapse-item" href="<?php echo SERVERURL?>shopList/"><i class="fas fa-file-invoice-dollar"></i> Compras Realizadas</a>
            <a class="collapse-item" href="<?php echo SERVERURL?>shopSearch/"><i class="fas fa-search-dollar"></i> Buscar Compras</a>
          </div>
        </div>
      </li>

      <?php }if($_SESSION['tipo_pernos'] == "Administrador" || $_SESSION['tipo_pernos'] == "Personal de Ventas"){ ?>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
          <i class="fas fa-hand-holding-usd"></i>
          <span>Ventas</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#"><i class="fas fa-cart-plus"></i> Nueva Venta *</a>
            <a class="collapse-item" href="#"><i class="fas fa-coins fa-fw"></i> Ventas Realizadas *</a>
            <a class="collapse-item" href="#"><i class="fab fa-creative-commons-nc fa-fw"></i> Ventas Pendientes *</a>
            <a class="collapse-item" href="#"><i class="fas fa-search-dollar"></i> Buscar Ventas *</a>
          </div>
        </div>
      </li>

      <?php }if($_SESSION['tipo_pernos'] == "Administrador" || $_SESSION['tipo_pernos'] == "Personal de Logística"){?>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
          <i class="fas fa-wallet"></i>
          <span>Movimientos</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#"><i class="far fa-money-bill-alt"></i> Nuevo Movimiento *</a>
            <a class="collapse-item" href="#"><i class="fas fa-money-check-alt fa-fw"></i> Lista Movimientos *</a>
            <a class="collapse-item" href="#"><i class="fas fa-search-dollar"></i> Buscar Movimiento *</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
          <i class="fas fa-warehouse"></i>
          <span>Kardex</span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo SERVERURL; ?>kardex/"><i class="fas fa-pallet"></i> Kardex General</a>
            <a class="collapse-item" href="<?php echo SERVERURL; ?>kardexSearch/"><i class="fas fa-search"></i> Kardex por producto</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseEigth" aria-expanded="true" aria-controls="collapseEigth">
          <i class="far fa-file-excel"></i>
          <span>Reportes</span>
        </a>
        <div id="collapseEigth" class="collapse" aria-labelledby="headingEigth" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo SERVERURL; ?>reports/"><i class="fas fa-file-csv"></i> Reportes en Excel</a>
          </div>
        </div>
      </li>

      <?php }if($_SESSION['tipo_pernos'] == "Administrador"){ ?>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
          <i class="fas fa-sliders-h"></i>
          <span>Configuración</span>
        </a>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo SERVERURL; ?>company/"><i class="fas fa-building"></i> Empresa</a>
            <a class="collapse-item" href="<?php echo SERVERURL; ?>userNew/"><i class="fas fa-user-tie"></i> Trabajadores</a>
          </div>
        </div>
      </li>
      
      <?php } ?>
      
    </ul>