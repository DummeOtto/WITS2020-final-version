<!-- Kakaan, Mikkekj, Frroje, Notto -->

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WITS Miniprojekt Header</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
	<header>
		<div class="header-content">
		  <nav>
			<a href="wits_miniprojekt.php"><img src="img/wits_forum_logo.png" alt="forum-logo"></a>
			<a href="forum.php">FORUM</a>
			<a href="users.php">USERS</a>
			<input type="search" placeholder="Search"> 
			<?php 
				session_start(); //starts session

				require_once '/home/mir/forum/forum.php'; //connection to array "database"

				if(!empty($_SESSION['uid'])) { //display logout button and profile link if signed in
					echo "<a class='button' id='id03' href='logout.php'>", "LOGOUT", "</button>";
					echo "<a class='profile_button' href='individual_user.php?uid=" . $_SESSION['uid']. "'>", "<img src='img/profile.png'/>", "</a>";
					} else { //if not signed in, display login and sign up button
			?>
			<button class="button" id="login" onClick="document.getElementById('id01').style.display='block'">LOGIN</button> <!-- login button. displays login form-->
        	<button class="button" id="signup" onClick="document.getElementById('id02').style.display='block'">SIGN UP</button><!-- signup button. displays sign up form -->
			<?php
			}
		?>
      </nav>
    </div>
  </header>

  <div id="id01" class="login-modal"> <!-- login modal -->

    <form class="modal-content animate" action="user-login.php" method="GET">

      <div class="login-container">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uid" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit">LOGIN</button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>

      <div class="login-container">
        <button type="button" onClick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button> <!-- cancel button. makes login modal invisble -->
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
    </form>

  </div>

  <div id="id02" class="signup-modal"> <!-- sign up modal -->

    <form class="modal-content animate" action="user-signup.php" method="GET">

      <div class="signup-container">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uid" required>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Your Name" name="name" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit">SIGN UP</button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>

      <div class="signup-container">
        <button type="button" onClick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button> <!-- cancel button. makes sign up modal invisble -->
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
    </form>

  </div>

</body>
</html>
