<?php
    if (isset($_POST['Submit']))
    {
		session_start();
	    // validate posted username and password here
		require 'submit.inc';	
		
		$firstname=$_SESSION['firstname'];
		$surname=$_SESSION['surname'];
		$start_time=$_POST['time'];
		$start_date=$_POST['date'];
		$department=$_POST['department'];
		$description=$_POST['desc'];
		
			//INPUT APPROPRIATE DATA to database
			report($firstname, $surname, $start_time, $start_date, $department, $description);

/*****EMAIL*****/					

/**EMAIL TO ADMIN**/
	//loop through admins, set new admin email
	//Email information
				$permission = 'admin';
				$subject = "(!)Notification - New H&S Report";
				$comment = "A new health and safety report has been filed in the system. Please log in to your account to follow-up the report.";
				$header = "From: healthandsafetydpt@anchorcollege.x10host.com";
		try {
				$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
				$query = $pdo->prepare("SELECT email FROM users WHERE permission = '$permission'");
				$query->bindValue(':permission', $permission);	
				$query->execute();
				foreach ($query->fetchAll(PDO::FETCH_COLUMN) as $row) {
					$email = $row;
					mail($email, $subject, $comment, $header);	//Send email
				}	
			}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
			
			//REROUTE TO APPROPRIATE HOME
			if ($_SESSION['isAdmin']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuAd.php?submitsuccess=true"); 
				exit();
			}
			if ($_SESSION['isCollege']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuStu.php?submitsuccess=true");
				exit();
			}
			if ($_SESSION['isVisitor']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuVis.php?submitsuccess=true");
				exit();
			}
			if ($_SESSION['isPatrol']){
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuPo.php?submitsuccess=true");
				exit();
			}

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
        if (isset($_GET['submitfail'])){
			echo "<h1>Form submission failed</h1>";	
			}
		?>
        <div id="header">
            <img src="pics/logo.png" alt="Anchor parking and fine management"></image>
        <div id='nav'>
            <ul>
                <li><a href="index.php?home=true">Home</a></li>
                <li><a href="index.php?signout=true">Log Out</a></li>
            </ul>
        </div>
        </div>
        <div id="container">
            <div id="body">
                <form name="edit" action="report.php" method="post" onsubmit="return checkTime()">
				<br>
                    <h2>Time and Date</h2>
                        <input type="text" name="time">
                        <input type="date" name="date" required>
                    <h2>Department</h2>
                        <select name="department">
                            <option>Dpt of Astrology</option>
                            <option>Dpt of Science</option>
                            <option>Dpt of Time and Space</option>
                            <option>Dpt of Health and Safety</option>
                        </select>
					<h2>Description</h2>
                        <textarea row="8" cols="50" name="desc"></textarea>
                    <br>
                    <input type="submit" name="Submit" value="Submit">
                </form>
                
            </div>
        </div>
    </body>
</html>