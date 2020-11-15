<!doctype html>

<!-- Kakaan, Mikkekj, Frroje, Notto -->

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Users</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
	<?php include 'header.php'; ?>
	
	<section>
		<article>
		<h1>RECENTLY JOINED USERS</h1>
			<div class="user-heading-container">
				<h3>USERNAME</h3>
				<h3>JOINED ON</h3>
				<h3>POST AMOUNT</h3>
			</div>
		<?php
		foreach(get_users() as $uid){
				$user = get_user_by_uid($uid);
				echo "<div class='forum-user-container'>",
					 "<span>", "<a href='individual_user.php?uid=" . $uid . "'>", $user['uid'], "</a>", "</span>",
					 "<span>", $user['date'], "</span>",
					 "<span>", $user['pid'], "</span>",
					 "</div>";
			}
		?>
	</article>
	</section>
	
	<?php include 'footer.php'; ?>
</body>
</html>