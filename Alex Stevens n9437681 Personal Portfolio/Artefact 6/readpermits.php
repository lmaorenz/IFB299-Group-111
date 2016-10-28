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
			echo "<div id='captionSuccess'>Form submission successful</div>";	
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
			$firstname = $_SESSION['firstname'];
			$surname = $_SESSION['surname'];

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Pending'"); 
				$stmt->execute();
				
		if ($data = $stmt->fetch()){			
				echo "<div id='table'>";
				echo "<div class='header-row row'><span class='cell primary'>ID</span><span class='cell'>Duration</span><span class='cell'>Start Date</span><span class='cell'>End Date</span><span class='cell'>Vehicle Type</span></div>";

				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT permit_id, duration, start_date, end_date, vehicle_type FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Pending'");
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['permit_id'] . "</span>"; 
					echo "<span class='cell' data-label='Duration'>" . $row['duration'] . "</span>";
					echo "<span class='cell' data-label='Start Date'>" . $row['start_date'] . "</span>";
					echo "<span class='cell' data-label='End Date'>" . $row['end_date'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
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
			<div class='caption'>Approved Permits</div>
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
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Approved'"); 
				$stmt->execute();
				
		if ($data = $stmt->fetch()){		
				echo "<div id='table'>";
				echo "<div class='header-row row'><span class='cell primary'>ID</span><span class='cell'>Duration</span><span class='cell'>Start Date</span><span class='cell'>End Date</span><span class='cell'>Vehicle Type</span><span class='cell'></span></div>";
			
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT permit_id, duration, start_date, end_date, vehicle_type FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Approved'"); 
				$stmt->execute();
            
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['permit_id'] . "</span>"; 
					echo "<span class='cell' data-label='Duration'>" . $row['duration'] . "</span>";
					echo "<span class='cell' data-label='Start Date'>" . $row['start_date'] . "</span>";
					echo "<span class='cell' data-label='End Date'>" . $row['end_date'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
                    
                
            
                    $counter = $row['permit_id'];
                    
                    echo "<span class='cellButton' data-label='Print'>" . "<form method=\"get\" action=\"printpermits.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"Print\" value=\"Print\">" . "</form>" . "</span>";
                    echo "</div>";
            
				
				// set the resulting array to associative
				
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
			<div class='caption'>Denied Permits</div>
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
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Denied'");
				$stmt->execute();
			
			
		if ($data = $stmt->fetch()){			
				echo "<div id='table'>";
				echo "<div class='header-row row'><span class='cell primary'>ID</span><span class='cell'>Duration</span><span class='cell'>Start Date</span><span class='cell'>End Date</span><span class='cell'>Vehicle Type</span></div>";

				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT permit_id, duration, start_date, end_date, vehicle_type FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Denied'");
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['permit_id'] . "</span>"; 
					echo "<span class='cell' data-label='Duration'>" . $row['duration'] . "</span>";
					echo "<span class='cell' data-label='Start Date'>" . $row['start_date'] . "</span>";
					echo "<span class='cell' data-label='End Date'>" . $row['end_date'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
                    
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