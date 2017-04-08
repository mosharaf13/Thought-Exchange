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
				if(isset($_SESSION['id']) || isset($_COOKIE[$cookie_name]))
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
							<li><a href="login.php">Login</a></li>
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
			<form action="login_process.php" method="post" name="login">
				<input type="text" name="uname" placeholder="Enter a Username"/>
				<input type="password" name="pass" placeholder="***"/>
				<input type="checkbox" name="check"> Remember me
				<input type="submit" name="login_submit" value="Login"/>
			</form>
			<div>
				<a href="adminlogin.php">Admin login</a>
			</div>
			
		</div>

		<div>
			<a href="register.php">Dont have an account?</a>
		</div>
	</div>
	<div id="rightpanel">
		<?php
		if(isset($_SESSION['id']))
		{
			?>
			<div class="status-grid_pic">
				<img src="<?php echo $_SESSION['pro']; ?>"alt="Smiley face" height="200" width="200">	
				<h4><a href="profile.php?uid=<?php echo $_SESSION['id'] ?>"><?php echo $_SESSION['name'] ?></a><h4>
				</div>

				<?php 
		}
		else if(isset($_COOKIE['id']))
		{
			?>
				<div class="status-grid_pic">
				<img src="<?php echo $_COOKIE['pro']; ?>"alt="Smiley face" height="200" width="200">	
				<h4><a href="profile.php?uid=<?php echo $_COOKIE['id'] ?>"><?php echo $_SESSION['name'] ?></a><h4>
				</div>
	<?php
		}
			?>
		</div>






	</body>
	</html>