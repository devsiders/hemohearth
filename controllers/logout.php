<?php 

    session_start();

    session_destroy();

    header('Location: /hemohearth/views/auth/login.php');

    exit();

?>