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
        <div id="container">
			<div id='captionHead'>Unpaid Violations</div>
			<div class='caption'>Parking</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";

	//try retrieving data from violations where status is unpaid and type is parking
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE status = 'Unpaid' AND violation_type = 'Parking'"); 
				$stmt->execute();
	//if data is not null
		if ($data = $stmt->fetch()){
			//start table, echo headings
				echo "<div id='table'>";
				echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>First Name</span>
                        <span class='cell'>Last Name</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Vehicle Type</span>
                        <span class='cell'>License</span>
                        <span class='cell'></span>
                    </div>";
					
			//open pdo with database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//that selects appropriate data fields where status is unpaid and violation type parking	
				$stmt = $conn->prepare("SELECT violation_id, date, time, v_firstname, v_surname, description, vehicle_type, license FROM violations WHERE status = 'Unpaid' AND violation_type = 'Parking'"); 
				$stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					//print out information in cells
					echo "<span class='cell primary' data-label='ID'>" . $row['violation_id'] . "</span>"; 
					echo "<span class='cell' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='First name'>" . $row['v_firstname'] . "</span>";
					echo "<span class='cell' data-label='Last Name'>" . $row['v_surname'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
					echo "<span class='cell' data-label='License'>" . $row['license'] . "</span>";
            
					$counter = $row['violation_id'];	//change counter variable to current violation_id
					
					//create button that submits form according to violation_id of current row (counter)
					echo "<span class='cellButton' data-label='Print'>" . "<form method=\"get\" action=\"printViolation.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"Print\" value=\"Print\">" . "</form>" . "</span>";
                    echo "</div>";
				}
				echo "</div>"; //end table
			}
			//else if data null
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
			<div class='caption'>Smoking</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";

		//try retrieving data from violations where status is unpaid and type is smoking
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE status = 'Unpaid' AND violation_type = 'Smoking'"); 
				$stmt->execute();
		//if data not null		
		if ($data = $stmt->fetch()){	
				//start table, echo headings		
				echo "<div id='table'>"; 
				echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>First Name</span>
                        <span class='cell'>Last Name</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Department</span>
                        <span class='cell'>Supervisor</span>
                        <span class='cell'>Place</span>
                        <span class='cell'></span>
                        </div>";
			
			//open pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//that selects appropriate data fields where status is unpaid and violation type smoking
				$stmt = $conn->prepare("SELECT violation_id, date, time, v_firstname, v_surname, description, v_department, v_supervisor, place FROM violations WHERE status = 'Unpaid' AND violation_type = 'Smoking'"); 
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row, print information in cells
					echo "<div class='row'>"; 
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['violation_id'] . "</span>"; 
					echo "<span class='cell' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='First name'>" . $row['v_firstname'] . "</span>";
					echo "<span class='cell' data-label='Last Name'>" . $row['v_surname'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['v_department'] . "</span>";
					echo "<span class='cell' data-label='Supervisor'>" . $row['v_supervisor'] . "</span>";
                    echo "<span class='cell' data-label='place'>" . $row['place'] . "</span>";
            
					$counter = $row['violation_id'];	//change counter variable to current violation_id
					
					//create button that submits form according to violation_id of current row (counter)
					echo "<span class='cellButton' data-label='Print'>" . "<form method=\"get\" action=\"printViolationSmoking.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"Print\" value=\"Print\">" . "</form>" . "</span>";
                    echo "</div>";
				}
				echo "</div>"; //end table
			}
			//else if data null
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
			<div class='caption'>Other</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
	//try retrieving data from violations where status is unpaid and type is other
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE status = 'Unpaid' AND violation_type = 'Other'");
				$stmt->execute();
		
		//if data not null			
				if ($data = $stmt->fetch()){
				//start table, echo headings					
				echo "<div id='table'>";
				echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>First Name</span>
                        <span class='cell'>Last Name</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Department</span>
                        <span class='cell'>Supervisor</span>
                        <span class='cell'>Place</span>
                        <span class='cell'></span>
                        </div>";
			
			//open pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//that selects appropriate data fields where status is unpaid and violation type other
				$stmt = $conn->prepare("SELECT violation_id, date, time, v_firstname, v_surname, description, v_department, v_supervisor, place FROM violations WHERE status = 'Unpaid' AND violation_type = 'Other'"); 
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row, print information in cells
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['violation_id'] . "</span>"; 
					echo "<span class='cell' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='First name'>" . $row['v_firstname'] . "</span>";
					echo "<span class='cell' data-label='Last Name'>" . $row['v_surname'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['v_department'] . "</span>";
					echo "<span class='cell' data-label='Supervisor'>" . $row['v_supervisor'] . "</span>";
                    echo "<span class='cell' data-label='place'>" . $row['place'] . "</span>";
            
					$counter = $row['violation_id'];	//change counter variable to current violation_id
					
					//create button that submits form according to violation_id of current row (counter)
					echo "<span class='cellButton' data-label='Print'>" . "<form method=\"get\" action=\"printViolationOther.php\">" . "<input type=\"hidden\" name=\"id\" value=\"$counter\">" . "<input type=\"submit\" name=\"Print\" value=\"Print\">" . "</form>" . "</span>";
                    echo "</div>";
				}
				echo "</div>"; //end table
			}
			//if data null
			else{
				echo "<h1>No Records</h1>";
			}
			} //try/catch exception
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;	//close connection		
			?>
			<br>
			<div id='captionHead'>Paid Violations</div>
			<div class='caption'>Parking</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
		
		//try retrieving data from violations where status is paid and type is parking
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE status = 'Paid' AND violation_type = 'Parking'"); 
				$stmt->execute();
				
	//if not null
		if ($data = $stmt->fetch()){
			//start table, echo headings
				echo "<div id='table'>";
				echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>First Name</span>
                        <span class='cell'>Last Name</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Vehicle Type</span>
                        <span class='cell'>License</span>
                    </div>";
 
			//open pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//that selects appropriate data fields where status is paid and violation type parking
				$stmt = $conn->prepare("SELECT violation_id, date, time, v_firstname, v_surname, description, vehicle_type, license FROM violations WHERE status = 'Paid' AND violation_type = 'Parking'"); 
				$stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row, print information in cells
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['violation_id'] . "</span>"; 
					echo "<span class='cell' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='First name'>" . $row['v_firstname'] . "</span>";
					echo "<span class='cell' data-label='Last Name'>" . $row['v_surname'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Vehicle Type'>" . $row['vehicle_type'] . "</span>";
					echo "<span class='cell' data-label='License'>" . $row['license'] . "</span>";
            
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
			$conn = null; //close connection
			?>
			<br>
			<div class='caption'>Smoking</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";

	//try retrieving data from violations where status is paid and type is smoking
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
				$stmt = $conn->prepare("SELECT * FROM violations WHERE status = 'Paid' AND violation_type = 'Smoking'");
				$stmt->execute();
				
		//if data not null		
		if ($data = $stmt->fetch()){	
				//start table, echo headings		
				echo "<div id='table'>";
				echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>First Name</span>
                        <span class='cell'>Last Name</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Department</span>
                        <span class='cell'>Supervisor</span>
                        <span class='cell'>Place</span>
                        </div>";
			//open new pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//that selects appropriate data fields where status is paid and violation type smoking
				$stmt = $conn->prepare("SELECT violation_id, date, time, v_firstname, v_surname, description, v_department, v_supervisor, place FROM violations WHERE status = 'Paid' AND violation_type = 'Smoking'"); 
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row, print information in cells
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['violation_id'] . "</span>"; 
					echo "<span class='cell' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='First name'>" . $row['v_firstname'] . "</span>";
					echo "<span class='cell' data-label='Last Name'>" . $row['v_surname'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['v_department'] . "</span>";
					echo "<span class='cell' data-label='Supervisor'>" . $row['v_supervisor'] . "</span>";
                    echo "<span class='cell' data-label='place'>" . $row['place'] . "</span>";
            
					echo "</div>";
				}
				echo "</div>"; //end table
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
			<div class='caption'>Other</div>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
	//try retrieving data from violations where status is paid and type is other
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE status = 'Paid' AND violation_type = 'Other'");
				$stmt->execute();
				
		//if data not null		
		if ($data = $stmt->fetch()){	
			//start table, echo headings		
				echo "<div id='table'>";
				echo "<div class='header-row row'>
                        <span class='cell primary'>ID</span>
                        <span class='cell'>Date</span>
                        <span class='cell'>Time</span>
                        <span class='cell'>First Name</span>
                        <span class='cell'>Last Name</span>
                        <span class='cell'>Description</span>
                        <span class='cell'>Department</span>
                        <span class='cell'>Supervisor</span>
                        <span class='cell'>Place</span>
                        </div>";
			//open pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//that selects appropriate data fields where status is paid and violation type other
				$stmt = $conn->prepare("SELECT violation_id, date, time, v_firstname, v_surname, description, v_department, v_supervisor, place FROM violations WHERE status = 'Paid' AND violation_type = 'Other'"); 
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//new row, print information in cells
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					echo "<span class='cell primary' data-label='ID'>" . $row['violation_id'] . "</span>"; 
					echo "<span class='cell' data-label='Date'>" . $row['date'] . "</span>";
					echo "<span class='cell' data-label='Time'>" . $row['time'] . "</span>";
					echo "<span class='cell' data-label='First name'>" . $row['v_firstname'] . "</span>";
					echo "<span class='cell' data-label='Last Name'>" . $row['v_surname'] . "</span>";
					echo "<span class='cell' data-label='Description'>" . $row['description'] . "</span>";
					echo "<span class='cell' data-label='Department'>" . $row['v_department'] . "</span>";
					echo "<span class='cell' data-label='Supervisor'>" . $row['v_supervisor'] . "</span>";
                    echo "<span class='cell' data-label='place'>" . $row['place'] . "</span>";
            
					echo "</div>";
				}
				echo "</div>"; //end table
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
        </div>
    </body>
</html>