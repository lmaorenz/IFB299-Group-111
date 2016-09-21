<?php
    function checkPassword($username, $password)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$query = $pdo->prepare("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $query->bindValue(':username', $username);
        $query->bindValue(':password', $password);
        $query->execute();
		return $query->rowCount() > 0;
    }
	
	function checkPermission($username, $password, $permission)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$query = $pdo->prepare("SELECT permission FROM users WHERE username = '$username' AND password = '$password'");
        $query->bindValue(':username', $username);
        $query->bindValue(':password', $password);	
        $query->execute();
		
		while($row=$query->fetch()){ //for each result, do the following
			$permission=$row['permission'];
		}
		return $permission;
    }
?>