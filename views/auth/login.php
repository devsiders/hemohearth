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
                        <?php foreach (['mensaje' => 'green', 'error' => 'red'] as $tipo => $color) {
                            if (isset($_SESSION[$tipo])) { echo "<p style='color:$color;'>{$_SESSION[$tipo]}</p>";
                                unset($_SESSION[$tipo]);}
                        }
                        ?>                    
                        <div class="card-body">
                        <form action="../../controllers/login.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" name="contrasena" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Contraseña</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info">Iniciar sesión</button>
                            </div>
                            <p class="mt-3">¿No tienes una cuenta? <a href="registro.php" id="switchToRegister">Registrate aquí</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>