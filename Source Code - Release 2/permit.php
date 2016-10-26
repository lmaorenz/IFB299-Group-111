<?php
    if (isset($_POST['Submit']))
    {
		session_start();
	    // validate posted username and password here
		require 'submit.inc';	
		
		$firstname=$_SESSION['firstname'];
		$surname=$_SESSION['surname']; 
		$email=$_SESSION['email'];
		$mobile=$_SESSION['mobile'];
		$start_date=$_POST['date'];
		$department=$_POST['Department'];
		$duration=$_POST['Duration'];
		$vehicle_type=$_POST['vehicle'];
				
		$time_original = strtotime($start_date);
				
		//calculate end_date
		if ($duration == "Yearly"){
			$time_add      = $time_original + (86400*365); //add seconds 
			$end_date      = date("Y-m-d", $time_add);
		}
		if ($duration == "Monthly"){
			$time_add      = strtotime("+1 months", $time_original);
			$end_date      = date("Y-m-d", $time_add);
		}
		if ($duration == "Daily"){
			$time_add      = $time_original + (86400*1); //add seconds 
			$end_date      = date("Y-m-d", $time_add);
		}
		if ($duration == "Hourly"){
			$end_date      = $start_date;
		}

			//INPUT APPROPRIATE DATA to database
			permit($firstname, $surname, $email, $mobile, $start_date, $end_date, $department, $duration, $vehicle_type);

/*****EMAIL*****/					

/**EMAIL TO ADMIN**/
	//loop through admins, set new admin email
	//Email information
				$permission = 'admin';
				$subject = "(!)Notification - New Permit Request";
				$comment = "A new permit request has been submitted to the system. Please log in to your account to approve or deny the request.";
				$header = "From: healthandsafetydpt@anchorcollege.x10host.com";
		try {
				$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
				$query = $pdo->prepare("SELECT email FROM users WHERE permission = '$permission'");
				$query->bindValue(':permission', $permission);	
				$query->execute();
				foreach ($query->fetchAll(PDO::FETCH_COLUMN) as $row) {
					$email = $row;
					mail($email, $subject, $comment, $header);	//Send email
				}	
			}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;			
			
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
    }
?>
<html> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Parking skeleon</title>
        <meta name="description" content="Index screen">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="/js/check.js"></script>
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
    <div id='nav'>
            <ul>
                <li><a href="index.php?home=true">Home</a></li>
                <li><a href="index.php?signout=true">Log Out</a></li>
            </ul>
        </div>
        <div id="container">
            <div id="body">
                <form name="edit "action="permit.php" method="post" onsubmit="return checkTime()">
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
					<?php
					session_start();
					//restrict dropdown selection of permit duration depending on user permissions
					
					//if visitor, user cannot select 'yearly' permit
					if ($_SESSION['isVisitor']){
						echo "<h2>Duration</h2>" . "<select name=\"Duration\">" . "<option>Monthly</option>" . "<option>Daily</option>" . "<option>Hourly</option>" . "</select>";
					}
					//else user can select any duraction permit
					else{
						echo "<h2>Duration</h2>" . "<select name=\"Duration\">" . "<option>Yearly</option>" . "<option>Monthly</option>" . "<option>Daily</option>" . "<option>Hourly</option>" . "</select>";
					}
					?>
                    <h2>Start Date</h2>
                        <input type="date" name="date">
                    <br>
                    <input type="submit" name="Submit" value="Submit">
                </form>
                
            </div>
        </div>
    </body>
</html>