<?php require 'visitorPermission.inc'; ?> <!-- require permission functions -->
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
        <div id='nav'>
            <ul>
                <li><a href="index.php?home=true">Home</a></li>
                <li><a href="index.php?signout=true">Log Out</a></li>
            </ul>
        </div>
            <div id="container">
                <div class="menuSelectBox">
                    <h1><a href="permit.php">Request Permit</a></h1>
				</div>
				<div class="menuSelectBox">
					<h1><a href="readpermits.php">View Permits</a></h1>
				</div>
				<div class="menuSelectBox">
					<h1><a href="readviolation.php">View + Pay Violations</a></h1>
                </div>
            </div>
        </div>
    </body>
</html>