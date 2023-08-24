<?php
    session_start();

    if ($_SESSION['rol'] != 1) {
       header("Location: usuario.php");
       exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../Img/favicon.png"/>
    <link rel="stylesheet" href="ruta_a_bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>HemoHearth</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../Img/favicon.png" width="60px" height="70px" class="navbar-brand" alt="">
                HemoHearth</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown mt-1">
                        <a class="nav-link dropdown-toggle" href="#"><i class="bi bi-person-fill"></i> Admin</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li class="dropdown-submenu">
                              <a class="dropdown-item" href="../Controller/logout.php">Cerrar sesión</a>
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
        <?php unset($_SESSION['mensaje']); unset($_SESSION['alert_type']); ?>
    <?php endif; ?>
    <div class="row">
    <div class="col-md-6 offset-md-6">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Buscar">
        <div class="input-group-append">
          <button class="btn btn-dark" type="button"><i class="bi bi-search"></i></button>
        </div>
      </div>
      </div>
    </div><br>
      <table id="table" class="table table-bordered">
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
    <tbody>
    <tr>
      <th scope="col"><?php echo $datos[1]?></td>
      <th scope="col"><?php echo $datos[2]?></td>
      <th scope="col"><?php echo $datos[3]?></td>
      <th scope="col"><?php echo $datos[4]?></td>
      <th scope="col"><?php echo $datos[5]?></td>
      <th scope="col"><?php echo $datos[6]?></td>
      <th scope="col"><?php echo $datos[7]?></td>
          <th scope="col"><a class="btn btn-info" href="formulario.examenes.php?resultado=<?php echo $datos[0];?>"><i class="bi bi-file-medical"></i> Subir</a>
          </th>
    </tr>
      <?php
      }
    ?>
    </tbody>
    </table>

    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Anterior</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Siguiente</a>
        </li>
      </ul>
    </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="../scripts/bootstrap.min.js"></script>
    <script>
        const $dropdown = $(".dropdown");
        const $dropdownToggle = $(".dropdown-toggle");
        const $dropdownMenu = $(".dropdown-menu");
        const showClass = "show";
        
        $(window).on("load resize", function() {
          if (this.matchMedia("(min-width: 768px)").matches) {
            $dropdown.hover(
              function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
              },
              function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
              }
            );
          } else {
            $dropdown.off("mouseenter mouseleave");
          }
        });
      </script>
</body>
</html>
