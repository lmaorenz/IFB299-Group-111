<?php
    if (isset($_POST['login']))
    {
		session_start();
	    
		require 'authentication.inc';	
		
		$username=$_POST['username']; //username and password posted by form (basically what the user entered on login screen)
		$password=$_POST['password'];
		$permission = "";
		
		// validate posted username and password here
        if(!checkPassword($username, $password))
		{	
			header("Location: http://{$_SERVER['HTTP_HOST']}/Index.php?loginfail=true");
            exit();
		}
		else { //if checkPassword returns TRUE (combination exists in database) --> see authentication.inc
		
		//then check what permission the user has in the database, set $_SESSION variable and redirect them to the appropriate menu page.
		
			if (strcmp(checkPermission($username, $password, $permission),'admin')==0){ //example: if user is an ADMIN
				$_SESSION['isAdmin'] = true;
				$_SESSION['isCollege'] = false;
				$_SESSION['isVisitor'] = false;
				$_SESSION['isPatrol'] = false;
				$_SESSION['username'] = $username;
				$_SESSION['surname'] = returnSurname($username);
				$_SESSION['firstname'] = returnFirstname($username);
				$_SESSION['email'] = returnEmail($username);
				$_SESSION['mobile'] = returnMobile($username);
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuAd.php"); 
				exit();
			}
			if ((strcmp(checkPermission($username, $password, $permission),'staff')==0)||(strcmp(checkPermission($username, $password, $permission),'student')==0)){ //if user is STAFF or STUDENT
				$_SESSION['isCollege'] = true;
				$_SESSION['isVisitor'] = false;
				$_SESSION['isPatrol'] = false;
				$_SESSION['isAdmin'] = false;
				$_SESSION['username'] = $username;
				$_SESSION['surname'] = returnSurname($username);
				$_SESSION['firstname'] = returnFirstname($username);
				$_SESSION['email'] = returnEmail($username);
				$_SESSION['mobile'] = returnMobile($username);
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuStu.php");
				exit();
			}
			if (strcmp(checkPermission($username, $password, $permission),'visitor')==0){
				$_SESSION['isVisitor'] = true;
				$_SESSION['isPatrol'] = false;
				$_SESSION['isAdmin'] = false;
				$_SESSION['isCollege'] = false;
				$_SESSION['username'] = $username;
				$_SESSION['surname'] = returnSurname($username);
				$_SESSION['firstname'] = returnFirstname($username);
				$_SESSION['email'] = returnEmail($username);
				$_SESSION['mobile'] = returnMobile($username);
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuVis.php");
				exit();
			}
			if (strcmp(checkPermission($username, $password, $permission),'patrol')==0){
				$_SESSION['isPatrol'] = true;
				$_SESSION['isAdmin'] = false;
				$_SESSION['isCollege'] = false;
				$_SESSION['isVisitor'] = false;
				$_SESSION['username'] = $username;
				$_SESSION['surname'] = returnSurname($username);
				$_SESSION['firstname'] = returnFirstname($username);
				$_SESSION['email'] = returnEmail($username);
				$_SESSION['mobile'] = returnMobile($username);
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuPo.php");
				exit();
			}
		}
    }
	//if user clicked 'sign up'
	if (isset($_POST['create']))
    {
		session_start();
		require 'signup.inc';	
		
		$firstname=$_POST['First'];
		$surname=$_POST['Last'];
		$username=$_POST['Username'];
		$password=$_POST['Password'];
		$email=$_POST['Email'];
		$mobile=$_POST['Mobile'];
		$permission=$_POST['department'];
		
		// validate posted username and password here
		if(unique_u($username))
		{	
			header("Location: http://{$_SERVER['HTTP_HOST']}/Index.php?usernamefail=true");
            exit();
		}
		else if(unique_e($email))
		{	
			header("Location: http://{$_SERVER['HTTP_HOST']}/Index.php?emailfail=true");
            exit();
		}
		else {
			//INPUT APPROPRIATE DATA
			create($firstname, $surname, $username, $password, $mobile, $email, $permission);
			
			//REROUTE TO APPROPRIATE HOME, set $_SESSION variables
			if (strcmp($permission,'admin')==0){
				$_SESSION['isAdmin'] = true;
				$_SESSION['isCollege'] = false;
				$_SESSION['isVisitor'] = false;
				$_SESSION['isPatrol'] = false;
				$_SESSION['username'] = $username;
				$_SESSION['surname'] = $surname;
				$_SESSION['firstname'] = $firstname;
				$_SESSION['email'] = $email;
				$_SESSION['mobile'] = $mobile;
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuAd.php"); 
				exit();
			}
			if ((strcmp($permission,'staff')==0)||(strcmp($permission,'student')==0)){
				$_SESSION['isCollege'] = true;
				$_SESSION['isVisitor'] = false;
				$_SESSION['isPatrol'] = false;
				$_SESSION['isAdmin'] = false;
				$_SESSION['username'] = $username;
				$_SESSION['surname'] = $surname;
				$_SESSION['firstname'] = $firstname;
				$_SESSION['email'] = $email;
				$_SESSION['mobile'] = $mobile;
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuStu.php");
				exit();
			}
			if (strcmp($permission,'visitor')==0){
				$_SESSION['isVisitor'] = true;
				$_SESSION['isPatrol'] = false;
				$_SESSION['isAdmin'] = false;
				$_SESSION['isCollege'] = false;
				$_SESSION['username'] = $username;
				$_SESSION['surname'] = $surname;
				$_SESSION['firstname'] = $firstname;
				$_SESSION['email'] = $email;
				$_SESSION['mobile'] = $mobile;
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuVis.php");
				exit();
			}
			if (strcmp($permission,'patrol')==0){
				$_SESSION['isPatrol'] = true;
				$_SESSION['isAdmin'] = false;
				$_SESSION['isCollege'] = false;
				$_SESSION['isVisitor'] = false;
				$_SESSION['username'] = $username;
				$_SESSION['surname'] = $surname;
				$_SESSION['firstname'] = $firstname;
				$_SESSION['email'] = $email;
				$_SESSION['mobile'] = $mobile;
				header("Location: http://{$_SERVER['HTTP_HOST']}/menuPo.php");
				exit();
			}
		}
    }
?>
<html> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Anchor</title>
        <meta name="description" content="Index screen">
        <link rel="stylesheet" href="/css/style.css">
        <script type="text/javascript" src="/js/check.js"></script>
    </head>
    <body>
		<?php //display correct dynamic messages according to $_GET
        if (isset($_GET['loginfail'])){
			echo "<h1>Login failed</h1>";	
			}
		if (isset($_GET['usernamefail'])){
			echo "<h1>Username already taken</h1>";	
			}
		if (isset($_GET['emailfail'])){
			echo "<h1>Email address already in use</h1>";	
			}
		if (isset($_GET['signout'])){
			require 'destroy.inc';
			echo "<h1>You are signed out</h1>";
		}
		if (isset($_GET['kicked'])){
			require 'destroy.inc';
			echo "<h1>You have been kicked for attempting to access privileged information</h1>";
		}
		if (isset($_GET['home'])){
			require 'home.inc'; //redirect to appropriate home page
		}
		?>
        <div id="headerLogin">
            <img src="pics/logo.png" alt="Anchor parking and fine management"></image>
        </div>
        <div id="container">
            
                <div id="loginLeft">
                    <h1>Log into existing account</h1>
                    <form action="index.php" method="post">
                        <input type="text" name="username" placeholder="Username"/>
                            <br>
                        <input type="password" name="password" placeholder="Password"/>
                            <br>
                        <input type="submit" name="login" value="Login"/>
                    </form>
                </div>
            
			<div id="loginRight">
                    <h1>Create New User</h1>
                    <form name ="Create" method="post" action="index.php" onsubmit="return CheckCreate()">
                        <input type="text" name="First" placeholder="First Name" required/>
                            <br>
                        <input type="text" name="Last" placeholder="Last Name" required/>
                            <br>
                        <input type="text" name="Username" placeholder="Username" required/>
                            <br>
                        <input type="text" name="Email" placeholder="Example@mail.com" required/>
                            <br>
                        <input type="text" name="Mobile" placeholder="Mobile number" required/>
                            <br>
                        <input type="password" name="Password" placeholder="Password" required/>
                            <br>
                        <input type="text" name="Confirm Password" placeholder="Confirm Password" required/>
                            <br>
                        <select name="department">
                            <option>admin</option>
                            <option>staff</option>
                            <option>student</option>
							<option>visitor</option>
							<option>patrol</option>
                        </select>
						<br>
                        <input type="submit" name="create" value="Create User"/>
                    </form>
                </div>
        </div>
    </body>
</html>