<?php
    session_start();

    if ($_SESSION['rol'] != 1) {
        header("Location: usuario.php");
        exit();
    }

    require '../model/datos.php';

    if(!isset($_GET['resultado'])){
         exit;
    }
    $id=$_GET['resultado'];

    $s=traerP($id);

    $datos = mysqli_fetch_assoc($s);
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
                        <a class="nav-link dropdown-toggle" href="#login.html"><i class="bi bi-person-fill"></i> Admin</a>
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

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Resultados médicos</h4>
                    </div>
                    <div class="card-body">
                        <form action="../Controller/resultado.examenes.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $datos['id'];?>">
                            <div class="form-group">
                                <label for="nombre">Nombre completo</label>
                                <input type="text" class="form-control" readonly name="nombre" value="<?php echo $datos['nombre'];?> <?php echo $datos['apellido'];?>">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Documento</label>
                                <input type="text" class="form-control" readonly value="<?php echo $datos['tipo_documento'];?>. <?php echo $datos['documento'];?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Resultado </label>
                                <input type="number" class="form-control" name="resultado" placeholder="Resultado" required>
                            </div>
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <input type="button" class="btn btn-light" value="Volver" onClick="history.go(-1);">
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
