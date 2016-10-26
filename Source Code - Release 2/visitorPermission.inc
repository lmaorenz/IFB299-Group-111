<?php
    session_start();
    if (!($_SESSION['isVisitor']))
    {
        header("Location: http://{$_SERVER['HTTP_HOST']}/Index.php");
        exit();
    }
?>