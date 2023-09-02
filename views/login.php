<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../Img/favicon.png" />
    <title>Login</title>
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
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
                <img src="../Img/favicon.png" width="60px" height="70px" class="navbar-brand" alt="">
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
                <div>
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <form action="../controller/login.verificar.php" method="POST">
                                <div class="form-group">
                                    <label for="loginEmail">Correo electrónico</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control bg-light" name="email">
                                        <div class="input-group-append">
                                            <button class="input-group-text" disabled><i class="bi bi-envelope"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="loginPassword">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control bg-light" name="contrasena" id="contrasena">
                                        <div class="input-group-append">
                                            <button class="input-group-text" disabled><i class="bi bi-key"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="vercontrasena">
                                    <label for="VerPassword">¿Mostrar contraseña?</label>
                                </div>
                                <button type="submit" class="btn bg-info btn-block text-white">Iniciar sesión</button>
                                <p class="mt-3">¿No tienes una cuenta? <a href="registro.php" id="switchToRegister">Registrate aquí</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="../scripts/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    </script>
    <script>
        $(document).ready(function () {
            $('#vercontrasena').click(function () {
                if ($('#vercontrasena').is(':checked')) {
                    $('#contrasena').attr('type', 'text');
                } else {
                    $('#contrasena').attr('type', 'password');
                }
            });
        });
    </script>
</body>

</html>