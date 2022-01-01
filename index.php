<?php
    require_once "core/configGeneral.php";
    require_once "controllers/vistasControlador.php";

    $template = new vistasControlador();
    $template->obtener_template_controlador();
?>