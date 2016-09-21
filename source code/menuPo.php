<?php require 'patrolPermission.inc'; ?>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Parking skeleon</title>
        <meta name="description" content="Index screen">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
	<?php 
        if (isset($_GET['submitsuccess'])){
			echo "<h1>Form submission successful</h1>";	
			}
		?>
        <div id="header">
            <img src="pics/logo.png" alt="Anchor parking and fine management">
        </div>
        <div id="container">
            <div class="menuSelectBox">
                <h1><a href="parking.php">Create New Parking Violation Report</a></h1>
            </div>
            <div class="menuSelectBox">
                <h1><a href="smoking.php">Create New Smoking or Other Violation Report</a></h1>
            </div>
			<!--
            <div class="menuSelectBox">
                <h1><a href="loadViolation.php">Access Violations</a></h1>
            </div> --->
			<a href="Index.php?signout=true">Logout<a/>
        </div>
    </body>
</html>