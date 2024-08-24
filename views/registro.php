<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>

<body>
    <div class="container mt-5">
        <div class="row p-5 justify-content-center">
            <div class="col-md-6">
            <?php if (isset($_SESSION['mensaje'])): ?>
                <div class="alert alert-<?php echo $_SESSION['alert_type']; ?>">
                    <?php echo $_SESSION['mensaje']; ?>
                </div>
                <?php unset($_SESSION['mensaje']);
                unset($_SESSION['alert_type']); ?>
            <?php endif; ?>
                <div id="registroFormulario">
                    <div class="card">
                        <div class="card-header">Registro</div>
                        <div class="card-body">
                            <form id="registroFormulario" action="../controller/registrar.usuario.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control bg-light" name="nombre" value="<?php if (isset($_POST['nombre'])){ echo $_POST['nombre']; } ?>" placeholder="Nombre" required>
                                        </div>
                                        <div class="form-group mt-3">
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
                                        <div class="form-group mt-3">
                                            <label for="apellido">Apellido</label>
                                            <input type="text" class="form-control bg-light" name="apellido" placeholder="Apellido" value="<?php if (isset($_POST['apellido'])) { echo $_POST['apellido']; } ?>" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="docu">Número de documento</label>
                                            <input type="text" class="form-control bg-light" name="documento" placeholder="Documento" <?php echo isset($_POST['documento']) ? htmlspecialchars($_POST['documento']) : ''; ?> required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="registroeps">EPS</label>
                                    <input type="text" class="form-control bg-light" name="eps" placeholder="Eps" value="<?php if (isset($_POST['eps'])) { echo $_POST['eps']; } ?>" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="email">Correo electrónico</label>
                                    <input type="email" class="form-control bg-light" name="correo" placeholder="Correo electrónico" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="clave">Contraseña</label>
                                    <input type="password" class="form-control bg-light" name="clave" placeholder="Contraseña" required>
                                </div>
                                <div class="form-group mt-3">
                                    <small class="text-muted">¿Tienes alguno de estos sintomas?</small>
                                    <select class="form-control" name="sint" multiple>
                                        <?php
                                        require '../model/datos.php';
                                        $buscar = patologia();
                                        while ($datos = mysqli_fetch_assoc($buscar)) {
                                            $nombrePatologia = $datos['nombre'];
                                            ?>
                                            <option value="<?php echo $nombrePatologia; ?>" 
                                                <?php echo (isset($_POST['sint']) && in_array($nombrePatologia, $_POST['sint'])) ? 'selected' : ''; ?>>
                                                <?php echo $nombrePatologia; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="d-grid mt-3">
                                    <button type="submit" id="enviar"
                                    class="btn bg-info btn-block text-white">Registrarse</button>
                                </div>
                                <p class="mt-3">¿Ya tienes una cuenta? <a href="login.php" class="text-decoration-none" id="switchToLogin">Inicia sesión</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5"></div>
    <footer class="mt-5 bg-light text-center sticky-footer" style="background-color: #efd4d4;">
        <div class="text-center p-3" style="background-color: rgba(241, 237, 237, 0.894);">
             <p>&copy; 2023 HemoHearth. derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>