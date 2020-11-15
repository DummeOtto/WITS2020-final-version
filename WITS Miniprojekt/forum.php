<!doctype html>

<!-- Kakaan, Mikkekj, Frroje, Notto -->

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WITS Miniprojekt</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
	<?php include 'header.php'; ?>

	<section>
		<article>
		<h1>ALL POSTS</h1>
			<div class="forum-heading-container">
			<h3>LIKES</h3>
			<h3>SUBJECT TITLE</h3>
			<h3>USERNAME</h3>
			<h3>POSTED ON</h3>
		</div>
		<?php
		foreach(get_posts() as $pid){
			$post = get_post_by_pid($pid);
			$likes = count_likes_by_pid($pid);
			if(isset($post['title']) && isset($post['parent_pid']) && $post['parent_pid'] == 0){
			echo "<div class='forum-post-container'>",
				 "<span class='likes'>", $likes, "</span>",
				 "<span>", "<a href='individual_post.php?pid=" . $pid . "'>", $post['title'], "</a>", "</span>",
				 "<span>", $post['uid'], "</span>",
				 "<span>", $post['date'], "</span>",
				 "</div>";
			}
		}
		?>
		</article>
	</section>
	
	<?php include 'footer.php'; ?>
</body>
</html>