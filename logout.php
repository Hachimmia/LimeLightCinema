<?php

    session_start();
    if (isset($_SESSION['username']))
    {
        unset($_SESSION['username']);
    }

    if (isset($_SESSION['over18']))
    {
        unset($_SESSION['over18']);
    }

    header("location: index.php");
?>