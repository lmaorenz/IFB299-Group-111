<?php
//if form is submitted
    if (isset($_POST['Submit']))
    {
		//assign variables according to $_SESSION['id'] and posted variables from form
		session_start();
		$id=$_SESSION['id'];
		$firstname=$_POST['First'];
		$surname=$_POST['Last'];
		$start_time=$_POST['time'];
		$start_date=$_POST['date'];
		$department=$_POST['department'];
		$description=$_POST['desc'];
		$end_time=$_POST['endtime'];
		$end_date=$_POST['enddate'];
		$resolution=$_POST['res'];
		$status=$_POST['status'];

		
		//pdo query to database to update details of report with information user submitted
		$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$sql = "UPDATE health SET firstname=:firstname, surname=:surname, start_time=:start_time, start_date=:start_date, department=:department, description=:description, end_time=:end_time, end_date=:end_date, resolution=:resolution, status=:status WHERE health_id=:id";
        $query = $pdo->prepare($sql);
		$query->bindValue("firstname", $firstname);
		$query->bindValue("surname", $surname);
		$query->bindValue("start_time", $start_time);
		$query->bindValue("start_date", $start_date);
		$query->bindValue("department", $department);
		$query->bindValue("description", $description);		
		$query->bindValue("end_time", $end_time);
		$query->bindValue("end_date", $end_date);
		$query->bindValue("resolution", $resolution); 
        $query->bindValue(":status", $status);
        $query->bindValue(":id", $id);
		
        $result = $query->execute();
		
		//redirect with ?submitsuccess=true
		header("Location: http://{$_SERVER['HTTP_HOST']}/writereports.php?submitsuccess=true"); 
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
        <script type="text/javascript" src="/js/check.js"></script>
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
		<div id='captionHead'>Update Health and Safety Report</div>
        <div id="container">
			<?php
			session_start();
			$_SESSION['id']=$_GET["id"]; //get id from previous page, set as session id
			?>
			<div class='caption'>Report Information</div>
			<br>
			<?php
			$servername = "localhost";
			$username = "anchorco_admin";
			$password = "password";
			$dbname = "anchorco_ifb299";
			$id = $_GET["id"];
		
//try pdo query to database to access all information from health table for the entry that matches $id		
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT * FROM health WHERE health_id = '$id'"); 
				$stmt->execute();
				
		//if data is not null
		if ($data = $stmt->fetch()){
			//then start a table and echo the right headings
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
			//select appropriate fields from health table for $id entry
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("SELECT health_id, firstname, surname, start_date, start_time, department, description, end_date, end_time, resolution FROM health WHERE health_id='$id'"); 
				$stmt->execute();
				
				//while there are still rows to echo:
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					//create table row
					echo "<div class='row'>";
                    echo "<input type='radio' name='expand'>";
					//input information into cells
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
					echo "</div>"; //end row
				}

				echo "</div>"; //end table
			}
			//else if no data matching $id
			else{
				echo "None";
			}
			}
			catch(PDOException $e) { //try/catch exception
				echo "Error: " . $e->getMessage();
			}
			$conn = null; //end connection
			

				$id = isset($_GET['id']) ? $_GET['id'] : NULL;
				$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$sth = $db->prepare("SELECT status, firstname, surname, start_date, start_time, department, description, end_date, end_time, resolution FROM health WHERE health_id='$id'");
				$sth->bindParam(':id', $id, PDO::PARAM_INT);
				$sth->setFetchMode(PDO::FETCH_OBJ);
				$sth->execute();

				$row = $sth->fetch();
			?>
			<form name="edit" action="editreports.php" method="post" onSubmit="return checkTime()">
					<h2>Name</h2>
                        <input type="text" name="First" value="<?php echo $row->firstname; ?>" required/>
                        <input type="text" name="Last" value="<?php echo $row->surname; ?>" required/>
					<h2>Time and Date</h2>
                        <input type="text" name="time" value="<?php echo $row->start_time; ?>" required>
                        <input type="date" name="date" value="<?php echo $row->start_date; ?>" required>
                    <h2>Department</h2>
                        <select name="department" value="<?php echo $row->department; ?>">
                            <option>Dpt of Astrology</option>
                            <option>Dpt of Science</option>
                            <option>Dpt of Time and Space</option>
                            <option>Dpt of Health and Safety</option>
                        </select>
					<h2>Description</h2>
                        <textarea row="8" cols="50" name="desc"><?php echo $row->description; ?></textarea>
					<br>
					<h2>End Time and End Date</h2>
                        <input type="text" name="endtime" value="<?php echo $row->end_time; ?>">
                        <input type="date" name="enddate" value="<?php echo $row->end_date; ?>">
					<h2>Resolution</h2>
                        <textarea row="8" cols="50" name="res"><?php echo $row->resolution; ?></textarea>
                    <h2>Status</h2>
                        <select name="status" value="<?php echo $row->status; ?>">
                            <option>Unresolved</option>
                            <option>Resolved</option>
                        </select>
                    <br>
                    <input type="submit" name="Submit" value="Submit">
                </form>
        </div>
    </body>
</html>