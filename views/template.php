
<?php session_start(['name'=>'PERNOS']);?>
<!DOCTYPE html>
<html lang="es">
<head>

    <!-- ** Etiquetas Meta ** -->
    <?php include "components/metaTags.php";?>
    <!-- End of Metas -->

    <!-- ** Etiquetas CSS ** --> 
    <?php include "components/styles.php";?>
    <!-- End of CSS -->

    <!-- ** Etiquetas JS ** -->
    <?php include "components/scripts.php";?>
    <!-- End of JS -->
    
    <!-- ** Title-Icono** -->
    <title><?php echo COMPANY; ?></title>
    <link rel="icon" type="image/png" href="<?php echo SERVERURL;?>views/img/perno.png"/>
    <!-- End of title-Icono-->

</head>

<body id="page-top">

    <?php 
        $peticionAjax = false;
        require_once "./controllers/vistasControlador.php";
        
            $vt = new vistasControlador();
            $vistasRpta = $vt->obtener_vistas_controlador();
        
            if($vistasRpta =="login" || $vistasRpta =="404"){
                require_once "./views/content/".$vistasRpta."-view.php";
            }else{
                require_once "./controllers/loginControlador.php";
        
                $lc = new loginControlador();
        
                if(!isset($_SESSION['token_pernos']) || !isset($_SESSION['usuario_pernos'])){
                    echo $lc->forzar_cierre_sesion_controlador();
                }
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "./views/components/sideBar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- ** Topbar ** -->
                <?php include "./views/components/topBar.php";?>
                <!-- End of Topbar -->

                <!-- ** Page Content ** -->
                <div class="container-fluid pt-2">
                <?php require_once $vistasRpta;?>
                </div>
                <!-- End of Page Content -->

            </div>
            <!-- End of Main Content -->

        <!-- ** Footer ** -->
        <?php include "./views/components/footer.php";?>
        <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- ** ScrollTopButton ** -->
    <?php include "./views/components/scrollTopButton.php"; ?>
    <!-- End ScrollTopButton -->

    <!-- Cerrar Sesion -->
    <?php include "./views/components/logout.php"; ?>
    <!-- Cerrar Sesion -->
    
    <?php   } ?>

</body>

</html>
