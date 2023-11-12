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
    <link rel="stylesheet" href="../../assets/styles/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png" />
    <link rel="stylesheet" href="ruta_a_bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <title>Resultado médico</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../assets/img/favicon.png" width="60px" height="70px" class="navbar-brand" alt="">
                HemoHearth</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown mt-1">
                        <a class="nav-link dropdown-toggle" href="#login.html"><i class="bi bi-person-fill"></i>
                            Admin</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" href="../../controller/logout.php">Cerrar sesión</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  <div class="container mt-5">
     <h2 class="titulo-registro display-4 text-center mt-5 mb-4">Resultados médicos</h2>
  </div>

  <div class="container mt-5">
    <?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-<?php echo $_SESSION['alert_type']; ?>">
        <?php echo $_SESSION['mensaje']; ?>
    </div>
    <?php unset($_SESSION['mensaje']);
        unset($_SESSION['alert_type']); ?>
    <?php endif; ?>
    <table id="miTabla" class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Tipo documento</th>
          <th scope="col">Documento</th>
          <th scope="col">EPS</th>
          <th scope="col">Correo</th>
          <th scope="col">Resultado</th>
          <th></th>
        </tr>
      </thead>
      <?php
      $buscar = pacientes_resultados();
      while ($datos = mysqli_fetch_array($buscar)) {
            $id_paciente = $datos[0];
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
            <td>
                <a href="#" data-toggle="modal" data-target="#results_<?php echo $datos[0]; ?>">Añadir</a>
            </td>
            </th>
          </tr>
    

    <div class="modal fade" id="results_<?php echo $datos[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Resultados médicos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
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
            <div class="form-group">
                <label for="email">Resultado </label>
                <input type="number" class="form-control" name="resultado" value="<?php echo $datos[7]; ?>" required>
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>  
            <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
        </div>
    </div>
    </div>
    <?php } ?>
    </table>
  </div>
  <div class="mt-5"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="../../assets/scripts/bootstrap.min.js"></script>
    <script src="../../assets/scripts/submenu.js"></script>
    <script>
    $(document).ready(function() {
        $('#miTabla').DataTable();
    });
    </script>
</body>
</html>