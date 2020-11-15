<?php

session_start();

require_once '/home/mir/forum/forum.php';

//Update post content
$uid = $_GET['uid'];
$pid = $_GET['pid'];
$title = $_GET['title'];
$content = $_GET['content'];
echo $title, $content;

if(!empty($_SESSION['uid']) && $_SESSION['uid'] == $uid) {
	if(modify_post($pid, $title, $content)){
		echo 'Success';
	} else {
		
	}
} else {
	
}


?>