<?php 
session_start();

require_once '/home/mir/forum/forum.php';

logout();

header('location: ' . $_SERVER['HTTP_REFERER']);

?>