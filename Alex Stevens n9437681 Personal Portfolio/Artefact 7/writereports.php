<?php
if (isset($_GET['edit']))
    {
		$id = $_GET["id"];

			//REROUTE TO APPROPRIATE HOME
				header("Location: http://{$_SERVER['HTTP_HOST']}/editreports.php"); 
				exit();
				
	}
?><html>
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
			echo "<div id='captionSuccess'>Form submission successful</div>>";	
			$_SESSION['id']="";
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
		<div id='captionHead'>Health & Safety Reports Database</div>
        <div id="container">
            <br>
			<?php
			session_start();
			//print_r($_SESSION);
			?>
			<div class='caption'>Unresolved Reports</div>
			<br>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM health WHERE status = 'Unresolved'"); 
				$stmt->execute();
				
		if ($data = $stmt->fetch()){
            echo "<div id='table'>";
				echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>First Name</span>
                        <span class='cell'>Surname</span>
                        <span class='cell'>Start Date</span>
                        <span class='cell'>Start Time</span>
                        <span class='cell'>Department</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>End Date</span>
                        <span class='cell'>End Time</span>
                        <span class='cell'>Resolution</span>
                        <span class='cell'></span>
                    </div>";

				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT health_id, firstname, surname, start_date, start_time, department, description, end_date, end_time, resolution FROM health WHERE status = 'Unresolved'");
				$stmt->execute();
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['health_id'] . "</span>"; 
					echo "<span class='cell' data-label='First name'>" . $row['firstname'] . "</span>";
					echo "<span class='cell' data-label='Surname'>" . $row['surname'] . "</span>";
					echo "<span class='cell' data-label='Email'>" . $row['start_date'] . "</span>";
					echo "<span class='cell' data-label='Mobile'>" . $row['start_time'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['department'] . "</span>";
					echo "<span class='cell' data-label='Duration'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Start Date'>" . $row['end_date'] . "</span>";
					echo "<span class='cell' data-label='End Date'>" . $row['end_time'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['resolution'] . "</span>";
					
					$counter = $row['health_id'];	
					
					echo "<span class='cellButton'>" . "<form method=\"get\" action=\"editreports.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"edit\" value=\"Edit\">" . "</form>" . "</span>";
					
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
			<div class='caption'>Resolved Reports</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM health WHERE status = 'Resolved'"); 
				$stmt->execute();
				
		if ($data = $stmt->fetch()){
            echo "<div id='table'>";
				echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>First Name</span>
                        <span class='cell'>Surname</span>
                        <span class='cell'>Start Date</span>
                        <span class='cell'>Start Time</span>
                        <span class='cell'>Department</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>End Date</span>
                        <span class='cell'>End Time</span>
                        <span class='cell'>Resolution</span>
                       
                    </div>";

				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT health_id, firstname, surname, start_date, start_time, department, description, end_date, end_time, resolution FROM health WHERE status = 'Resolved'");
				$stmt->execute();
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['health_id'] . "</span>"; 
					echo "<span class='cell' data-label='First name'>" . $row['firstname'] . "</span>";
					echo "<span class='cell' data-label='Surname'>" . $row['surname'] . "</span>";
					echo "<span class='cell' data-label='Email'>" . $row['start_date'] . "</span>";
					echo "<span class='cell' data-label='Mobile'>" . $row['start_time'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['department'] . "</span>";
					echo "<span class='cell' data-label='Duration'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Start Date'>" . $row['end_date'] . "</span>";
					echo "<span class='cell' data-label='End Date'>" . $row['end_time'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['resolution'] . "</span>";
				
					
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