<?php
	session_start();

	require_once '/home/mir/forum/forum.php';
	
	$pid = $_GET['pid'];
	
	if(!empty($_SESSION['uid'])) {
		if(add_like($pid, $_SESSION['uid'])) {
			header('location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else {
		header('location: ' . $_SERVER['HTTP_REFERER']);
	}
?>