<?php 

session_start();

require_once '/home/mir/forum/forum.php';

$uid = $_GET['uid'];
$pid = $_GET['pid'];

if(!empty($_SESSION['uid']) && $_SESSION['uid'] == $uid) {
	if(delete_post($pid)){
		header('location: ' . $_SERVER['HTTP_REFERER']);
	} else {
		header('location: ' . $_SERVER['HTTP_REFERER']);
	}
} else {
	header('location: ' . $_SERVER['HTTP_REFERER']);
}

?>