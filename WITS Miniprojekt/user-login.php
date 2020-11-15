
<?php

	session_start();
	require_once '/home/mir/forum/forum.php';

	$uid = $_GET['uid'];
	$password = $_GET['password'];

	if(!empty($_GET['uid']) && !empty($_GET['password'])){
		if(login($uid, $password)) //brugernavn og password er korrekt
		{
			echo $_SESSION['uid'];
			header('location: ' . $_SERVER['HTTP_REFERER']);
		} else {
			header('location: wits_miniprojekt.php');
		}
	}


?>
