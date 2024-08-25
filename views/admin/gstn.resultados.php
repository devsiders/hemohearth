<?php
session_start();

if ($_SESSION['rol'] != 1) {
  header("Location: usuario.php");
  exit();
}

require '../../model/datos.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <title>Resultado médico</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../../assets/img/favicon.png" width="60px" height="70px" class="navbar-brand" alt="">
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

  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h3 class="mt-3 fs-5">Resultados médicos</h3>
      </div>
      <div class="col-sm-6 d-flex justify-content-end">
        <ol class="breadcrumb m-0 bg-light">
          <li class="breadcrumb-item"><a class="text-decoration-none" href="panel.php">Inicio</a></li>
          <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Resultados</a></li>
          <li class="breadcrumb-item">Resultados médicos</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <?php if (isset($_SESSION['mensaje'])): ?>
          <div class="alert w-50 alert-dismissible fade show alert-<?php echo $_SESSION['alert_type']; ?>">
            <?php echo $_SESSION['mensaje']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php unset($_SESSION['mensaje']);
          unset($_SESSION['alert_type']); ?>
        <?php endif; ?>
        <div class="table-responsive">
          <table id="miTabla" class="table table-striped">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Tipo documento</th>
                <th>Documento</th>
                <th>EPS</th>
                <th>Resultado</th>
                <th></th>
              </tr>
            </thead>
            <?php
            $buscar = pacientes_resultados();
            while ($datos = mysqli_fetch_array($buscar)) {
              $id_paciente = $datos[0];
            ?>
              <tr>
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
                <th>
                  <?php echo $datos[7] ?>
                  </td>
                <td>
                  <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#results_<?php echo $datos[0]; ?>">Añadir</a>
                </td>
                </th>
              </tr>


              <div class="modal fade" id="results_<?php echo $datos[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Resultados médicos</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="../../controller/resultado.examenes.php" method="POST" id="form_results_<?php echo $datos[0]; ?>">
                        <input type="hidden" name="id" value="<?php echo $datos[0]; ?>">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Nombre completo</label>
                          <input type="text" class="form-control" readonly name="nombre" value="<?php echo $datos[1] . ' ' . $datos[2]; ?>">
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Documento </label>
                          <input type="text" class="form-control" readonly value="<?php echo $datos[3] . ' ' . $datos[4]; ?>">
                        </div>
                        <div class="form-group mt-2">
                          <label for="email">Resultado </label>
                          <input type="number" class="form-control" name="resultado" value="<?php echo $datos[7]; ?>" required>
                        </div>
                        <div class="modal-footer mt-3">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </table>
        </div>
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