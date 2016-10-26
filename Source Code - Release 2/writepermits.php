<?php

//IF PERMIT IS PRINTED
if (isset($_GET['edit']))
    {
		$id = $_GET["id"];

			//REROUTE TO APPROPRIATE HOME
				header("Location: http://{$_SERVER['HTTP_HOST']}/printpermits.php"); 
				exit();
				
	}
//IF PERMIT IS APPROVED
if (isset($_POST['approve']))
    {
		$id = $_POST["id"];
		$status = "Approved";
		
		$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$sql = "UPDATE permits SET status=:status WHERE permit_id=:id";
        $query = $pdo->prepare($sql);

		//update status to approved
        $query->bindValue(":status", $status);
        $query->bindValue(":id", $id);
        $result = $query->execute();
		
/*****EMAIL*****/					
		
/**EMAIL TO PERMIT HOLDER**/	
		//GET NAME
		try {
				$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
				$query = $pdo->prepare("SELECT surname FROM permits WHERE permit_id='$id'");
				$query->bindValue(':permit_id', $id);	
				$query->execute();
				$surname = $query->fetchColumn(); //set $surname			
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
		//GET EMAIL
		try {
				$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
				$query = $pdo->prepare("SELECT email FROM users WHERE surname = '$surname'");
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
  $subject = "Notification - Parking Permit Approval";
  $comment = "Your parking permit has been approved by Atmiya College’s Health and Safety department. 

As a permit owner, you are required to affix your permit to the windshield of your vehicle. In the case of four wheels, this will be on the lower corner on the driver side. In the case of two wheelers, the permit owner is required to affix the permit in the front of the vehicle. 

Please log in to your account to access a print-friendly version of your approved permit.";
  $header = "From: healthandsafetydpt@anchorcollege.x10host.com";
  mail($email, $subject, $comment, $header); //Send email
			
			
			
			//REROUTE TO APPROPRIATE HOME
				header("Location: http://{$_SERVER['HTTP_HOST']}/writepermits.php?submitsuccess=true"); 
				exit();
	}

//IF PERMIT IS DENIED
if (isset($_POST['deny']))
    {
		$id = $_POST["id"];
		$status = "Denied";
		
		$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$sql = "UPDATE permits SET status=:status WHERE permit_id=:id";
        $query = $pdo->prepare($sql);

		//update status to denied
        $query->bindValue(":status", $status);
        $query->bindValue(":id", $id);
        $result = $query->execute();
		
			
			//REROUTE TO APPROPRIATE HOME
				header("Location: http://{$_SERVER['HTTP_HOST']}/writepermits.php?submitsuccess=true"); 
				exit();
	}
?>
<html>  
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Parking skeleon</title>
        <meta name="description" content="Index screen">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/print.css" media="print">
    </head>
    <body>
	<?php 
        if (isset($_GET['submitsuccess'])){
			$id = $_GET["id"];
			$status = $_GET["status"];
			echo $status . $id;
			echo "<div id='captionSuccess'>Form submission successful</div>>";	
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
		<div id='captionHead'>Permits Database</div>
        <div id="container">
			<?php
			session_start();
			//print_r($_SESSION);
			?>
			<div class='caption'>Pending Permits</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";

	//try retrieving data from permits where status is pending
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE status = 'Pending'"); 
				$stmt->execute();
	
	//if data is not null	
		if ($data = $stmt->fetch()){
			//new table, echo headings
				echo "<div id='table'>";
				echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>First Name</span>
                        <span class='cell'>Surname</span>
                        <span class='cell'>Email</span>
                        <span class='cell'>Mobile</span>
                        <span class='cell'>Department</span>
                        <span class='cell'>Duration</span>
                        <span class='cell'>Start Date</span>
                        <span class='cell'>End Date</span>
                        <span class='cell'>Vehicle Type</span>
                        <span class='cell'></span>
                        <span class='cell'></span>
                    </div>";
			//open pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//that selects appropriate fields from permits table where status is pending
				$stmt = $conn->prepare("SELECT permit_id, firstname, surname, email, mobile, department, duration, start_date, end_date, vehicle_type FROM permits WHERE status = 'Pending'"); 
				$stmt->execute();
	
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					//print information in cells
					echo "<span class='cell primary' data-label='ID'>" . $row['permit_id'] . "</span>"; 
					echo "<span class='cell' data-label='First name'>" . $row['firstname'] . "</span>";
					echo "<span class='cell' data-label='Surname'>" . $row['surname'] . "</span>";
					echo "<span class='cell' data-label='Email'>" . $row['email'] . "</span>";
					echo "<span class='cell' data-label='Mobile'>" . $row['mobile'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['department'] . "</span>";
					echo "<span class='cell' data-label='Duration'>" . $row['duration'] . "</span>";
					echo "<span class='cell' data-label='Start Date'>" . $row['start_date'] . "</span>";
					echo "<span class='cell' data-label='End Date'>" . $row['end_date'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
            
                    $counter = $row['permit_id'];	//change counter ot current permit_id
					
					//create button that submits form according to permit_id of current row (counter)
					echo "<span class='cellButton'>" . "<form method=\"post\" action=\"writepermits.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"approve\" value=\"Approve\">" . "</form>" . "</span>";
					echo "<span class='cellButton'>" . "<form method=\"post\" action=\"writepermits.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"deny\" value=\"Deny\">" . "</form>" . "</span>";		
					echo "</div>";
				}

				echo "</div>"; //end table
			}
			//if data null
			else{
				echo "None";
			}
			}//try/catch exception
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null; //close connection
			
			?>
			<br>
			<div class='caption'>Approved Permits</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";

//try retrieving data from permits where status is approved
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE status = 'Approved'"); 
				$stmt->execute();
				
		//if data not null		
		if ($data = $stmt->fetch()){
			//create table, echo headings
				echo "<div id='table'>";
				echo "<div class='header-row row'><span class='cell primary'>ID</span><span class='cell'>First Name</span><span class='cell'>Surname</span><span class='cell'>Email</span><span class='cell'>Mobile</span><span class='cell'>Department</span><span class='cell'>Duration</span><span class='cell'>Start Date</span><span class='cell'>End Date</span><span class='cell'>Vehicle Type</span><span class='cell'></span><span class='cell'></span></div>";
			//open pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//that selects appropriate fields from permits table where status is approved
				$stmt = $conn->prepare("SELECT permit_id, firstname, surname, email, mobile, department, duration, start_date, end_date, vehicle_type FROM permits WHERE status = 'Approved'"); 
				$stmt->execute();
	
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					//print information in cells
					echo "<span class='cell primary' data-label='ID'>" . $row['permit_id'] . "</span>"; 
					echo "<span class='cell' data-label='First name'>" . $row['firstname'] . "</span>";
					echo "<span class='cell' data-label='Surname'>" . $row['surname'] . "</span>";
					echo "<span class='cell' data-label='Email'>" . $row['email'] . "</span>";
					echo "<span class='cell' data-label='Mobile'>" . $row['mobile'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['department'] . "</span>";
					echo "<span class='cell' data-label='Duration'>" . $row['duration'] . "</span>";
					echo "<span class='cell' data-label='Start Date'>" . $row['start_date'] . "</span>";
					echo "<span class='cell' data-label='End Date'>" . $row['end_date'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
            
                    $counter = $row['permit_id'];	//change counter variable to current permit_id
					
					//create button that submits form according to permit_id of current row (counter)
					echo "<span class='cellButton' data-label='Print'>" . "<form method=\"get\" action=\"printpermits.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"Print\" value=\"Print\">" . "</form>" . "</span>";
					echo "</div>";
				}

				echo "</div>"; //end table
			}
			//if data null
			else{
				echo "None";
			}
			}//try/catch exception
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null; //close connection
			
			?>
			<br>
			<div class='caption'>Denied Permits</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";

//try retrieving data from permits where status is denied
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE status = 'Denied'");
				$stmt->execute();
			
		//if data is not null	
		if ($data = $stmt->fetch()){
			//new table, echo headings
				echo "<div id='table'>";
				echo "<div class='header-row row'><span class='cell primary'>ID</span><span class='cell'>First Name</span><span class='cell'>Surname</span><span class='cell'>Email</span><span class='cell'>Mobile</span><span class='cell'>Department</span><span class='cell'>Duration</span><span class='cell'>Start Date</span><span class='cell'>End Date</span><span class='cell'>Vehicle Type</span><span class='cell'></span><span class='cell'></span></div>";
			//open pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//that selects appropriate fields from permits table where status is denied
				$stmt = $conn->prepare("SELECT permit_id, firstname, surname, email, mobile, department, duration, start_date, end_date, vehicle_type FROM permits WHERE status = 'Denied'"); 
				$stmt->execute();
	
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					//print information in cells
					echo "<span class='cell primary' data-label='ID'>" . $row['permit_id'] . "</span>"; 
					echo "<span class='cell' data-label='First name'>" . $row['firstname'] . "</span>";
					echo "<span class='cell' data-label='Surname'>" . $row['surname'] . "</span>";
					echo "<span class='cell' data-label='Email'>" . $row['email'] . "</span>";
					echo "<span class='cell' data-label='Mobile'>" . $row['mobile'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['department'] . "</span>";
					echo "<span class='cell' data-label='Duration'>" . $row['duration'] . "</span>";
					echo "<span class='cell' data-label='Start Date'>" . $row['start_date'] . "</span>";
					echo "<span class='cell' data-label='End Date'>" . $row['end_date'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
                    echo "</div>";
				}

				echo "</div>"; //end table
			}
			//if data null
			else{
				echo "None";
			}
			}//try/catch exception
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;	//close connection		
			?>
			<br>
        </div>
    </body>
</html>