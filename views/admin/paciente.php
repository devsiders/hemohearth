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
  <title>Paciente | HemoHearth</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg p-0 navbar-light shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../../public/img/favicon.png" width="60px" height="60px" class="navbar-brand" alt="Logo">
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

  <main class="vh-100 mt-3">

    <div class="container">
      <div class="row align-items-center">
        <div class="col-sm-6 d-flex justify-content-start">
          <h3 class="mt-3 fs-5">Pacientes</h3>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Pacientes</a></li>
            <li class="breadcrumb-item">Resultados médicos</li>
          </ol>
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <div class="card">
        <div class="card-body">
          <?php foreach (['mensaje' => 'green', 'error' => 'red'] as $tipo => $color) {
              if (isset($_SESSION[$tipo])) { echo "<p style='color:$color;'>{$_SESSION[$tipo]}</p>";
                  unset($_SESSION[$tipo]);}
          }
          ?>
          <div class="table-responsive">
            <table id="miTabla" class="table table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Tipo documento</th>
                  <th>Documento</th>
                  <th>Resultado</th>
                  <th></th>
                </tr>
              </thead>
              <?php
                require_once '../../models/paciente.php';

                $pacientes = Paciente::pacientes();
                while ($paciente = mysqli_fetch_array($pacientes)) {
                  $id_paciente = $paciente[0];
                ?>
                  <tr>
                    <td><?php echo $paciente[1] ?></td>
                    <td><?php echo $paciente[2] ?></td>
                    <td><?php echo $paciente[3] ?></td>
                    <td><?php echo $paciente[4] ?></td>
                    <td><?php echo $paciente[7] ?></td>
                    <td>
                      <a href="#" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#results_<?php echo $paciente[0]; ?>"> <i class="bi bi-pencil-square"></i></a>
                    </td>
                  </tr>

                  <?php include '../partials/modal.php'; ?>

                <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div>

  </main>

  <footer class="mt-5 bg-light text-center fixed-bottom text-lg-start">
    <div class="text-center p-3">
      <p>&copy; 2023 HemoHearth. derechos reservados.</p>
    </div>
  </footer>

  <script src="../../public/js/bootstrap.bundle.min.js"></script>

</body>

</html>