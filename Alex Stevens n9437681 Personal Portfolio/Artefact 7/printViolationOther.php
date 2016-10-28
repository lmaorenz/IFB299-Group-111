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
			echo "<h1>Form submission successful</h1>";	
			}
		?>
        <div id="headerLogin">
            <img src="pics/logo.png" alt="Anchor parking and fine management">
        </div>
        <div id="container">
            <br>
			<?php
			session_start();
			$_SESSION['id']=$_GET["id"];
			//print_r($_SESSION);
			?>
			<h1>Smoking Violation Details</h1>
			<br>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
			$id = $_GET["id"]; 
			
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM violations WHERE violation_id = '$id'"); 
				$stmt->execute();
				
		if ($data = $stmt->fetch()){
				echo "<table style='float:left;'>";
				echo "<tr><th style='height:20px;'>ID</th></tr><tr><th style='height:20px;'>Date</th></tr><tr><th style='height:20px;'>Time</th></tr><tr><th style='height:20px;'>First Name</th></tr><tr><th style='height:20px;'>Last Name</th></tr><tr><th style='height:20px;'>Description</th></tr><tr><th style='height:20px;'>Department</th></tr><tr><th style='height:20px;'>Supervisor</th></tr><tr><th style='height:20px;'>Place</th></tr></table><table style='float:left;'>";

			class TableRows extends RecursiveIteratorIterator { 
				function __construct($it) { 
					parent::__construct($it, self::LEAVES_ONLY); 
				}

				function current() {
					return "<tr><td style='height:20px;'>" . parent::current(). "</td></tr>";
				}

				function beginChildren() { 
					echo "<tr>"; 
				} 

				function endChildren() { 
					echo "</tr>" . "\n";
				} 
			} 
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT violation_id, date, time, v_firstname, v_surname, description, v_department, v_supervisor, place FROM violations WHERE violation_id='$id' AND status = 'Unpaid' AND violation_type = 'Other'"); 
				$stmt->execute();
				// set the resulting array to associative
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
				foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
					echo $v;
				}
				echo "</table>";
			}
			else{
				echo "None";
			}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
			

				$id = isset($_GET['id']) ? $_GET['id'] : NULL;
				$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$sth = $db->prepare("SELECT permit_id, firstname, surname, email, mobile, department, duration, start_date, end_date, vehicle_type FROM permits WHERE permit_id='$id'");
				$sth->bindParam(':id', $id, PDO::PARAM_INT);
				$sth->setFetchMode(PDO::FETCH_OBJ);
				$sth->execute();

				$row = $sth->fetch();
			?>
        </div>
    </body>
</html>