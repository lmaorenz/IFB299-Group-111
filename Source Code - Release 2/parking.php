<?php
    if (isset($_POST['Submit']))
    {
		session_start();
	    // validate posted username and password here
		require 'submit.inc';	
		
		$time=$_POST['time'];
		$date=$_POST['date'];
		$v_firstname = $_POST['first'];
		$v_surname = $_POST['last'];
		$violation_type=$_POST['violation'];
		$description=$_POST['desc'];
		$vehicle_type=$_POST['vehicle'];
		$license=$_POST['license'];
		$permit=$_POST['permit'];
		$permit_id=$_POST['permID'];

			//INPUT APPROPRIATE DATA to database
			parking($time, $date, $v_firstname, $v_surname, $violation_type, $description, $vehicle_type, $license, $permit, $permit_id);

/*****EMAIL*****/					
		
/**EMAIL TO VIOLATOR**/	
		try {
				$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
				$query = $pdo->prepare("SELECT email FROM users WHERE firstname = '$v_firstname' AND surname = '$v_surname'");
				$query->bindValue(':firstname', $v_firstname);	
				$query->bindValue(':surname', $v_surname);	
				$query->execute();
				$email = $query->fetchColumn(); //set $email			
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;			
	//Email information
  $subject = "Notification - New Violation";
  $comment = "A new violation has been filed against your account by the Health and Safety department of Atmiya College. 

This fine requires payment within one week or else further processing in terms of late payment applies. 

Please log in to your account to pay your fines. If you disagree with the terms of your violation, contact the Atmiya College general complaints line.";	
  $header = "From: healthandsafetydpt@anchorcollege.x10host.com";
  mail($email, $subject, $comment, $header); //Send email

/**EMAIL TO ADMIN**/
	//loop through admins, set new admin email
	//Email information
				$permission = 'admin';
				$subject = "Notification - New Violation";
				$comment = "A new violation has been registered in the system. A notification has been sent to its recipient. 

There is no follow-up action required.";
				$header = "From: healthandsafetydpt@anchorcollege.x10host.com";
		try {
				$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
				$query = $pdo->prepare("SELECT email FROM users WHERE permission = '$permission'");
				$query->bindValue(':permission', $permission);	
				$query->execute();
				foreach ($query->fetchAll(PDO::FETCH_COLUMN) as $row) {
					$email = $row;
					mail($email, $subject, $comment, $header); //Send email
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
			<h1>Parking Violation</h1>
                <form name="edit" action="parking.php" method="post" onsubmit="return checkTime()">
					<h2>Name</h2>
                        <input type="text" name="first" placeholder="First Name" required>
						<input type="text" name="last" placeholder="Surname" required>
                    <h2>Time and Date</h2>
                        <input type="text" name="time">
                        <input type="date" name="date" required>
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
                        <input type="text" name="license" placeholder="###" required/>
                    <h2>Valid Permit?</h2>
                        <input type="radio" name="permit" value="yes"> Yes<br>
                        <input type="radio" name="permit" value="no"> No<br>
                    <h2>Permit ID number</h2>
                        <input type="text" name="permID" required>		
				   <br>
                    <input type="submit" name="Submit" value="Submit">
                </form>  
            </div>
        </div>
    </body>
</html>