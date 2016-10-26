<?php
    session_start();
    if (!($_SESSION['isCollege']))
    {
        header("Location: http://{$_SERVER['HTTP_HOST']}/Index.php");
        exit();
    }
?>