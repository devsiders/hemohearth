<?php
session_start();

if ($_SESSION['rol'] != 1) {
  header("Location: usuario.php");
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
  <title>Pacientes</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: rgba(241, 237, 237, 0.894);">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../../assets/img/favicon.png" width="60px" height="70px" class="d-inline-block" alt="Logo">
        HemoHearth</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
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

  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h3 class="mt-3 fs-5">Pacientes</h3>
      </div>
      <div class="col-sm-6 d-flex justify-content-end">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="text-decoration-none" href="panel.php">Inicio</a></li>
          <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Pacientes</a></li>
          <li class="breadcrumb-item">Gestión de Pacientes</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <table id="miTabla" class="table table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Tipo documento</th>
              <th>Documento</th>
              <th>EPS</th>
              <th>Correo</th>
            </tr>
          </thead>
          <tfoot>
            <?php
            require '../../model/datos.php';
            $buscar = leerPacientes();
            while ($datos = mysqli_fetch_array($buscar)) {
            ?>
              <tr>
                <th>
                  <?php echo $datos[0] ?>
                  </td>
                <th>
                  <?php echo $datos[1] ?>
                  </td>
                <th>
                  <?php echo $datos[2] ?>
                  </td>
                <th>
                  <?php echo $datos[3] ?>
                  </td>
                <th>
                  <?php echo $datos[4] ?>
                  </td>
                <th>
                  <?php echo $datos[5] ?>
                  </td>
              </tr>
            <?php } ?>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

  <footer class="mt-5 bg-light text-center fixed-bottom text-lg-start" style="background-color: #efd4d4;">
    <div class="text-center p-3" style="background-color: rgba(241, 237, 237, 0.894);">
      <p>&copy; 2023 HemoHearth. derechos reservados.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>