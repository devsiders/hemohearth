<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
  header("Location: ./perfil/index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../../public/img/favicon.png" />
  <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <title>Dashboard</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg p-0 navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../public/img/favicon.png" width="60px" height="70px" class="d-inline-block" alt="Logo">
        HemoHearth</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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


  <div class="container mt-5 min-vh-100">
    <div class="row">
      <div class="col-md-12">
        <h1>Dashboard</h1>
        <p>Este es el dashboard de HemoHearth. Aquí puedes gestionar todos los datos y procesos de la clínica.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-header">
            <h5 class="card-title">Resultados médicos</h5>
          </div>
          <div class="card-body">
            <p>En esta sección puedes subir los resultados médicos de los pacientes.</p>
            <a href="paciente.php" class="btn btn-info">Ver resultados</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>


  <footer class="mt-5 bg-light text-center sticky-footer">
    <div class="text-center p-3">
      <p>&copy; 2023 HemoHearth. derechos reservados.</p>
    </div>
  </footer>

  
  <script src="../../public/js/bootstrap.bundle.min.js"></script>
</body>

</html>