<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../../public/img/favicon.png" />
  <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <title>HemoHearth</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg p-0 navbar-light shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../../public/img/favicon.png" width="60px" height="60px" class="d-inline-block" alt="Logo">
        HemoHearth</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-fill"></i> <?php echo $_SESSION['nombre']; ?>           
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../../controllers/logout.php"><i class="bi bi-box-arrow-in-right"></i> Cerrar sesión</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php
  require_once '../../models/paciente.php';

  $datos = null;

  if (isset($_SESSION['id_persona'])) {
    $datos = Paciente::traerP($_SESSION['id_persona']);
  }

  ?>

  <?php

    $alert = Paciente::resultados($_SESSION['id_persona']);

    $userID = null;

    if ($alert && $alert instanceof mysqli_result) {
        $userID = mysqli_fetch_array($alert);
    }

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

  ?>

  <?php if (!isset($_SESSION['alerta_mostrada']) && $alerta != ""): ?>
    <div class="container mt-4">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Atención:</strong> <?php echo $alerta; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    </div>
    <?php $_SESSION['alerta_mostrada'] = true; ?>
  <?php endif; ?>

  <main class="vh-100">
    <div class="container mt-5">
      <div class="border-0 shadow-sm p-5 text-center bg-light rounded">
        <h2 class="text-primary">¡Bienvenido, <?php echo $datos['nombre'] . ' ' . $datos['apellido']; ?>!</h2>
        <p class="lead text-muted">Nos alegra tenerte de vuelta en tu perfil.</p>
      </div>
    </div>
  </main>


  <footer class="bg-light mt-5 text-center sticky-footer">
    <div class="text-center p-3">
      <p>&copy; 2023 HemoHearth. derechos reservados.</p>
    </div>
  </footer>

  <script src="../../public/js/bootstrap.bundle.min.js"></script>

</body>

</html>