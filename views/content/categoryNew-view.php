    <?php
	    if($_SESSION['tipo_pernos']!="Administrador"){
            echo $lc->forzar_cierre_sesion_controlador();
	    }
    ?>

    <!-- Cabecera de página-->
    <div class="m-2">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-tags"></i> &nbsp; Categorías</h1>
        <p class="text-gray-700 mb-4 text-justify">En el módulo CATEGORÍAS usted podrá registrar las categorías que servirán para agregar productos y también podrá ver los productos que pertenecen a una categoría determinada. Además de lo antes mencionado, puede actualizar los datos de las categorías, realizar búsquedas de categorías o eliminarlas si así lo desea.</p>
    </div>

    <!-- Opciones -->
    <div class="lista-opciones">
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>categoryNew/" class="text-gray-700 h5 text-uppercase activo"><i class="fas fa-tags"></i> &nbsp; Nuevo</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>categoryList/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-list"></i> &nbsp; Lista</a>
        </div>
        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>categorySearch/" class="text-gray-700 h5 text-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar</a>
        </div>
    </div>
    <!-- Opciones -->

    <!-- Fila -->
    <div class="row">

        <!-- Nuevo Categoria -->
        <div class="col-lg-12">
            <div class="card shadow mb-5">
                <div class="card-body">

                    <!-- Formulario -->
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/categoriaAjax.php" method="POST" data-form="save" autocomplete="off">
                            <fieldset>
                                <legend><i class="fas fa-server"></i> &nbsp; Información de la categoría</legend>
                                <div class="container-fluid mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="categoria_nombre">Nombre de la categoría &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-99áéíóúÁÉÍÓÚñÑ ]{3,40}" class="form-control" name="categoria_nombre_reg" id="categoria_nombre" maxlength="40">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label for="categoria_estado">Estado de la categoría</label>
                                                <select class="form-control" name="categoria_estado_reg" id="categoria_estado">
                                                    <option value="Habilitada" selected="">Habilitada</option>
                                                    <option value="Deshabilitada">Deshabilitada</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group bmd-form-group">
                                                <label for="categoria_ubicacion">Pasillo o ubicación de la categoría &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,80}" class="form-control" name="categoria_ubicacion_reg" id="categoria_ubicacion" maxlength="80">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <p class="text-center" style="margin-top: 40px;">
                                <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
                                &nbsp; &nbsp;
                                <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                            </p>
                            <p class="text-center">
                                <small>Los campos marcados con &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp; son obligatorios</small>
                            </p>
                            <div class="RespuestaAjax"></div>
                    </form>

                </div>
            </div>
        </div>
  
    </div>
    <!-- Content Fila -->