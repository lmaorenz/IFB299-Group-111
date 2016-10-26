<?php
    session_start();
    if (!($_SESSION['isAdmin']))
    {
        header("Location: http://{$_SERVER['HTTP_HOST']}/Index.php");
        exit();
    }
?>