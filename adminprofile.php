<?php
include "process/database.php";
session_start();
unset($_SESSION['link']);
?>
<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Thought Exchange</title>
	<link href="./css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="./css/mystyle.css" rel="stylesheet" type="text/css" media="all">
	<link href="./css/style.css" rel="stylesheet" type="text/css" media="all">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,700' rel='stylesheet' type='text/css'>
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
								<li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
								<li><a href="users.php">Users</a></li>
								<li><a href="questions.php">questions</a></li>
								<li><a href="tags.php">Tags</a></li>
								<?php
								if(isset($_SESSION['id']))
								{
									?>
									<li><a href="ask.php">Ask Question</a></li>
									<?php
								}
								else
								{
									?>
									<li><a href="process/login.php">Ask Question</a></li>
									<?php
								}
								?>
								
								<li><a href="">Contact</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>
	<div id="leftpanel">
		    <div class="left_titile">
      			<h3>Top Tags</h3>
    		</div>
		<ul class="nav">
			<li><a href="">C++</a></li>
			<li><a href="">Html</a></li>
			<li><a href="">Java</a></li>
			<li><a href="">Android</a></li>
			<li><a href="process/Ask.php">Php</a></li>
			<li><a href="">Asp.net</a></li>
		</ul>
	</div>
	<div id="section">
		<?php
		$userid=$_GET['uid'];
		$sql = "SELECT * FROM user WHERE user_id='$userid'";
		$result = mysql_query($sql);
		$rows=mysql_fetch_array($result);
		$imagename=$rows['img_name'];
		$username2=$rows['username'];
		$email=$rows['email'];
		?>
		<div>
			<div class="proimg">
				<h4><img src="<?php echo $imagename ?>" height="300" width="300"></h4>
			</div>
			<h4><?php echo $username2 ?></h4>
			<h4><?php echo $email ?></h4>
		</div>
			<form action="process/adminpropic_process.php" method="post" enctype="multipart/form-data">
				<input type="file" id="author" name="image_file" />
				<input type="submit" value="Register">
		</form>
		</div>

	</div>
	<div id="rightpanel">
		<?php
		if(isset($_SESSION['id']) || isset($_COOKIE[$cookie_name]))
		{
			?>

			<div class="status-grid_pic">
				<img src="<?php echo $_SESSION['pro']; ?>"alt="Smiley face" height="200" width="200">	
				<h4><a href="profile.php?uid=<?php echo $status_id ?>"><?php echo $_COOKIE['name'] ?></a><h4>
				</div>

				<?php 
			}
			?>
		</div>
	</body>
	</html>