<?php
    session_start();
    $_SESSION['isAdmin'] = false;
	$_SESSION['isCollege'] = false;
	$_SESSION['isVisitor'] = false;
	$_SESSION['isPatrol'] = false;
	$_SESSION['username'] = "";
	$_SESSION['surname'] = "";
	$_SESSION['firstname'] = "";
	session_unset(); 
	session_destroy(); 
?>