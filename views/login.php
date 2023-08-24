<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../Img/favicon.png"/>
    <title>HemoHearth</title>
    <link rel="stylesheet" href="../Styles/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="../Img/favicon.png" width="60px" height="70px" class="navbar-brand" alt="">
                HemoHearth</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div id="loginFormulario">
                        <div class="card">
                            <div class="card-header">Login</div>
                            <div class="card-body">
                                <form id="loginFormulario" action="../Controller/login.verificar.php" method="POST">
                                    <div class="form-group">
                                        <label for="loginEmail">Correo electrónico</label>
                                        <input type="email" class="form-control" name="email" placeholder="Correo electrónico" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="loginPassword">Contraseña</label>
                                        <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="vercontrasena">
                                        <label for="VerPassword">¿Mostrar contraseña?</label>
                                    </div>
                                    <button type="submit" class="btn bg-info btn-block text-white">Iniciar sesión</button>
                                    <p class="mt-3">¿No tienes una cuenta? <a href="#" id="switchToRegister">Registrate aquí</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                        <?php if (isset($_SESSION['mensaje'])): ?>
                        <div class="alert alert-<?php echo $_SESSION['alert_type']; ?>">
                            <?php echo $_SESSION['mensaje']; ?>
                        </div>
                        <?php unset($_SESSION['mensaje']); unset($_SESSION['alert_type']); ?>
                    <?php endif; ?>
                    <div id="registroFormulario" class="hidden">
                        <div class="card">
                            <div class="card-header">Registro</div>
                            <div class="card-body">
                                <form id="registroFormulario" action="../Controller/registrar.usuario.php" method="POST">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tdd">Tipo de documento</label>
                                        <input type="text" class="form-control" name="td" placeholder="CC, CE, PA, LM" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="docu">Número de documento</label>
                                        <input type="text" class="form-control" name="documento" placeholder="Documento" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="registroeps">Eps</label>
                                        <input type="text" class="form-control" name="eps" placeholder="EPS" required>
                                    </div> 
                                    <div class="form-group">
                                        <label for="email">Correo electrónico</label>
                                        <input type="email" class="form-control" name="correo" placeholder="Correo electrónico" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="clave">Contraseña</label>
                                        <input type="password" class="form-control" name="clave" placeholder="Contraseña" required>
                                    </div>
                                    <div class="form-group">
                                    <small class="col-10 form-text text-muted">Tiene alguno de estos sintomas</small>
                                        <select class="form-control" name="sint" multiple>
                                        <?php
                                           require '../model/datos.php';
                                           $buscar = patologia();
                                           while ($datos = mysqli_fetch_assoc($buscar)) {
                                             $datos['nombre'];
                                             foreach ($datos as $key => $value) {?>
                                             <option value="<?php echo $value;?>"><?php echo $value;?></option>
                                             <?php
                                              }
                                               }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" id="enviar" class="btn bg-info btn-block text-white">Registrarse</button>
                                    <p class="mt-3">¿Ya tienes una cuenta? <a href="#" id="switchToLogin">Inicia sesión</a></p>
                                </form>
                                <div class="mt-3" id="mensaje"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
        <script src="../Scripts/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            const loginForm = document.getElementById('loginFormulario');
            const registerForm = document.getElementById('registroFormulario');
            const switchToRegister = document.getElementById('switchToRegister');
            const switchToLogin = document.getElementById('switchToLogin');
    
            switchToRegister.addEventListener('click', () => {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
            });
    
            switchToLogin.addEventListener('click', () => {
                registerForm.classList.add('hidden');
                loginForm.classList.remove('hidden');
            });
        </script>
        <script>
            $(".multiple-select").select2({
               //maximumSelectionLength: 2
            });
        </script>
</body>
</html>
