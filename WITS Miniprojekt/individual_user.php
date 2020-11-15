<!doctype html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

<?php include 'header.php';?>

<?php 
	require_once '/home/mir/forum/forum.php'; //connect to array "database"
	
	$a = get_users();
	foreach($a as $b) {
	$c = get_user_by_uid($a);
	};
?>
	
<div class="top-profile-container">
	<div class="profile-banner"><img src="img/profile.png"></div>
	<div class="profile-stats">
		<span>
			<h2>Total Posts</h2>
			<p><?php 
					 $uid = $_GET['uid'];
					 $p = count(get_posts_by_uid($uid)); 
				echo $p;
					 ?></p>
		</span>
		<span>
			<h2>Joined</h2>
			<p><?php $date = $_GET['uid'];
				echo $uid['date'];?></p>
		</span>
		<span>
			<button><i>Edit</i></button>
		</span>
	</div>
</div>
	
<div class="profile-flex-container">
	<aside class="profile-aside">
		<div class="profile-info-heading">
			<h2>Profile Information</h2>
		</div>
		<div class="profile-info-content">
			<ul>
				<li><?php echo $_GET['uid'];?></li>
				<li>Yadda</li>
				<li>Yadda</li>
			</ul>
		</div>
	</aside>
	
	<article class='profile-posts'>
	<?php

			require_once '/home/mir/forum/forum.php'; //connect to array "database"
			
			$uid = $_GET['uid'];
			$p = get_posts_by_uid($uid);
			
			foreach($p as $sutmig){ //get all posts & their likes and print them
				$post = get_post_by_pid($sutmig);
				$likes = count_likes_by_pid($pid);
				if(isset($post['title']) && isset($post['parent_pid']) && $post['parent_pid'] == 0){ //only main posts
					echo  //print post information with correct html structure
							"<div class='individual-profile-post'>",
								"<a href='individual_post.php?pid=" . $pid . "'>",
									"<span>", 
										"<h2>", $post['title'], "</h2>",
										$post['content'],
									"</span>",
									"<span>", 
										"<i>", $post['date'], "</i>",
										"<img src='img/like.png'>",
										$likes,
										"<img src='img/dislike.png'>", 
									"</span>",
								"</a>",
							"</div><br>";
					}
			}
			?>
	</article>
	<article class="profile-posts">
		<div class="individual-profile-post">
				<span>
					<h2>PHP post heading</h2>
					<p>PHP post content</p>
				</span>
				<span>
					<i>PHP post date</i><br>
					<img src="img/like.png">
					<p>PHP post likes</p>
					<img src="img/dislike.png">
				</span>
			</div>
	</article>
</div>
	
<?php
/*
require_once '/home/mir/forum/forum.php';

		if(!empty($_SESSION['uid'])) {
			echo "Welcome ", $_SESSION['uid'], " you have successfully logged in";
		}

$uid = $_GET['uid'];

$indi_user = get_user_by_uid($uid);
  echo "<div class='individual_user_container'>",
       "<span>", $indi_user['uid'], "</span>",
       "<span>", $indi_user['name'], "</span>",
       "<span>", $indi_user['date'], "</span>",
       "</div>";

$allPosts = get_post_by_pid($uid);

echo "<div class='individual_user_container'>",
     $allPosts,
     "</div>";

*/
?>

<?php include 'footer.php';?>

</body>
</html>
