<?php
    function permit($firstname, $surname, $email, $mobile, $start_date, $end_date, $department, $duration, $vehicle_type){
		$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$query=$pdo->prepare("INSERT INTO permits(firstname, surname, email, mobile, start_date, end_date, department, duration, vehicle_type)
					VALUES(:firstname, :surname, :email, :mobile, :start_date, :end_date, :department, :duration, :vehicle_type)");
		$query->bindValue(':firstname', $firstname);
		$query->bindValue(':surname', $surname);
		$query->bindValue(':email', $email);
		$query->bindValue(':mobile', $mobile);
		$query->bindValue(':start_date', $start_date);
		$query->bindValue(':end_date', $end_date);
		$query->bindValue(':department', $department);
		$query->bindValue(':duration', $duration);
		$query->bindValue(':vehicle_type', $vehicle_type);
		$query->execute();
	}
	
	function report($firstname, $surname, $start_time, $start_date, $department, $description){
		$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$query=$pdo->prepare("INSERT INTO health(firstname, surname, start_time, start_date, department, description)
					VALUES(:firstname, :surname, :start_time, :start_date, :department, :description)");
		$query->bindValue(':firstname', $firstname);
		$query->bindValue(':surname', $surname);
		$query->bindValue(':start_time', $start_time);
		$query->bindValue(':start_date', $start_date);
		$query->bindValue(':department', $department);
		$query->bindValue(':description', $description);
		$query->execute();
	}

	function parking($time, $date, $v_firstname, $v_surname, $violation_type, $description, $vehicle_type, $license, $permit, $permit_id){
		$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$query=$pdo->prepare("INSERT INTO violations(time, date, v_firstname, v_surname, violation_type, description, vehicle_type, license, permit, permit_id)
					VALUES(:time, :date, :v_firstname, :v_surname, :violation_type, :description, :vehicle_type, :license, :permit, :permit_id)");
		$query->bindValue(':time', $time);
		$query->bindValue(':v_firstname', $v_firstname);
		$query->bindValue(':v_surname', $v_surname);
		$query->bindValue(':date', $date);
		$query->bindValue(':violation_type', $violation_type);
		$query->bindValue(':description', $description);
		$query->bindValue(':vehicle_type', $vehicle_type);
		$query->bindValue(':license', $license);
		$query->bindValue(':permit', $permit);
		$query->bindValue(':permit_id', $permit_id);
		$query->execute();
	}

	function smoking($v_firstname, $v_surname, $time, $date, $v_department, $v_supervisor, $place, $violation_type, $description){
		$pdo = new PDO('mysql:host=localhost;dbname=anchorco_ifb299', anchorco_admin, password);
		$query=$pdo->prepare("INSERT INTO violations(v_firstname, v_surname, time, date, v_department, v_supervisor, place,  violation_type, description)
					VALUES(:v_firstname, :v_surname, :time, :date, :v_department, :v_supervisor, :place, :violation_type, :description)");
		$query->bindValue(':v_firstname', $v_firstname);
		$query->bindValue(':v_surname', $v_surname);
		$query->bindValue(':time', $time);
		$query->bindValue(':date', $date);
		$query->bindValue(':v_department', $v_department);
		$query->bindValue(':v_supervisor', $v_supervisor);
		$query->bindValue(':place', $place);
		$query->bindValue(':violation_type', $violation_type);
		$query->bindValue(':description', $description);
		$query->execute();
	}
?>