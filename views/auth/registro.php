<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../public/img/favicon.png" />
    <title>Registro | HemoHearth</title>
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../public/css/style.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <div class="row p-5 justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Registro</div>
                    <div class="card-body">
                        <?php foreach (['mensaje' => 'green', 'error' => 'red'] as $tipo => $color) {
                            if (isset($_SESSION[$tipo])) { echo "<p style='color:$color; text-align:center;'>{$_SESSION[$tipo]}</p>";
                                unset($_SESSION[$tipo]);}
                        }
                        ?>
                        <form id="registroFormulario" action="../../controllers/registro.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">Tipo de documento</label>
                                        <select name="td" class="form-select">
                                            <option value="CC">Cédula de Ciudadanía</option>
                                            <option value="CE">Cédula de Estranjería</option>
                                            <option value="TI">Tarjeta de Identidad</option>
                                            <option value="PP">Pasaporte</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label for="apellido" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="docu" class="form-label">Documento</label>
                                        <input type="number" class="form-control" name="documento" maxlength="10" placeholder="Documento" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label class="form-label">EPS</label>
                                <input type="text" class="form-control" name="eps" placeholder="EPS">
                            </div>
                            <div class="form-group mt-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="correo" placeholder="Email" required>
                            </div>
                            <div class="form-group mt-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="clave" minlength="8" title="Debe tener al menos 8 caracteres" placeholder="Contraseña" required>
                            </div>
                            <div class="form-group mt-3">
                                <small class="text-muted">¿Tienes alguno de estos sintomas?</small>
                                <select class="form-select" name="sint" multiple size="3">
                                    <?php
                                    require_once '../../models/datos.php';

                                    $patologias = Datos::patologia();
                                    
                                    if ($patologias && $patologias->num_rows > 0) {
                                        while ($patologia = $patologias->fetch_assoc()) {
                                            $nombre = htmlspecialchars($patologia['nombre']);
                                            echo "<option value=\"$nombre\">$nombre</option>";
                                        }
                                    } else {
                                        echo "<option value=\"\">No hay patologías registradas</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" id="enviar"
                                    class="btn btn-info text-white">Registrarse</button>
                            </div>
                            <p class="mt-3 text-muted">¿Ya tienes una cuenta? <a href="login.php" id="switchToRegister">Inicia sesión</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>