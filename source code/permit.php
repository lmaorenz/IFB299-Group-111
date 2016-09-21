<?php
    if (isset($_POST['Submit']))
    {
		session_start();
	    // validate posted username and password here
		require 'submit.inc';	
		
		$firstname=$_POST['First'];
		$surname=$_POST['Last'];
		$email=$_POST['Email'];
		$mobile=$_POST['Mobile'];
		$start_date=$_POST['date'];
		$department=$_POST['Department'];
		$duration=$_POST['Duration'];
		$vehicle_type=$_POST['vehicle'];
		
		/**
		if(fail)
		{	
			header("Location: http://{$_SERVER['HTTP_HOST']}/permit.php?submitfail=true");
            exit();
		}
		else {**/
			//INPUT APPROPRIATE DATA
			permit($firstname, $surname, $email, $mobile, $start_date, $department, $duration, $vehicle_type);
			
			
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
                <form action="permit.php" method="post">
                    <h2>Name</h2>
                        <input type="text" name="First" placeholder="First"/>
                        <input type="text" name="Last" placeholder="Last"/>
                    <h2>Contact</h2>
                        <input type="text" name="Email" placeholder="Email"/>
                        <input type="text" name="Mobile" placeholder="Mobile"/>
                    <h2>Department</h2>
                        <select name="Department">
                            <option>Dpt of Astrology</option>
                            <option>Dpt of Science</option>
                            <option>Dpt of Time and Space</option>
                            <option>Dpt of Health and Safety</option>
                        </select>
					<h2>Vehicle Type</h2>
                        <select name="vehicle">
                            <option>Car</option>
                            <option>Bike</option>
                        </select>
                    <h2>Duration</h2>
                        <select name="Duration">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Daily</option>
                            <option>Hourly</option>
                        </select>
                    <h2>Start Date</h2>
                        <input type="date" name="date">
                    <br>
                    <input type="submit" name="Submit" value="Submit">
                </form>
                
            </div>
        </div>
    </body>
</html>