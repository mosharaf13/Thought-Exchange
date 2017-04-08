<?php
include "database.php";
session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Thought Exchange</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="../css/mystyle.css" rel="stylesheet" type="text/css" media="all">
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
	<link href="file://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="header-top">
				<div class="logo">
					<h1><a href="index.php">Thought Exchange</a></h1>
				</div>
				<?php
				if($_SESSION['id'])
				{
					?>
					<div class="phone">
						<ul class="nav navbar-nav ">
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div>
					<?php
				}
				else
				{
					?>
					<div class="phone">
						<ul class="nav navbar-nav ">
							<li><a href="process/login.php">Login</a></li>
						</ul>
					</div>
					<?php	
				}
				?>
			</div>
			<div class="header-bottom">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="collapse navbar-collapse">
							<ul class="nav navbar-nav ">
								<li class="active"><a href="../index.php">Home<span class="sr-only">(current)</span></a></li>
								<li><a href="">About</a></li>
								<li><a href="">questions</a></li>
								<li><a href="">Tags</a></li>
								<li><a href="ask.php">Ask Question</a></li>
								<li><a href="">Contact</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>
	<div id="leftpanel">
		<ul class="nav">
			<li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
			<li><a href="">About</a></li>
			<li><a href="">questions</a></li>
			<li><a href="">Tags</a></li>
			<li><a href="process/Ask.php">Ask Question</a></li>
			<li><a href="">Contact</a></li>
		</ul>
	</div>
	<div id="section">
		<div class="login">
			 <form action="adminregisterprocess.php" method="post" name="login">
			 	<h4>Choose a username:</h4>
				<input type="text" name="username" placeholder="Enter a Username"/>
				<h4>Choose a password:</h4>
				<input type="password" name="password" placeholder="***"/>
				<h4>Enter your email address:</h4>
				<input type="text" name="email" placeholder="email"/>
				<h4>Enter the admin password given to you</h4>
				<input type="password" name="adminpassword" placeholder="***"/>
				<input type="submit" name="login_submit" value="Sign up"/>
			</form>
		</div>
	</div>
	
	<div id="rightpanel">
		<?php
		if($_SESSION['name'])
		{
			$userid=$_SESSION['id'];
			$username2=$_SESSION['name'];
			$sqlimage = "SELECT * FROM user WHERE user_id = '$userid'";
			$result = mysql_query($sqlimage);
			$rows = mysql_fetch_array($result);       
			$imagename=$rows['img_name'];
			?>
			<div class="status-grid_pic">
				<img src="<?php echo $imagename; ?>"alt="profile picture" height="200" width="200">	
				<h4><a href="profile.php"><?php echo $username2 ?></a><h4>

				</div>

				<?php 
			}
			?>

		</div>

	</body>
	</html>