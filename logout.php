<?php

    session_start();
    unset($_SESSION['user_login']);
    unset($_SESSION['username']);
    header('location:./');

?>
