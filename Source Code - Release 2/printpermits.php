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
			?>
			<h1>Permit Details</h1>
			<br>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
			$id = $_GET["id"]; 
	
//try retrieving data from permits where permit_id = $id	
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM permits WHERE permit_id = '$id'"); 
				$stmt->execute();
		
		//if data not null
		if ($data = $stmt->fetch()){
			//new table, echo headings
				echo "<table style='float:left;'>";
				echo "<tr><th>ID</th></tr><tr><th>First Name</th></tr><tr><th>Surname</th></tr><tr><th>Start Date</th></tr><tr><th>Start Time</th></tr><tr><th>Department</th></tr><tr><th>Description</th></tr><tr><th>End Date</th></tr><tr><th>End Time</th></tr><tr><th>Resolution</th></tr></table><table style='float:left;'>";

			//create new class to print rows and cells
			class TableRows extends RecursiveIteratorIterator { 
				function __construct($it) { 
					parent::__construct($it, self::LEAVES_ONLY); 
				}

				function current() {
					return "<tr><td>" . parent::current(). "</td></tr>";
				}

				function beginChildren() { 
					echo "<tr>"; 
				} 

				function endChildren() { 
					echo "</tr>" . "\n";
				} 
			} 
				//open pdo to database
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//that selects appropriate fields from permits table where permit_id = $id
				$stmt = $conn->prepare("SELECT permit_id, firstname, surname, email, mobile, department, duration, start_date, end_date, vehicle_type FROM permits WHERE permit_id='$id'"); 
				$stmt->execute();
				// set the resulting array to associative
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
				foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
					echo $v; ///print each row
				}
				echo "</table>"; //end table
			}
			//if data null
			else{
				echo "None";
			}
			}//try/catch exception
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null; //end connection
			

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