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
  <link rel="stylesheet" href="../styles/bootstrap.min.css">
  <link rel="icon" type="image/png" href="../Img/favicon.png" />
  <link rel="stylesheet" href="ruta_a_bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
  <title>HemoHearth</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../Img/favicon.png" width="60px" height="70px" class="navbar-brand" alt="">
        HemoHearth</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown mt-1">
            <a class="nav-link dropdown-toggle" href="#"><i class="bi bi-person-fill"></i> Admin</a>
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
    <h2 class="titulo-registro display-4 text-center mt-5 mb-4">Gestión de Pacientes</h2>
  </div>

  <div class="container mt-5">
    <?php if (isset($_SESSION['mensaje'])): ?>
      <div class="alert alert-<?php echo $_SESSION['alert_type']; ?>">
        <?php echo $_SESSION['mensaje']; ?>
      </div>
      <?php unset($_SESSION['mensaje']);
      unset($_SESSION['alert_type']); ?>
    <?php endif; ?>
    <table class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Tipo documento</th>
          <th scope="col">Documento</th>
          <th scope="col">EPS</th>
          <th scope="col">Correo</th>
          <th scope="col">Resultado</th>
          <th>
        </tr>
      </thead>
      <?php
      require '../model/datos.php';
      $buscar = pacientes();
      while ($datos = mysqli_fetch_array($buscar)) {
        ?>
          <tr>
            <th scope="col">
              <?php echo $datos[1] ?>
              </td>
            <th scope="col">
              <?php echo $datos[2] ?>
              </td>
            <th scope="col">
              <?php echo $datos[3] ?>
              </td>
            <th scope="col">
              <?php echo $datos[4] ?>
              </td>
            <th scope="col">
              <?php echo $datos[5] ?>
              </td>
            <th scope="col">
              <?php echo $datos[6] ?>
              </td>
            <th scope="col">
              <?php echo $datos[7] ?>
              </td>
            <th scope="col"><a class="btn btn-dark" href="formulario.examenes.php?resultado=<?php echo $datos[0]; ?>"><i
                  class="bi bi-file-medical"></i></a>
            </th>
          </tr>
      <?php } ?>
    </table>
  </div>
  <div class="mt-5"></div>

  <footer class="bg-light text-center text-lg-start" style="background-color: #efd4d4;">
        <div class="text-center p-3" style="background-color: rgba(241, 237, 237, 0.894);">
             <p>&copy; 2023 HemoHearth. derechos reservados.</p>
        </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="../scripts/bootstrap.min.js"></script>
  <script src="../scripts/submenu.js"></script>
</body>
</html>