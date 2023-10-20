<?php
session_start();

if ($_SESSION['rol'] != 1) {
    header("Location: usuario.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
  <link rel="stylesheet" href="ruta_a_bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Panel Administrativo</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../assets/img/favicon.png" width="60px" height="70px" class="navbar-brand" alt="">
        HemoHearth</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown mt-1">
            <a class="nav-link dropdown-toggle" href="#"><i class="fa fa-user"></i> Admin</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li class="dropdown-submenu">
                <a class="dropdown-item" href="../controller/logout.php">Cerrar sesión</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <h1>Panel administrativo</h1>
        <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?php echo $_SESSION['alert_type']; ?>">
        <?php echo $_SESSION['mensaje']; ?>
        </div>
        <?php unset($_SESSION['mensaje']);
        unset($_SESSION['alert_type']); ?>
        <?php endif; ?>
        <p>Este es el panel administrativo de HemoHearth. Aquí puedes gestionar todos los datos y procesos de la clínica.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Pacientes</h5>
          </div>
          <div class="card-body">
            <p>En esta sección puedes gestionar todos los datos de los pacientes de la clínica.</p>
            <a href="admin.php" class="btn btn-dark">Ver pacientes</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Médicos</h5>
          </div>
          <div class="card-body">
            <p>En esta sección puedes gestionar todos los datos de los médicos de la clínica.</p>
            <a href="#" class="btn btn-dark">Ver médicos</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Citas</h5>
            </div>
            <div class="card-body">
            <p>En esta sección de citas te brinda la capacidad de gestionar las citas de los pacientes.</p>
            <a href="#" class="btn btn-dark">Ver citas</a>
            </div>
        </div>
        <div class="row">
        <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Resultados médicos</h5>
          </div>
          <div class="card-body">
            <p>En esta sección puedes subir los resultados médicos de los pacientes.</p>
            <a href="#" class="btn btn-dark">Ver resultados</a>
          </div>
        </div>
        </div>
      </div>
          <div class="mt-5"></div>
    </div>
    </div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="../assets/scripts/bootstrap.min.js"></script>
<script src="../assets/scripts/submenu.js"></script>

</body>

</html>
