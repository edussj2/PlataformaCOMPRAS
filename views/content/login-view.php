<div class="bg-gradient-primary cuerpo">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12 d-flex justify-content-center align-items-center">
                <div class="p-5 w-100 contenedor-login">
                  <div class="text-center">
                    <div class="icono m-1 p-1">
                      <i class="fas fa-tools text-gray-900 mb-2" style="font-size: 5rem;"></i>
                    </div>
                    <h1 class="h3 text-gray-900 mb-4 text-login">Sistema Pernos & Pernos</h1>
                  </div>
                  <form class="user" action="" method="POST" autocomplete="off">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="exampleInputUsurio" placeholder="Usuario" name="usuario" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputContraseña" placeholder="Contraseña" name="clave" required>
                    </div>
                    <input type="submit" value="Iniciar" class="btn btn-primary btn-user btn-block">
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="#">¿Olvidaste tu contraseña?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</div>
<?php
	if (isset($_POST['usuario']) && isset($_POST['clave'])) {
		require_once "./controllers/loginControlador.php";
		$login = new loginControlador();

		echo $login->iniciar_sesion_controlador();
	}
?>