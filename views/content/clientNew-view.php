          <!-- Cabecera de página-->
          <div class="m-2">
            <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-users"></i> &nbsp; Clientes</h1>
            <p class="text-gray-700 mb-4 text-justify">En el módulo CLIENTES podrá registrar en el sistema los datos de sus clientes más frecuentes para realizar ventas, además podrá realizar búsquedas de clientes, actualizar datos de sus clientes o eliminarlos si así lo desea.</p>
          </div>

          <!-- Opciones -->
          <div class="lista-opciones">
              <div class="opcion">
                    <a href="#" class="text-gray-700 activo h5"><i class="fas fa-users"></i> &nbsp; Nuevo</a>
              </div>
              <div class="opcion">
                    <a href="#" class="text-gray-700 h5"><i class="fas fa-list"></i> &nbsp; Lista</a>
              </div>
              <div class="opcion">
                    <a href="#" class="text-gray-700 h5"><i class="fas fa-search"></i> &nbsp; Buscar</a>
              </div>
          </div>
          <!-- Opciones -->

          <!-- Content Fila -->
          <div class="row">

            <!-- Nuevo Categoria -->
            <div class="col-lg-12">
                <div class="card shadow mb-5">
                    <div class="card-body">
                    <form class="form-neon FormularioAjax" action="" method="POST" data-form="save" autocomplete="off">
                        <fieldset>
                            <legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="cliente_tipo_documento" class="bmd-label-floating">Tipo de documento &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <select class="form-control" name="cliente_tipo_documento_reg" id="cliente_tipo_documento">
                                                <option value="" selected="">Seleccione una opción</option>
                                                <option value="DUI">1 - DUI</option>
                                                <option value="DNI">2 - DNI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="cliente_numero_documento" class="bmd-label-floating">Numero de documento &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-9-]{7,15}" class="form-control" name="cliente_numero_documento_reg" id="cliente_numero_documento" maxlength="15">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="cliente_nombre" class="bmd-label-floating">Nombres &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,40}" class="form-control" name="cliente_nombre_reg" id="cliente_nombre" maxlength="40">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="cliente_apellido" class="bmd-label-floating">Apellidos &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,50}" class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend><i class="fas fa-map-marked-alt"></i> &nbsp; Información de residencia</legend>
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group bmd-form-group">
                                            <label for="cliente_direccion" class="bmd-label-floating">Calle o dirección de casa &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,50}" class="form-control" name="cliente_direccion_reg" id="cliente_direccion" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset>
                            <legend><i class="far fa-address-book"></i> &nbsp; Información de contacto</legend>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="cliente_telefono" class="bmd-label-floating">Teléfono &nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;</label>
                                            <input type="text" pattern="[0-9()+]{8,9}" class="form-control" name="cliente_telefono_reg" id="cliente_telefono" maxlength="9">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label for="cliente_email" class="bmd-label-floating">Email</label>
                                            <input type="email" class="form-control" name="cliente_email_reg" id="cliente_email" maxlength="50">
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
                    </form>
                    </div>
                </div>
            </div>
  
          </div>
          <!-- Content Fila -->