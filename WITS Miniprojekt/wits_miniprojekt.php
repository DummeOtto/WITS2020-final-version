<!doctype html>

<!-- Kakaan, Mikkekj, Frroje, Notto -->

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WITS Miniprojekt</title>
<link rel="stylesheet" type="text/css" href="style.css"/> <!-- link to css stylesheet -->
</head>

<body>
	<?php include 'header.php'; ?>  <!-- include the header used across all pages -->

	<section>
		<article> <!-- Container for the left side of the home page -->
		
		<h1>MOST RECENT POSTS</h1>
		<div class="forum-heading-container">
			<h3>LIKES</h3>
			<h3>SUBJECT TITLE</h3>
			<h3>USERNAME</h3>
			<h3>POSTED ON</h3>
		</div>
		<?php

			require_once '/home/mir/forum/forum.php'; //connect to array "database"
			
			$postList = get_posts();
			$post = get_post_by_pid($postList);
			
			function sort_by_date($element1, $element2) { //sort function
				$datetime1 = strtotime($element1['date']); //string to time conversion
				$datetime2 = strtotime($element2['date']); //string to time conversion
				return $datetime1 - $datetime2; //compare 
				//date_diff
			}
			
			usort($post, 'sort_by_date'); //sort array $post using function above
			
			$counter = 0;
			
			foreach($postList as $pid){ //get all posts & their likes and print them
				$post = get_post_by_pid($pid);
				$likes = count_likes_by_pid($pid);
				if(isset($post['title']) && isset($post['parent_pid']) && $post['parent_pid'] == 0){ //only main posts
					$counter++;
					if($counter > 10) break; //only show 10
					echo "<div class='forum-post-container'>", //print post information with correct html structure
						 	"<span class='likes'>", $likes, "</span>",
						 	"<span>", 
								"<a href='individual_post.php?pid=" . $pid . "'>", $post['title'], "</a>", 
							"</span>",
							"<span>", $post['uid'], "</span>",
						 	"<span>", $post['date'], "</span>",
						 "</div>";
					}
			}
			?>
			<?php
			echo '<div class="direction">', 
				 	'<a href="forum.php">See All Posts</a>',
				 '</div>';
				 
			if(!empty($_SESSION['uid'])){ //show add post container if user is signed in
			echo 
				 '<div class="addPostContainer">', 
				 	'<div class="addPostContent">',
				 		'<form action="add_post.php" method="GET">',
				 			'<h3>', 'Add a post','</h3>',
							'<input type="hidden" name="parent_pid" value="0">',
				 			'<label for="title"><b>','Title','</b><label>',
				 			'<input type="text" placeholder="Enter a title of your post" name="title" required>',
				 			'<label for="title"><b>','Content','</b><label>',
				 			'<input type="text" placeholder="Enter the content of your post" name="content" required>',
				 			'<button type="submit">','Add Post','</button>',
				 		'</form>',
				 	'</div>', 
				 '</div>';
			}
			?>
			
	
		</article>
		
		<aside>  <!-- Container for the right side of the home page -->
			<h1>RECENTLY JOINED USERS</h1>
			<div class="user-heading-container">
				<h3>USERNAME</h3>
				<h3>JOINED ON</h3>
			</div>
			<?php

			require_once '/home/mir/forum/forum.php'; //connect to array "database"
			
			$userList = get_users();

			usort($userList, 'sort_by_date'); //sort list of users by date
			
			$counter = 0; 
			
			foreach($userList as $uid){ //get all sorted user information and display it
				$counter++;
				$user = get_user_by_uid($uid);
				if($counter > 10) break; //only show 10
				echo "<div class='forum-user-container'>", //print user information
					 "<span>", "<a href='individual_user.php?uid=" . $uid . "'>", $user['uid'], "</a>", "</span>",
					 "<span>", $user['date'], "</span>",
					 "</div>";
			}
			?>
			<div class="direction"> 
				<a href="users.php">See All Users</a>
			</div>
		</aside>
	</section>
	<?php include 'footer.php'; ?>  <!-- include footer used on all pages -->
</body>
</html>
