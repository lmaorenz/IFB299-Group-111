<?php

if (isset($_POST['approve']))
    {
		$violation_id = $_POST["id"];
		$status = "Paid";
		
		$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$sql = "UPDATE violations SET status=:status WHERE violation_id=:violation_id";
        $query = $pdo->prepare($sql);

        $query->bindValue(":status", $status);
        $query->bindValue(":violation_id", $violation_id);
        $result = $query->execute();
		
			
			//REROUTE TO APPROPRIATE HOME
				header("Location: http://{$_SERVER['HTTP_HOST']}/readviolation.php?paysuccess=true"); 
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
    </head>
    <body>
	<?php 
        if (isset($_GET['paysuccess'])){
			echo "<div id='captionSuccess'>Payment successful</div>";	
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
        <div id="container">
            <br>
			<?php
			session_start();
			//print_r($_SESSION);
			?>
			<div id='captionHead'>Current Violations</div>
			<br>
			<div class="caption">Parking</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
			$firstname = $_SESSION['firstname'];
			$surname = $_SESSION['surname'];

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Parking'");
				$stmt->execute();
	
			if ($data = $stmt->fetch()){	
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
				$stmt = $conn->prepare("SELECT violation_id, date, time, description, vehicle_type, license FROM violations WHERE v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Parking'");
				$stmt->execute();
				
				$empty = true;
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$datetime1 = strtotime(date('Y-m-d'));
					$datetime2 = strtotime($row['date']);
					$interval = ($datetime1 - $datetime2)/86400;
					
					if ($interval < 7){ //if within a week
					$empty = false;	
					}
				}
				
				if (!$empty){
				
                 echo "<div id='table'>";
                    echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Vehicle Type</span>
                        <span class='cell'>License</span>
                    </div>";
				
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
				$stmt = $conn->prepare("SELECT violation_id, date, time, description, vehicle_type, license FROM violations WHERE v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Parking'");  
				$stmt->execute();
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$datetime1 = strtotime(date('Y-m-d'));
					$datetime2 = strtotime($row['date']);
					$interval = ($datetime1 - $datetime2)/86400;
					if ($interval < 7){ //if within a week
						echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>"; 
					echo "<span class='cell primary' data-label='ID'>" . $row['violation_id'] . "</span>";
                        echo "<span class='cell' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
					echo "<span class='cell' data-label='License'>" . $row['license'] . "</span>";
					
					$counter = $row['violation_id'];	
					
					echo "<span class='cellButton>" . "<form method=\"post\" action=\"readviolation.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"approve\" value=\"Pay\">" . "</form>" . "</span>";
					
					echo "</div>";
					}
				}

				echo "</div>";
			}
			else{
				echo "<h1>No Records</h1>";
			}
			}
			else{
				echo "<h1>No Records</h1>";
			}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
			
			?>
			<br>
			<div class="caption">Non-parking</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
			$firstname = $_SESSION['firstname'];
			$surname = $_SESSION['surname'];

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Smoking') OR (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Other')"); 
				$stmt->execute();
	
			if ($data = $stmt->fetch()){	
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
				$stmt = $conn->prepare("SELECT violation_id, date, time, description, v_department, v_supervisor, place, violation_type FROM violations WHERE (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Smoking') OR (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Other')"); 
				$stmt->execute();
				
				$empty = true;
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$datetime1 = strtotime(date('Y-m-d'));
					$datetime2 = strtotime($row['date']);
					$interval = ($datetime1 - $datetime2)/86400;
					
					if ($interval < 7){ //if within a week
					$empty = false;	
					}
				}
				
				if (!$empty){	
                    echo "<div id='table'>";
                    echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Department</span>
                        <span class='cell'>Supervisor</span>
                        <span class='cell'>Place</span>
                        <span class='cell'>Violation Type</span>
                        <span class='cell'></span>
                        </div>";
				
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
				$stmt = $conn->prepare("SELECT violation_id, date, time, description, v_department, v_supervisor, place, violation_type FROM violations WHERE (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Smoking') OR (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Other')"); 
				$stmt->execute();
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$datetime1 = strtotime(date('Y-m-d'));
					$datetime2 = strtotime($row['date']);
					$interval = ($datetime1 - $datetime2)/86400;
					if ($interval < 7){ //if within a week
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['violation_id'] . "</span>"; 
					echo "<span class='cell' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='First name'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Last Name'>" . $row['v_department'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['v_supervisor'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['place'] . "</span>";
					echo "<span class='cell' data-label='Supervisor'>" . $row['violation_type'] . "</span>";
					
					$counter = $row['violation_id'];	
					
					echo "<span class='cellButton'>" . "<form method=\"post\" action=\"readviolation.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"approve\" value=\"Pay\">" . "</form>" . "</span>";
					
					echo "</div>";
					}
				}

				echo "</div>";
			}
			else{
				echo "<h1>No Records</h1>";
			}
			}
			else{
				echo "<h1>No Records</h1>";
			}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
			
			?>
			<br>
			<div id='captionHead'>Outstanding Violations</div>
			<br>
			<div class='caption'>Parking</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
			$firstname = $_SESSION['firstname'];
			$surname = $_SESSION['surname'];

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Parking'");
				$stmt->execute();
	
			if ($data = $stmt->fetch()){	
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
				$stmt = $conn->prepare("SELECT violation_id, date, time, description, vehicle_type, license FROM violations WHERE v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Parking'");
				$stmt->execute();
				
				$empty = true;
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$datetime1 = strtotime(date('Y-m-d'));
					$datetime2 = strtotime($row['date']);
					$interval = ($datetime1 - $datetime2)/86400;
					
					if ($interval  > 6){ //if outside a week
					$empty = false;	
					}
				}
				
				if (!$empty){
				 echo "<div id='table'>";
				echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Vehicle Type</span>
                        <span class='cell'>License</span>
                    </div>";
				
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
				$stmt = $conn->prepare("SELECT violation_id, date, time, description, vehicle_type, license FROM violations WHERE v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Parking'");  
				$stmt->execute();
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$datetime1 = strtotime(date('Y-m-d'));
					$datetime2 = strtotime($row['date']);
					$interval = ($datetime1 - $datetime2)/86400;
					if ($interval  > 6){ //if outside a week
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>"; 
					echo "<span class='cell primary' data-label='ID'>" . $row['violation_id'] . "</span>";
                        echo "<span class='cell' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
					echo "<span class='cell' data-label='License'>" . $row['license'] . "</span>";
					
					$counter = $row['violation_id'];	
					
					echo "<span class='cellButton>" . "<form method=\"post\" action=\"readviolation.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"approve\" value=\"Pay\">" . "</form>" . "</span>";
					
					echo "</div>";
					}
                }

				echo "</div>";
			}
			else{
				echo "<h1>No Records</h1>";
			}
			}
			else{
				echo "<h1>No Records</h1>";
			}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
			
			?>
			<br>
			<div class='caption'>Non-parking</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
			$firstname = $_SESSION['firstname'];
			$surname = $_SESSION['surname'];

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Smoking') OR (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Other')"); 
				$stmt->execute();
	
			if ($data = $stmt->fetch()){	
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
				$stmt = $conn->prepare("SELECT violation_id, date, time, description, v_department, v_supervisor, place, violation_type FROM violations WHERE (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Smoking') OR (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Other')"); 
				$stmt->execute();
				
				$empty = true;
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$datetime1 = strtotime(date('Y-m-d'));
					$datetime2 = strtotime($row['date']);
					$interval = ($datetime1 - $datetime2)/86400;
					
					if ($interval  > 6){ //if outside a week
					$empty = false;	
					}
				}
				
				if (!$empty){
				
                echo "<div id='table'>";
                    echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Department</span>
                        <span class='cell'>Supervisor</span>
                        <span class='cell'>Place</span>
                        <span class='cell'>Violation Type</span>
                        <span class='cell'></span>
                        </div>";
				
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
				$stmt = $conn->prepare("SELECT violation_id, date, time, description, v_department, v_supervisor, place, violation_type FROM violations WHERE (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Smoking') OR (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Unpaid' AND violation_type = 'Other')"); 
				$stmt->execute();
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$datetime1 = strtotime(date('Y-m-d'));
					$datetime2 = strtotime($row['date']);
					$interval = ($datetime1 - $datetime2)/86400;
					if ($interval  > 6){ //if outside a week
					//echo $interval; --> debugging
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['violation_id'] . "</span>"; 
					echo "<span class='cell' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='First name'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Last Name'>" . $row['v_department'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['v_supervisor'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['place'] . "</span>";
					echo "<span class='cell' data-label='Supervisor'>" . $row['violation_type'] . "</span>";
					
					$counter = $row['violation_id'];	
					
					echo "<span class='cellButton'>" . "<form method=\"post\" action=\"readviolation.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"approve\" value=\"Pay\">" . "</form>" . "</span>";
					
					echo "</div>";
					}
				}

				echo "</div>";
			}
			else{
				echo "<h1>No Records</h1>";
			}
			}
			else{
				echo "<h1>No Records</h1>";
			}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
			
			?>
			<br>
			<div id='captionHead'>Paid Violations</div>
			<br>
			<div class='caption'>Parking</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
			$firstname = $_SESSION['firstname'];
			$surname = $_SESSION['surname'];

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Paid' AND violation_type = 'Parking'"); 
				$stmt->execute();
				
			
		if ($data = $stmt->fetch()){			
            echo "<div id='table'>";
				echo "<div class='header-row row'>
                        <span class='cell primary'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Vehicle Type</span>
                        <span class='cell'>License</span>
                    </div>";
            
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT date, time, description, vehicle_type, license FROM violations WHERE v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Paid' AND violation_type = 'Parking'"); 
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>"; 
					echo "<span class='cell primary' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
					echo "<span class='cell' data-label='License'>" . $row['license'] . "</span>";
            
					echo "</div>";
				}
				echo "</div>";
			}
			else{
				echo "<h1>No Records</h1>";
			}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
			?>
			<br>
			<div class='caption'>Non-parking</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
			$firstname = $_SESSION['firstname'];
			$surname = $_SESSION['surname'];

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Paid' AND violation_type = 'Smoking') OR (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Paid' AND violation_type = 'Other')");
				$stmt->execute();
				
				
		if ($data = $stmt->fetch()){

            echo "<div id='table'>";
				echo "<div class='header-row row'>
                        <span class='cell primary'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Department</span>
                        <span class='cell'>Supervisor</span>
                        <span class='cell'>Place</span>
                        <span class='cell'>Violation</span>
                    </div>";
			
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT date, time, description, v_department, v_supervisor, place, violation_type FROM violations WHERE (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Paid' AND violation_type = 'Smoking') OR (v_firstname = '$firstname' AND v_surname = '$surname' AND status = 'Paid' AND violation_type = 'Other')");
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['v_department'] . "</span>";
					echo "<span class='cell' data-label='Supervisor'>" . $row['v_supervisor'] . "</span>";
					echo "<span class='cell' data-label='Place'>" . $row['place'] . "</span>";
					echo "<span class='cell' data-label='Violation'>" . $row['violation_type'] . "</span>";
            
					echo "</div>";
				}
				echo "</div>";
			}
			else{
				echo "<h1>No Records</h1>";
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