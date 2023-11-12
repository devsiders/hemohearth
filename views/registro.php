<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Registro</title>
    <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="../assets/img/favicon.png" width="60px" height="70px" class="navbar-brand" alt="">
                HemoHearth</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php session_start(); if (isset($_SESSION['mensaje'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['alert_type']; ?>">
                        <?php echo $_SESSION['mensaje']; ?>
                    </div>
                    <?php unset($_SESSION['mensaje']);
                    unset($_SESSION['alert_type']); ?>
                <?php endif; ?>
                <div id="registroFormulario" class="hidden">
                    <div class="card">
                        <div class="card-header">Registro</div>
                        <div class="card-body">
                            <form id="registroFormulario" action="../controller/registrar.usuario.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control bg-light" name="nombre" placeholder="Nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tdd">Tipo de documento</label>
                                            <select name="td" class="form-control bg-light">
                                                <option value="CC">Cédula de Ciudadanía</option>
                                                <option value="CE">Cédula de Estranjería</option>
                                                <option value="TI">Tarjeta de Identidad</option>
                                                <option value="PP">Pasaporte</option>
                                            </select>
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellido">Apellido</label>
                                            <input type="text" class="form-control bg-light" name="apellido" placeholder="Apellido" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="docu">Número de documento</label>
                                            <input type="text" class="form-control bg-light" name="documento" placeholder="Documento" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="registroeps">EPS</label>
                                    <input type="text" class="form-control bg-light" name="eps" placeholder="Eps" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo electrónico</label>
                                    <input type="email" class="form-control bg-light" name="correo" placeholder="Correo electrónico" required>
                                </div>
                                <div class="form-group">
                                    <label for="clave">Contraseña</label>
                                    <input type="password" class="form-control bg-light" name="clave" placeholder="Contraseña" required>
                                </div>
                                <div class="form-group">
                                    <small class="col-10 form-text text-muted">Tiene alguno de estos sintomas</small>
                                    <select class="form-control" name="sint" multiple>
                                        <?php
                                        require '../model/datos.php';
                                        $buscar = patologia();
                                        while ($datos = mysqli_fetch_assoc($buscar)) {
                                            $datos['nombre'];
                                            foreach ($datos as $key => $value) { ?>
                                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" id="enviar"
                                    class="btn bg-info btn-block text-white">Registrarse</button>
                                <p class="mt-3">¿Ya tienes una cuenta? <a href="login.php" id="switchToLogin">Inicia sesión</a>
                                </p>
                            </form>
                            <div class="mt-3" id="mensaje"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="../assets/scripts/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>