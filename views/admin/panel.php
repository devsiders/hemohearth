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
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <title>Panel Administrativo</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg p-0 navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../../assets/img/favicon.png" width="60px" height="70px" class="d-inline-block" alt="Logo">
        HemoHearth</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-fill"></i> Admin
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../../controller/logout.php"><i class="bi bi-box-arrow-in-right"></i> Cerrar sesión</a></li>
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
        <p>Este es el panel administrativo de HemoHearth. Aquí puedes gestionar todos los datos y procesos de la clínica.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-header">
            <h5 class="card-title">Pacientes</h5>
          </div>
          <div class="card-body">
            <p>En esta sección puedes gestionar todos los datos de los pacientes de la clínica.</p>
            <a href="gstn.paciente.php" class="btn btn-outline-info">Ver pacientes</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-header">
            <h5 class="card-title">Resultados médicos</h5>
          </div>
          <div class="card-body">
            <p>En esta sección puedes subir los resultados médicos de los pacientes.</p>
            <a href="gstn.resultados.php" class="btn btn-outline-info">Ver resultados</a>
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