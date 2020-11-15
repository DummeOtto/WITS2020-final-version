<!doctype html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Post</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

	<?php include 'header.php'; ?>

    <?php

    require_once '/home/mir/forum/forum.php';
	
    $pid = $_GET['pid'];
	$uid = $_GET['uid'];
	//Show all attributes of current post
    $indi_post = get_post_by_pid($pid);
	$likes = count_likes_by_pid($pid);
      echo "<div class='individual_post_container'>", 
		 		"<div class='individual_post_content'>",
					"<span>", 
						"<img class='profile' src='img/profile.png'>" /*. $indi_post['uid'] . ".png">"*/, 
						"<h2>", "<a href='individual_user.php?uid=" . $indi_post['uid'] . "'>", $indi_post['uid'], "</a>", "</h2>", 
					"</span>",
           			"<span>", 
						"<h1>", $indi_post['title'], "</h1>", 
						$indi_post['content'], 
					"</span>",
					"<span>
						<i>Posted ", $indi_post['date'], "</i>", 
						"<div class='likes_container'>", 
							'<form action="like.php" method="GET">',
							'<input type="hidden" name="pid" value='. $indi_post['pid'] .'>',
							'<button type="submit">', '<img class="like" src="img/like.png">', '</button>',
							'</form>',
							$likes, 
							'<form action="dislike.php" method="GET">',
							'<input type="hidden" name="pid" value='. $indi_post['pid'] .'>',
							'<button type="submit">', '<img class="like" src="img/dislike.png">', '</button>',
						'</form>',  
						"</div>"; ?> 
						<?php if(!empty($_SESSION['uid']) && $_SESSION['uid'] == $indi_post['uid']){ ?>
					<button id="editPost" onClick="document.getElementById('postEditModal').style.display='block'">Edit</button>
					<?php }
					echo "</span>",
				"</div>", 
			"</div>";
	?>
	<?php
	//Show all comments and comment information
	$comments = get_posts_by_parent_pid($pid);
	foreach ($comments as $pos){
	$comment = get_post_by_pid($pos);
	$commentLikes = count_likes_by_pid($pos);
	echo "<div class='individual_comment_container'>", 
			"<div class='individual_comment_content'>",
				"<span>", 
					"<img class='profile' src='img/profile.png'>", 
					"<h2>", "<a href='individual_user.php?uid=" . $comment['uid'] . "'>", $comment['uid'], "</a>", "</h2>", 
				"</span>", 
				"<span>", 
					"<h1>Re: ", $comment['title'], "</h1>", 
					$comment['content'],
				"</span>", 
		 		"<span>
					<i>Posted ", $comment['date'], "</i>", 
					"<div class='likes_container'>", 
						'<form action="like.php" method="GET">',
							'<input type="hidden" name="pid" value='. $comment['pid'] .'>',
							'<button type="submit">', '<img class="like" src="img/like.png">', '</button>',
						'</form>',
						$commentLikes, 
						'<form action="dislike.php" method="GET">',
							'<input type="hidden" name="pid" value='. $comment['pid'] .'>',
							'<button type="submit">', '<img class="like" src="img/dislike.png">', '</button>',
						'</form>', 
					"</div>"; ?>
					<?php if(!empty($_SESSION['uid']) && $_SESSION['uid'] == $comment['uid']){
					?>
					<button id="editPost" onClick="document.getElementById('commentEditModal').style.display='block'">Edit</button>
					<?php }
				echo "</span>",
		 	"</div>",
		"</div>";
	}
	?>
	<?php
	//Add comment
	if(!empty($_SESSION['uid'])){
			echo 
				 '<div class="addCommentContainer">', 
				 	'<div class="addPostContent">',
				 		'<form action="add_post.php" method="GET">',
				 			'<h3>', 'Add a post','</h3>',
							'<input type="hidden" name="parent_pid" value="'. $pid .'">',
				 			'<input type="hidden" name="title" value="'. $indi_post['title'] .'">',
				 			'<label for="content"><b>','Content','</b><label>',
				 			'<input type="text" placeholder="Enter the content of your comment" name="content" required>',
				 			'<button type="submit">','Add Comment','</button>',
				 		'</form>',
				 	'</div>', 
				 '</div>';
			}

    ?>
	
	<div id="postEditModal" class="postEditContainer">
	<div class="modal-content animate">
    <form class="#" action="update.php" method="GET">

      <div class="update-container">
        <label for="title"><b>Title</b></label>
        <input type="text" placeholder="<?php echo $indi_post['title']; ?>" name="title" value="<?php echo $indi_post['title']; ?>">

        <label for="content"><b>Content</b></label>
        <input type="text" placeholder="<?php echo $indi_post['content']; ?>" name="content" value="<?php echo $indi_post['content']; ?>">

        <button type="submit">Submit Changes</button>
      </div>
	</form>

      <div class="postEditContainerBottom">
		<form action="delete.php" method="GET">
			<input type="hidden" name="uid" value="<?php echo $indi_post['uid']; ?>">
			<input type="hidden" name="pid" value="<?php echo $indi_post['pid']; ?>">
			<button type="submit" onClick="delete.php">Delete Comment</button>
		</form>
		<button type="button" onClick="document.getElementById('postEditModal').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
	</div>
  </div>
	
	<div id="commentEditModal" class="login-modal">
		<div class="modal-content animate">
		<form class="#" action="update.php" method="GET">

		  <div class="update-container">
			<label for="title"><b>Title</b></label>
			<input type="text" placeholder="<?php echo $indi_post['title']; ?>" name="title" value="<?php echo $comment['title']; ?>">

			<label for="content"><b>Content</b></label>
			<input type="text" placeholder="<?php echo $comment['content']; ?>" name="content" value="<?php echo $comment['content']; ?>">

			<button type="submit">Submit Changes</button>
		  </div>
		</form>

		  <div class="commentEditContainerBottom">
			<form action="delete.php" method="GET">
				<input type="hidden" name="uid" value="<?php echo $comment['uid']; ?>">
				<input type="hidden" name="pid" value="<?php echo $comment['pid']; ?>">
				<button type="submit" onClick="delete.php">Delete Comment</button>
			</form>
			<button type="button" onClick="document.getElementById('commentEditModal').style.display='none'" class="cancelbtn">Cancel</button>
		  </div>
		</div>
	  </div>



  <?php include 'footer.php'; ?>

</body>
</html>
