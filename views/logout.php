<?php 

    session_start();

    unset($_SESSION['rol']);

    session_destroy();

    header('Location: login.php');

?>