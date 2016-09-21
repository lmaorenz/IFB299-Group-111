<?php
    if (isset($_POST['Submit']))
    {
		session_start();
	    // validate posted username and password here
		require 'submit.inc';	
		
		$v_firstname=$_POST['First'];
		$v_surname=$_POST['Last'];
		$time=$_POST['time'];
		$date=$_POST['date'];
		$description=$_POST['desc'];
		$v_department=$_POST['department'];
		$v_supervisor=$_POST['supervisor'];
		$violation_type=$_POST['violation'];
		$place=$_POST['place'];
		
		/**
		if(fail)
		{	
			header("Location: http://{$_SERVER['HTTP_HOST']}/smoking.php?submitfail=true");
            exit();
		}
		else {**/
			//INPUT APPROPRIATE DATA
			smoking($v_firstname, $v_surname, $time, $date, $v_department, $v_supervisor, $place, $violation_type, $description);
			
			
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
		//}
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
        if (isset($_GET['submitfail'])){
			echo "<h1>Form submission failed</h1>";	
			}
		?>
        <div id="header">
            <img src="pics/logo.png" alt="Anchor parking and fine management"></image>
        </div>
        <div id="container">
            <div id="body">
			<h1>Non-Parking Violation</h1>
                <form action="smoking.php" method="post">
                    <h2>Time and Date</h2>
                        <input type="text" name="time">
                        <input type="date" name="date">
                    <br>
                    <h2>Description</h2>
                    <textarea row="8" cols="50" name="desc"></textarea>
					<h2>Violation Type</h2>
                        <select name="violation">
                            <option>Smoking</option>
                            <option>Other</option>
						</select>
					<h2>Violator's Name</h2>
                        <input type="text" name="First" placeholder="First"/>
                        <input type="text" name="Last" placeholder="Last"/>
                    <h2>Violator's Department</h2>
                        <select name="department">
                            <option>Dpt of Astrology</option>
                            <option>Dpt of Science</option>
                            <option>Dpt of Time and Space</option>
                            <option>Dpt of Health and Safety</option>
                        </select>
                    <h2>Violator's Supervisor</h2>
                        <input type="text" name="supervisor" placeholder="Supervisor Name"/>
					<h2>Location of Violation</h2>
                        <input type="text" name="place" placeholder="Campus Location"/>
                    <br>
                    <input type="submit" name="Submit" value="Submit">
                </form>
                
            </div>
        </div>
    </body>
</html>