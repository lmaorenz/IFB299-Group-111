<?php
session_start();
			if ($_SESSION['isAdmin']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuAd.php"); 
				exit();
			}
			if ($_SESSION['isCollege']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuStu.php");
				exit();
			}
			if ($_SESSION['isVisitor']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuVis.php");
				exit();
			}
			if ($_SESSION['isPatrol']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuPo.php");
				exit();
			}
?>