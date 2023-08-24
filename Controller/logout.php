<?php 

    session_start();

    unset($_SESSION['rol']);

    session_destroy();

    header('Location: ../Views/login.php');

?>