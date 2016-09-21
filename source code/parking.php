<?php
    if (isset($_POST['Submit']))
    {
		session_start();
	    // validate posted username and password here
		require 'submit.inc';	
		
		$time=$_POST['time'];
		$date=$_POST['date'];
		$violation_type=$_POST['violation'];
		$description=$_POST['desc'];
		$vehicle_type=$_POST['vehicle'];
		$license=$_POST['license'];
		$permit=$_POST['permit'];
		$permit_id=$_POST['permID'];
		/**
		if(fail)
		{	
			header("Location: http://{$_SERVER['HTTP_HOST']}/parking.php?submitfail=true");
            exit();
		}
		else {**/
			//INPUT APPROPRIATE DATA
			parking($time, $date, $violation_type, $description, $vehicle_type, $license, $permit, $permit_id);
			
			
			//REROUTE TO APPROPRIATE HOME
			if ($_SESSION['isAdmin']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuAd.php?submitsuccess=true"); 
				exit();
			}
			if ($_SESSION['isCollege']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuStu.php?submitsuccess=true");
				exit();
			}
			if ($_SESSION['isVisitor']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuVis.php?submitsuccess=true");
				exit();
			}
			if ($_SESSION['isPatrol']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuPo.php?submitsuccess=true");
				exit();
			}
		//}
    }
?>
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
        if (isset($_GET['submitfail'])){
			echo "<h1>Form submission failed</h1>";	
			}
		?>
        <div id="header">
            <img src="pics/logo.png" alt="Anchor parking and fine management"></image>
        </div>
        <div id="container">
            <div id="body">
			<h1>Parking Violation</h1>
                <form action="parking.php" method="post">
                    <h2>Time and Date</h2>
                        <input type="text" name="time">
                        <input type="date" name="date">
					<h2>Violation Type</h2>
                        <select name="violation">
                            <option>Parking</option>
						</select>
					<h2>Description</h2>
                        <textarea row="8" cols="50" name="desc"></textarea>
                    <br>
                    <h2>Vehicle Type</h2>
                        <select name="vehicle">
                            <option>Car</option>
                            <option>Bike</option>
                        </select>
                    <h2>License Plate</h2>
                        <input type="text" name="license" placeholder="###"/>
                    <h2>Valid Permit?</h2>
                        <input type="radio" name="permit" value="yes"> Yes<br>
                        <input type="radio" name="permit" value="no"> No<br>
                    <h2>Permit ID number</h2>
                        <input type="text" name="permID">		
				   <br>
                    <input type="submit" name="Submit" value="Submit">
                </form>  
            </div>
        </div>
    </body>
</html>