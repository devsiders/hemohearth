<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row p-5 justify-content-center">
            <div class="col-md-6">
                <?php session_start(); if (isset($_SESSION['mensaje'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['alert_type']; ?>">
                        <?php echo $_SESSION['mensaje']; ?>
                    </div>
                    <?php unset($_SESSION['mensaje']);
                    unset($_SESSION['alert_type']); ?>
                <?php endif; ?>
                <div>
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <form action="../controller/login.verificar.php" method="POST">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control bg-light" name="email" id="email" placeholder="Correo electrónico">
                                        <div class="input-group-append">
                                            <button class="input-group-text" disabled><i class="bi bi-envelope"></i></button>
                                        </div>
                                    </div>
                                    </label>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="password">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control bg-light" name="contrasena" id="password" placeholder="Contraseña">
                                        <div class="input-group-append">
                                            <button class="input-group-text" disabled><i class="bi bi-key"></i></button>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn bg-info mt-3 text-white">Iniciar sesión</button>
                                </div>
                                <p class="mt-3">¿No tienes una cuenta? <a href="registro.php" class="text-decoration-none" id="switchToRegister">Registrate aquí</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5"></div>
    <footer class="mt-5 bg-light text-center fixed-bottom text-lg-start" style="background-color: #efd4d4;">
        <div class="text-center p-3" style="background-color: rgba(241, 237, 237, 0.894);">
             <p>&copy; 2023 HemoHearth. derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>