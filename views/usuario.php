<?php
    session_start();

    if(!isset($_SESSION['rol'])){
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../Img/favicon.png"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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
                        <a class="nav-link dropdown-toggle" href="#login.html"><i class="bi bi-person-fill"></i> Perfil</a>
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
  <?php
  require '../Model/datos.php';

  if (isset($_SESSION['id_persona'])) {
    $id = $_SESSION['id_persona'];
    $buscar = traerP($id);

    while ($datos = mysqli_fetch_assoc($buscar)) {
      $id = $datos['id'];
      $nombre = $datos['nombre'];
      $apellido = $datos['apellido'];
      $td = $datos['tipo_documento'];
      $documento = $datos['documento'];
      $eps = $datos['eps'];
      $email = $datos['email'];
      
  }
  }
  
  ?>
    <div class="container mt-5">
      <form class="" action="#">
         <h2 class="titulo-registro display-4 text-center mt-5 mb-4">Datos personales</h2>
      <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?php echo $_SESSION['alert_type']; ?>">
            <?php echo $_SESSION['mensaje']; ?>
        </div>
         <?php unset($_SESSION['mensaje']); unset($_SESSION['alert_type']); ?>
      <?php endif; ?>
      <div class="form-group row">
        <label class="col-2 col-form-label" minlength="3" for="nombre">Nombre completo </label>
        <?php echo $nombre; ?> <?php echo $apellido; ?>
      </div>

      <div class="form-group row">
        <label class="col-2 col-form-label" minlength="3" for="nombre">Documento </label>
        <?php echo $td; ?>. <?php echo $documento; ?>
      </div>

      <div class="form-group row">
        <label class="col-2 col-form-label" minlength="3" for="nombre">EPS </label>
        <?php echo $eps; ?>
      </div>

      <div class="form-group row">
        <label class="col-2 col-form-label" minlength="3" for="nombre">Correo electrónico </label>
        <?php echo $email; ?>
      </div>
    </form>
    </div>

    <?php
      $alert = resultados($id);

      $userID = mysqli_fetch_array($alert);

      $alerta = "";

      if ($userID) {
        // Recomendaciones que se le dan al usuario dependiendo de su resultado.
        if ($userID['resultado'] >= 7.0 && $userID['resultado'] <= 13.8) {
            $alerta = "Indicar glucemia en ayunas y TGP en pacientes sin diagnóstico.- Si deshidratación, rehidratación oral o EV según las demandas.- Reevaluar conducta terapéutica en diabéticos y cumplimiento de los pilares.- Reevaluar dosis de hipoglucemiantes.";
        } elseif ($userID['resultado'] >= 13.8) {
            $alerta = "Coordinar traslado y comenzar tratamiento.- Hidratación con Solución salina 40 ml/Kg en las primeras 4 horas. 1-2 L la primera hora.- Administrar potasio al restituirse la diuresis o signos dhipopotasemia (depresión del ST, Onda U ≤ 1mv, ondas U≤ T).- Evitar insulina hasta desaparecer signos de hipopotasemia.- Administrar insulina simple 0,1 U/kg EV después de hidratar.";
        } elseif ($userID['resultado'] > 33) {
            $alerta = "Coordinar traslado y comenzar tratamiento.- Hidratación con Solución Salina 10-15 ml/Kg/h hasta conseguir estabilidad hemodinámica.- Administrar potasio al restituirse la diuresis o signos de hipopotasemia (depresión del ST, Onda U ≤ 1mv, ondas U≤ T).";
        } 
      }  
    
        // Llamado de la alerta al usuario. 
        if ($alerta != "") {
            echo '<script>
              alert("'.$alerta.'");
            </script>';
        }
      
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="../Scripts/bootstrap.min.js"></script>
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