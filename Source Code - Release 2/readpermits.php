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
                <li><a href="index.php?home=true">Home</a></li>
                <li><a href="index.php?signout=true">Log Out</a></li>
            </ul>
        </div>
		<div id='captionHead'>Permits Database</div>
        <div id="container">
			<?php
			session_start();
			?>
			<div class='caption'>Pending Permits</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
			$firstname = $_SESSION['firstname'];
			$surname = $_SESSION['surname'];

//try retrieving data from permits where name matches $_SESSION name and status is pending
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Pending'"); 
				$stmt->execute();
		
		//if data not null
		if ($data = $stmt->fetch()){
				//new table, echo headings
				echo "<div id='table'>";
				echo "<div class='header-row row'><span class='cell primary'>ID</span><span class='cell'>Duration</span><span class='cell'>Start Date</span><span class='cell'>End Date</span><span class='cell'>Vehicle Type</span></div>";

				//open pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//that selects appropriate fields from permits table where name matches $_SESSION name and status is pending
				$stmt = $conn->prepare("SELECT permit_id, duration, start_date, end_date, vehicle_type FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Pending'");
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					//print information in cells
					echo "<span class='cell primary' data-label='ID'>" . $row['permit_id'] . "</span>"; 
					echo "<span class='cell' data-label='Duration'>" . $row['duration'] . "</span>";
					echo "<span class='cell' data-label='Start Date'>" . $row['start_date'] . "</span>";
					echo "<span class='cell' data-label='End Date'>" . $row['end_date'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
                    echo "</div>";
				}
				echo "</div>";//close table
			}
			//if data null
			else{
				echo "<h1>No Records</h1>";
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
			$firstname = $_SESSION['firstname'];
			$surname = $_SESSION['surname'];

//try retrieving data from permits where name matches $_SESSION name and status is approved
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Approved'"); 
				$stmt->execute();
				
		if ($data = $stmt->fetch()){	
				//new table, echo headings
				echo "<div id='table'>";
				echo "<div class='header-row row'><span class='cell primary'>ID</span><span class='cell'>Duration</span><span class='cell'>Start Date</span><span class='cell'>End Date</span><span class='cell'>Vehicle Type</span><span class='cell'></span></div>";
			
			//open pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//that selects appropriate fields from permits table where name matches $_SESSION name and status is approved
				$stmt = $conn->prepare("SELECT permit_id, duration, start_date, end_date, vehicle_type FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Approved'"); 
				$stmt->execute();
            
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					//print information in cells
					echo "<span class='cell primary' data-label='ID'>" . $row['permit_id'] . "</span>"; 
					echo "<span class='cell' data-label='Duration'>" . $row['duration'] . "</span>";
					echo "<span class='cell' data-label='Start Date'>" . $row['start_date'] . "</span>";
					echo "<span class='cell' data-label='End Date'>" . $row['end_date'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
            
                    $counter = $row['permit_id']; //change counter to current permit_id
                    
					//create button that submits form according to permit_id of current row (counter)
                    echo "<span class='cellButton' data-label='Print'>" . "<form method=\"get\" action=\"printpermits.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"Print\" value=\"Print\">" . "</form>" . "</span>";
                    echo "</div>";
          			
				}
				echo "</div>"; //close table
			}
			//if data null
			else{
				echo "<h1>No Records</h1>";
			}
			}//try/catch exception
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null; //end connection
			
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

//try retrieving data from permits where name matches $_SESSION name and status is denied
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Denied'");
				$stmt->execute();
			
		//if data not null	
		if ($data = $stmt->fetch()){
			//create table, echo headings			
				echo "<div id='table'>";
				echo "<div class='header-row row'><span class='cell primary'>ID</span><span class='cell'>Duration</span><span class='cell'>Start Date</span><span class='cell'>End Date</span><span class='cell'>Vehicle Type</span></div>";

				//open pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//that selects appropriate fields from permits table where name matches $_SESSION name and status is denied
				$stmt = $conn->prepare("SELECT permit_id, duration, start_date, end_date, vehicle_type FROM permits WHERE firstname = '$firstname' AND surname = '$surname' AND status = 'Denied'");
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					//print information into cells
					echo "<span class='cell primary' data-label='ID'>" . $row['permit_id'] . "</span>"; 
					echo "<span class='cell' data-label='Duration'>" . $row['duration'] . "</span>";
					echo "<span class='cell' data-label='Start Date'>" . $row['start_date'] . "</span>";
					echo "<span class='cell' data-label='End Date'>" . $row['end_date'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
                    
                    echo "</div>";
				}
				echo "</div>";//end table
			}
			//if data null
			else{
				echo "<h1>No Records</h1>";
			}
			}//try/catch exception
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null; //end connection			
			?>
			<br>
        </div>
    </body>
</html>