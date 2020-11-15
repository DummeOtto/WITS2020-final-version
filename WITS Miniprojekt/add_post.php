<?php
	session_start();

	require_once '/home/mir/forum/forum.php';

	$parent_pid = $_GET['parent_pid'];
	$title = $_GET['title'];
	$content = $_GET['content'];

	$newPost = add_post($parent_pid, $title, $content);
		
	if($parent_pid) {
			if($newPost) {
			header('location: ' . $_SERVER['HTTP_REFERER']);
			} else {
			header('location: ' . $_SERVER['HTTP_REFERER']);
			} 
		} else {
		header('location: ' . $_SERVER['HTTP_REFERER']);
	}
?>