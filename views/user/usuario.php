<?php
session_start();

if (!isset($_SESSION['rol'])) {
     exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <title>HemoHearth</title>
</head>

<body class="d-flex flex-column min-vh-100">
  <nav class="navbar navbar-expand-lg p-0 navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../../assets/img/favicon.png" width="60px" height="70px" class="d-inline-block" alt="Logo">
        HemoHearth</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-fill"></i> Perfil           
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../../controller/logout.php"><i class="bi bi-box-arrow-in-right"></i> Cerrar sesión</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php
  require '../../model/datos.php';

  if (isset($_SESSION['id_persona'])) {
    $id = $_SESSION['id_persona'];
    $buscar = traerP($id);

    while ($datos = mysqli_fetch_assoc($buscar)) {
      $id = $datos['id'];
      $nombre = $datos['nombre'];
      $apellido = $datos['apellido'];
      $td = $datos['tipo_documento'];
      $documento = $datos['documento'];
      $eps = $datos['eps'];
      $email = $datos['email'];

    }
  }

  ?>
  <main class="flex-fill">
    <div class="container mt-5">
      <form class="border shadow p-3" action="#">
        <h3 class="text-center text-info mt-2 mb-4">Datos personales</h3>
        <?php if (isset($_SESSION['mensaje'])): ?>
          <div class="alert w-50 alert-<?php echo $_SESSION['alert_type']; ?>">
            <?php echo $_SESSION['mensaje']; ?>
          </div>
          <?php unset($_SESSION['mensaje']);
          unset($_SESSION['alert_type']); ?>
        <?php endif; ?>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" readonly value="<?php echo $nombre; ?>">
            </div>
            <div class="form-group">
              <label for="documento">Tipo de Documento</label>
              <input type="text" class="form-control" readonly value="<?php echo $td; ?>">
            </div>
          </div>
          <div class="col-md-3">
          <div class="form-group">
              <label for="nombre">Apellido</label>
              <input type="text" class="form-control" readonly value="<?php echo $apellido; ?>">
            </div>
            <div class="form-group">
              <label for="documento">Documento</label>
              <input type="text" class="form-control" readonly value="<?php echo $documento; ?>">
            </div>
          </div>
          <div class="col-md-4">
          <div class="form-group">
              <label for="eps">EPS</label>
              <input type="text" class="form-control" readonly value="<?php echo $eps; ?>">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="email">Correo electrónico</label>
              <input type="text" class="form-control" readonly value="<?php echo $email; ?>">
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>

  <?php
  $alert = resultados($id);

  $userID = mysqli_fetch_array($alert);

  $alerta = "";

  if ($userID) {
    // Recomendaciones que se le dan al usuario dependiendo de su resultado.
    if ($userID['resultado'] >= 7.0 && $userID['resultado'] <= 13.8) {
      $alerta = "Indicar glucemia en ayunas y TGP en pacientes sin diagnóstico.- Si deshidratación, rehidratación oral o EV según las demandas.- Reevaluar conducta terapéutica en diabéticos y cumplimiento de los pilares.- Reevaluar dosis de hipoglucemiantes.";
    } elseif ($userID['resultado'] >= 13.8) {
      $alerta = "Coordinar traslado y comenzar tratamiento.- Hidratación con Solución salina 40 ml/Kg en las primeras 4 horas. 1-2 L la primera hora.- Administrar potasio al restituirse la diuresis o signos dhipopotasemia (depresión del ST, Onda U ≤ 1mv, ondas U≤ T).- Evitar insulina hasta desaparecer signos de hipopotasemia.- Administrar insulina simple 0,1 U/kg EV después de hidratar.";
    } elseif ($userID['resultado'] > 33) {
      $alerta = "Coordinar traslado y comenzar tratamiento.- Hidratación con Solución Salina 10-15 ml/Kg/h hasta conseguir estabilidad hemodinámica.- Administrar potasio al restituirse la diuresis o signos de hipopotasemia (depresión del ST, Onda U ≤ 1mv, ondas U≤ T).";
    }
  }

  // Llamado de la alerta al usuario. 
  if (!isset($_SESSION['alerta_mostrada']) && $alerta != "") {
    echo '<script>
            alert("' . $alerta . '");
          </script>';

    // Marcar que la alerta ha sido mostrada
    $_SESSION['alerta_mostrada'] = true;
  }

  ?>

  <div class="mt-5"></div>

  <footer class="bg-light mt-5 text-center sticky-footer" style="background-color: #efd4d4;">
    <div class="text-center p-3" style="background-color: rgba(241, 237, 237, 0.894);">
      <p>&copy; 2023 HemoHearth. derechos reservados.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>