<?php
    function unique_u($username)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$query = $pdo->prepare("SELECT * FROM users WHERE username = '$username'");
        $query->bindValue(':username', $username);
        $query->execute();
		return $query->rowCount() > 0;
    }
	
	function unique_e($email)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$query = $pdo->prepare("SELECT * FROM users WHERE email = '$email'");
        $query->bindValue(':email', $email);
        $query->execute();
		return $query->rowCount() > 0;
    }
	
	function create($firstname, $surname, $username, $password, $mobile, $email, $permission)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$query=$pdo->prepare("INSERT INTO users(firstname, surname, username, password, mobile, email, permission)
					VALUES(:firstname, :surname, :username, :password, :mobile, :email, :permission)");
		$query->bindValue(':firstname', $firstname);
		$query->bindValue(':surname', $surname);
		$query->bindValue(':username', $username);
		$query->bindValue(':password', $password);
		$query->bindValue(':mobile', $mobile);
		$query->bindValue(':email', $email);
		$query->bindValue(':permission', $permission);
		$query->execute();
    }
	
?>