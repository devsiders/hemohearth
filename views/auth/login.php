<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../public/img/favicon.png" />
    <title>Login | HemoHearth</title>
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../public/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row p-5 justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>                   
                        <div class="card-body">
                        <?php foreach (['mensaje' => 'green', 'error' => 'red'] as $tipo => $color) {
                            if (isset($_SESSION[$tipo])) { echo "<p style='color:$color; text-align:center;'>{$_SESSION[$tipo]}</p>";
                                unset($_SESSION[$tipo]);}
                        }
                        ?> 
                        <form action="../../controllers/login.php" method="POST">
                            <div class="form-group mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required>
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-info text-white">Iniciar sesión</button>
                            </div>
                            <p class="mt-3 text-muted">¿No tienes una cuenta? <a href="registro.php" id="switchToRegister">Registrate aquí</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>