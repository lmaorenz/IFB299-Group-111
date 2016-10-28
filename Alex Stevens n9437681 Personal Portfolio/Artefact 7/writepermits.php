<?php

if (isset($_GET['edit']))
    {
		$id = $_GET["id"];

			//REROUTE TO APPROPRIATE HOME
				header("Location: http://{$_SERVER['HTTP_HOST']}/printpermits.php"); 
				exit();
				
	}

if (isset($_POST['approve']))
    {
		$id = $_POST["id"];
		$status = "Approved";
		
		$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$sql = "UPDATE permits SET status=:status WHERE permit_id=:id";
        $query = $pdo->prepare($sql);

        $query->bindValue(":status", $status);
        $query->bindValue(":id", $id);
        $result = $query->execute();
		
			
			//REROUTE TO APPROPRIATE HOME
				header("Location: http://{$_SERVER['HTTP_HOST']}/writepermits.php?submitsuccess=true"); 
				exit();
	}

if (isset($_POST['deny']))
    {
		$id = $_POST["id"];
		$status = "Denied";
		
		$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$sql = "UPDATE permits SET status=:status WHERE permit_id=:id";
        $query = $pdo->prepare($sql);

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
                <li><a>Home</a></li>
                <li><a href="index.php?signout=true">Log Out</a></li>
            </ul>
        </div>
		<div id='captionHead'>Permits Database</div>
        <div id="container">
            <br>
			<?php
			session_start();
			//print_r($_SESSION);
			?>
			<div class='caption'>Pending Permits</div>
			<br>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE status = 'Pending'"); 
				$stmt->execute();
				
		if ($data = $stmt->fetch()){
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

				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT permit_id, firstname, surname, email, mobile, department, duration, start_date, end_date, vehicle_type FROM permits WHERE status = 'Pending'"); 
				$stmt->execute();
	
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
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
            
                    $counter = $row['permit_id'];	
					
					echo "<span class='cellButton'>" . "<form method=\"post\" action=\"writepermits.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"approve\" value=\"Approve\">" . "</form>" . "</span>";
					echo "<span class='cellButton'>" . "<form method=\"post\" action=\"writepermits.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"deny\" value=\"Deny\">" . "</form>" . "</span>";		
					echo "</div>";
				}

				echo "</div>";
			}
			else{
				echo "None";
			}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
			
			?>
			<br>
			<div class='caption'>Approved Permits</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE status = 'Approved'"); 
				$stmt->execute();
				
		if ($data = $stmt->fetch()){
				echo "<div id='table'>";
				echo "<div class='header-row row'><span class='cell primary'>ID</span><span class='cell'>First Name</span><span class='cell'>Surname</span><span class='cell'>Email</span><span class='cell'>Mobile</span><span class='cell'>Department</span><span class='cell'>Duration</span><span class='cell'>Start Date</span><span class='cell'>End Date</span><span class='cell'>Vehicle Type</span><span class='cell'></span><span class='cell'></span></div>";

				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT permit_id, firstname, surname, email, mobile, department, duration, start_date, end_date, vehicle_type FROM permits WHERE status = 'Approved'"); 
				$stmt->execute();
	
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
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
            
                    $counter = $row['permit_id'];	
					
					echo "<span class='cellButton' data-label='Print'>" . "<form method=\"get\" action=\"printpermits.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"Print\" value=\"Print\">" . "</form>" . "</span>";
					echo "</div>";
				}

				echo "</div>";
			}
			else{
				echo "None";
			}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
			
			?>
			<br>
			<div class='caption'>Denied Permits</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE status = 'Denied'");
				$stmt->execute();
			
			
		if ($data = $stmt->fetch()){
				echo "<div id='table'>";
				echo "<div class='header-row row'><span class='cell primary'>ID</span><span class='cell'>First Name</span><span class='cell'>Surname</span><span class='cell'>Email</span><span class='cell'>Mobile</span><span class='cell'>Department</span><span class='cell'>Duration</span><span class='cell'>Start Date</span><span class='cell'>End Date</span><span class='cell'>Vehicle Type</span><span class='cell'></span><span class='cell'></span></div>";

				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT permit_id, firstname, surname, email, mobile, department, duration, start_date, end_date, vehicle_type FROM permits WHERE status = 'Denied'"); 
				$stmt->execute();
	
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
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

				echo "</div>";
			}
			else{
				echo "None";
			}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;			
			?>
			<br>
        </div>
    </body>
</html>